<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyResource;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\BillType;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Journal;
use App\Models\JournalDetail;
use App\Models\Product;
use App\Models\SaleRepresentative;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class SalesInvoiceController extends Controller
{
    public $view_path = 'managements.sales.sales_invoice.';
    public function index(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;

        $data = new Bill();

        $data = $data->where('branch_id', Auth::user()->branch_id)->whereIn('bill_type_id',[1,4])->orderBy('id', 'desc');


        $data_count = $data->count();

        return view('managements.sales.sales_invoice.index')
            ->with('data', $data->paginate($table_length))
            ->with('pagination_links', [
                'table_length' =>
                    isset($_GET['table_length']) ? $_GET['table_length'] : '',
            ])
            ->with('data_count', $data_count);
    }

    public function show(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;
        $bill = Bill::where('branch_id', Auth::user()->branch_id)->whereIn('bill_type_id',[1,4])->orderBy('id', 'desc')->paginate($table_length);

        return response()->json($bill);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Bill::query()
            ->when($query, function ($q) use ($query) {
                $q->where('date', 'like', "%{$query}%")
                    ->orWhere('note', 'like', "%{$query}%")
                    ->orWhereHas('sale_representative', function ($q1) use ($query) {
                        $q1->whereTranslationLike('name', "%{$query}%");
                    })
                    ->orWhereHas('customer', function ($q1) use ($query) {
                        $q1->whereTranslationLike('name', "%{$query}%");
                    })
                    ->orWhereHas('bill_type', function ($q1) use ($query) {
                        $q1->whereTranslationLike('name', "%{$query}%");
                    });
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $bill->actions, include them
        return response()->json($data);
    }

    public function create()
    {

        $data = Bill::where('branch_id', Auth::user()->branch_id)->get();

        return view($this->view_path . 'created')
            ->with('sale_representative', SaleRepresentative::where('branch_id', Auth::user()->branch_id)->get())
            ->with('customer', Customer::where('branch_id', Auth::user()->branch_id)->get())
            ->with('product', Product::where('status', 1)->get())
            ->with('currency', Currency::get())
            ->with('bill_type', BillType::whereIn('id', [1,4])->get())
            ->with('data', $data);

    }

    public function falterCurrVal($id)
    {


        $currency = Currency::where('id', $id)
            ->get();
        $data = CurrencyResource::collection($currency);

        return response()->json($data);

    }


    public function store(Request $request) {
        // افترضنا أن 1 للمبيعات و 4 لمرتجع المبيعات
        $isReturn = ($request->bill_type_id == 4);

        DB::beginTransaction();
        try {
            // 1. حفظ رأس فاتورة المبيعات
            $bill = Bill::create([
                'customer_id'   => $request->customer_id, // رقم العميل
                'sale_representative_id'   => $request->sale_representative_id, // رقم مندوب المبيعات
                'bill_type_id'  => $request->bill_type_id,
                'date'          => $request->date,
                'note'          => $request->note,
                'post'          => $request->post == "on" ? 1 : 0,
                'user_id'       => Auth::id(),
                'branch_id'     => Auth::user()->branch_id,
            ]);

            $totalNet = 0;
            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['price'];
                $discount = $subtotal * ($item['discount'] / 100);
                $lineNet  = $subtotal - $discount;
                $totalNet += $lineNet;

                // تفاصيل فاتورة المبيعات
                BillDetail::create([
                    'bill_id'     => $bill->id,
                    'product_id'  => $item['product_id'],
                    'quantity'    => $item['quantity'],
                    'discount'    => $item['discount'],
                    'price'       => $item['price'],
                    'VAT'         => $item['vat'] ?? 0,
                    'currency_id' => $item['currency_id'],
                ]);

                if ($request->post == "on") {
                    // 2. حركة الأصناف (Inventory) - عكس المشتريات تماماً
                    Inventory::create([
                        'product_id' => $item['product_id'],
                        'quantity_in' => $isReturn ? $item['quantity'] : 0, // المرتجع يدخل المخزن
                        'quantity_out' => $isReturn ? 0 : $item['quantity'], // البيع يخرج من المخزن
                        'movement_type_id' => $isReturn ? 3 : 2, // 2 مبيعات، 3 مرتجع مبيعات
                        'price' => $item['price'],
                        'note' => ($isReturn ? "مرتجع مبيعات فاتورة: " : "بيع فاتورة: ") . $bill->id,
                    ]);
                }
            }

            if ($request->post == "on") {
                // 3. حفظ رأس القيد المحاسبي (Journal)
                $journal = Journal::create([
                    'journal_number' => 0,
                    'post' => $request->post == "on" ? 1 : 0,
                    'date' => $request->date,
                    'note' => ($isReturn ? "مرتجع مبيعات رقم: " : "فاتورة مبيعات رقم: ") . $bill->id,
                    'operation_type_id' => $isReturn ? 7 : 6, // افترضنا 7 مبيعات و 8 مرتجع مبيعات
                    'debit' => $request->all_total,
                    'credit' => $request->all_total,
                    'user_id' => Auth::id(),
                    'branch_id' => Auth::user()->branch_id,
                    'journal_type_id' => 1,
                    'balance' => 0
                ]);

                $journal->update([
                    'journal_number' => Auth::user()->branch_id . $journal->id
                ]);

                // 4. حفظ تفاصيل القيد (التوجيه المحاسبي)
                $acc_sales = 15; // مثال لحساب المبيعات (دائن)
                $acc_vat = 14; // حساب الضريبة
                $acc_customer = 16; //العملاء: يتم ربطهم بحساب الحسابات المدينة (Accounts Receivable / Debtors)
                $currency_id = collect($request->items)->first()['currency_id'] ?? 1;

                // سطر المبيعات (المبيعات دائنة، المرتجع مدين)
                JournalDetail::create([
                    'journal_id' => $journal->id,
                    'account_id' => $acc_sales,
                    'acc_debit' => $isReturn ? $totalNet : 0,
                    'acc_credit' => $isReturn ? 0 : $totalNet,
                    'currency_id' => $currency_id,
                ]);

                // سطر الضريبة
                if ($request->vat > 0) {
                    JournalDetail::create([
                        'journal_id' => $journal->id,
                        'account_id' => $acc_vat,
                        'acc_debit' => $isReturn ? $request->vat : 0,
                        'acc_credit' => $isReturn ? 0 : $request->vat,
                        'currency_id' => $currency_id,
                    ]);
                }

                // سطر العميل (العميل مدين في البيع، دائن في المرتجع)
                JournalDetail::create([
                    'journal_id' => $journal->id,
                    'account_id' => $acc_customer,
                    'acc_debit' => $isReturn ? 0 : $request->all_total,
                    'acc_credit' => $isReturn ? $request->all_total : 0,
                    'note' => ($isReturn ? "مرتجع مبيعات رقم " : "مبيعات فاتورة رقم ") . $bill->id,
                    'currency_id' => $currency_id,
                ]);
            }

            DB::commit();
            return redirect('/sales/sales_invoice')->with('success', 'تم حفظ فاتورة المبيعات بنجاح');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function edit($id)
    {

        $bill = Bill::where('branch_id', Auth::user()->branch_id)->find($id);
        $bill_details = BillDetail::where('bill_id', $id)->get();

        return view($this->view_path . 'edit', array(
            'id' => $bill->id,
            'sales_invoice' => $bill,
            'sales_invoice_details' => $bill_details,
            'product' => Product::where('status', 1)->get(),
            'currency' => Currency::get(),
            'bill_type' => BillType::whereIn('id', [1,4])->get(),
            'sale_representative'=> SaleRepresentative::where('branch_id', Auth::user()->branch_id)->get(),
            'customer'=> Customer::where('branch_id', Auth::user()->branch_id)->get(),


        ));

    }

    public function update(Request $request, $id) {
        // 1 للمبيعات و 4 لمرتجع المبيعات (بناءً على الكود الخاص بك)
        $isReturn = ($request->bill_type_id == 4);
        $operation_type = $isReturn ? 7 : 6; // 6 للمبيعات و 7 للمرتجع

        DB::beginTransaction();
        try {
            $bill = Bill::findOrFail($id);

            // --- أولاً: تنظيف البيانات القديمة المرتبطة بهذه الفاتورة ---

            // 1. حذف تفاصيل الفاتورة القديمة
            $bill->billDetails()->delete();
            if ($request->post == "on") {
                // 2. حذف حركة المخزن القديمة)
                Inventory::where('note','like', '%'.$bill->id.'%')->delete();


                // 3. حذف القيد المحاسبي القديم (البحث بالنوع ورقم الفاتورة)
                $oldJournal = Journal::where('operation_type_id', $operation_type)
                    ->first();

                if ($oldJournal) {
                    JournalDetail::where('journal_id', $oldJournal->id)->delete();
                    $oldJournal->delete();
                }
            }

            // --- ثانياً: تحديث بيانات رأس الفاتورة ---
            $bill->update([
                'customer_id'   => $request->customer_id,
                'sale_representative_id'   => $request->sale_representative_id,
                'bill_type_id'  => $request->bill_type_id,
                'date'          => $request->date,
                'note'          => $request->note,
                'post'          => $request->post == "on" ? 1 : 0,
            ]);

            // --- ثالثاً: إعادة بناء التفاصيل والمخزن والقيد الجديد ---
            $totalNet = 0;
            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['price'];
                $discount = $subtotal * ($item['discount'] / 100);
                $lineNet  = $subtotal - $discount;
                $totalNet += $lineNet;

                // حفظ التفاصيل الجديدة
                BillDetail::create([
                    'bill_id'     => $bill->id,
                    'product_id'  => $item['product_id'],
                    'quantity'    => $item['quantity'],
                    'discount'    => $item['discount'],
                    'price'       => $item['price'],
                    'VAT'         => $item['vat'] ?? 0,
                    'currency_id' => $item['currency_id'],
                ]);
                if ($request->post == "on") {
                    // حركة المخزن الجديدة
                    Inventory::create([
                        'product_id' => $item['product_id'],
                        'quantity_in' => $isReturn ? $item['quantity'] : 0,
                        'quantity_out' => $isReturn ? 0 : $item['quantity'],
                        'movement_type_id' => $isReturn ? 3 : 2,
                        'price' => $item['price'],
                        'note' => ($isReturn ? "تعديل مرتجع مبيعات فاتورة: " : "تعديل بيع فاتورة: ") . $bill->id,
                    ]);
                }
            }

            if ($request->post == "on") {
                // 4. إنشاء القيد المحاسبي الجديد
                $journal = Journal::create([
                    'journal_number' => 0,
                    'post'  => $request->post == "on" ? 1 : 0,
                    'date' => $request->date,
                    'note' => ($isReturn ? "تعديل مرتجع مبيعات رقم: " : "تعديل مبيعات رقم: ") . $bill->id,
                    'operation_type_id' => $operation_type,
                    'debit' => $request->all_total,
                    'credit' => $request->all_total,
                    'user_id' => Auth::id(),
                    'branch_id' => Auth::user()->branch_id,
                    'journal_type_id' => 1,
                    'balance' => 0
                ]);

                $journal->update([
                    'journal_number' => Auth::user()->branch_id . $journal->id
                ]);

                // 5. تفاصيل القيد (التوجيه المحاسبي الجديد)
                $acc_sales = 15; // حساب المبيعات
                $acc_vat = 14; // حساب الضريبة
                $acc_customer = 16;
                $currency_id = collect($request->items)->first()['currency_id'] ?? 1;

                // سطر المبيعات
                JournalDetail::create([
                    'journal_id' => $journal->id,
                    'account_id' => $acc_sales,
                    'acc_debit' => $isReturn ? $totalNet : 0,
                    'acc_credit' => $isReturn ? 0 : $totalNet,
                    'currency_id' => $currency_id,
                ]);

                // سطر الضريبة
                if ($request->vat > 0) {
                    JournalDetail::create([
                        'journal_id' => $journal->id,
                        'account_id' => $acc_vat,
                        'acc_debit' => $isReturn ? $request->vat : 0,
                        'acc_credit' => $isReturn ? 0 : $request->vat,
                        'currency_id' => $currency_id,
                    ]);
                }

                // سطر العميل (المدين)
                JournalDetail::create([
                    'journal_id' => $journal->id,
                    'account_id' => $acc_customer,
                    'acc_debit' => $isReturn ? 0 : $request->all_total,
                    'acc_credit' => $isReturn ? $request->all_total : 0,
                    'note' => ($isReturn ? "تعديل مرتجع رقم " : "تعديل مبيعات رقم ") . $bill->id,
                    'currency_id' => $currency_id,
                ]);
            }

            DB::commit();
            return redirect('/sales/sales_invoice')->with('success', 'تم تعديل الفاتورة وتحديث القيود بنجاح');

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function delete($id)
    {

        $detail = BillDetail::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // 1. العثور على الفاتورة
            $bill = Bill::findOrFail($id);

            // تحديد نوع العملية للبحث عن القيد (5 للمشتريات كما حددت أنت)
            $isReturn = ($bill->bill_type_id == 3);
            $operation_type = $isReturn ? 6 : 5;

            // 2. حذف تفاصيل الفاتورة
            $bill->billDetails()->delete();

            // 3. حذف حركات المخزن المرتبطة (البحث برقم الفاتورة في الملاحظات)
            Inventory::where('note','like', '%'.$bill->id.'%')->delete();

            // 4. حذف القيد المحاسبي المرتبط
            // نبحث عن القيد الذي يحمل النوع 5 (مشتريات) ويحتوي رقم الفاتورة في ملاحظاته
            $journal = Journal::where('operation_type_id', $isReturn ? 7 : 6)
                ->first();

            if ($journal) {
                // حذف أسطر القيد أولاً (كشف الحساب)
                JournalDetail::where('journal_id', $journal->id)->delete();
                // حذف رأس القيد
                $journal->delete();
            }

            // 5. حذف رأس الفاتورة نهائياً
            $bill->delete();

            DB::commit();
            return response()->json(['message' => 'تم حذف الفاتورة وجميع قيودها وحركات المخزن بنجاح']);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'حدث خطأ أثناء الحذف: ' . $e->getMessage()], 500);
        }
    }
}
