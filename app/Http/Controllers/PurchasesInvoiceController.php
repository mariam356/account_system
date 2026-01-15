<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyResource;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\BillType;
use App\Models\Inventory;
use App\Models\Journal;
use App\Models\JournalDetail;
use App\Models\OperationType;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class PurchasesInvoiceController extends Controller
{
    public $view_path = 'managements.purchases.purchases_invoice.';

    public function index(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;

        $data = new Bill();

        $data = $data->where('branch_id', Auth::user()->branch_id)->whereIn('bill_type_id',[2,3])->orderBy('id', 'desc');


        $data_count = $data->count();

        return view('managements.purchases.purchases_invoice.index')
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
        $bill = Bill::where('branch_id', Auth::user()->branch_id)->whereIn('bill_type_id',[2,3])->orderBy('id', 'desc')->paginate($table_length);

        return response()->json($bill);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Bill::query()
            ->when($query, function ($q) use ($query) {
                $q->where('date', 'like', "%{$query}%")
                    ->orWhere('note', 'like', "%{$query}%")
                    ->orWhereHas('supplier', function ($q1) use ($query) {
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
            ->with('supplier', Supplier::where('branch_id', Auth::user()->branch_id)->get())
            ->with('product', Product::where('status', 1)->get())
            ->with('currency', Currency::get())
            ->with('bill_type', BillType::whereIn('id', [2, 3])->get())
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
        // افترضنا أن $request->bill_type هو 2 للمشتريات و 3 للمرتجع
        $isReturn = ($request->bill_type_id == 3);

        DB::beginTransaction();
        try {
            // 1. حفظ الفاتورة (رأس الفاتورة)
            $bill = Bill::create([
                'supplier_id' => $request->supplier_id,
                'bill_type_id'   => $request->bill_type_id, // 1: فاتورة، 2: مرتجع
                'date'        => $request->date,
                'note' => $request->note,
                'post'  => $request->post == "on" ? 1 : 0,
                'user_id'  => Auth::id(),
                'branch_id'  => Auth::user()->branch_id,
            ]);

            // 2. حساب الإجماليات من مصفوفة الأصناف
            $totalNet = 0;
            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['price'];
                $discount = $subtotal * ($item['discount'] / 100);
                $lineNet = $subtotal - $discount;
                $totalNet += $lineNet;

                // حفظ تفاصيل الفاتورة
                BillDetail::create([
                    'bill_id'    => $bill->id,
                    'product_id' => $item['product_id'],
                    'quantity'   => $item['quantity'],
                    'discount'      => $item['discount'],
                    'price'      => $item['price'],
                    'VAT'      => $item['vat'] ?? 0,
                    'currency_id'      => $item['currency_id'],
                ]);

                if ($request->post == "on")
                {
                    // 3. حركة الأصناف (Inventory)
                    Inventory::create([
                        'product_id'   => $item['product_id'],
                        'quantity_in'  => $isReturn ? 0 : $item['quantity'], // في المشتريات يدخل، في المرتجع 0
                        'quantity_out' => $isReturn ? $item['quantity'] : 0, // في المرتجع يخرج من المخزن
                        'movement_type_id'  => $isReturn ? 4 : 1,
                        'price'             => $item['price'],
                        'note'            => ($isReturn ? "تعديل مرتجع المشتريات فاتورة: " : "تعديل مشترى فاتورة: ") . $bill->id,
                    ]);
                }

            }
            if ($request->post == "on") {
                // 4. حفظ رأس القيد المحاسبي (Journal)

                $journal = Journal::create([
                    'journal_number' => 0, // قيمة مؤقتة
                    'post'  => $request->post == "on" ? 1 : 0,
                    'date' => $request->date,
                    'note' => ($isReturn ? "مرتجع مشتريات: " : "فاتورة مشتريات: ") . $bill->id,
                    'operation_type_id' => $isReturn ? 5 : 4,
                    'debit' => $request->all_total,
                    'credit' => $request->all_total,
                    'user_id' => Auth::id(),
                    'branch_id' => Auth::user()->branch_id,
                    'journal_type_id' => 1,
                    'balance' => $request->all_total - $request->all_total
                ]);

// 2. الآن حدث رقم القيد ليتضمن المعرف (ID) والفرع
                $journal->update([
                    'journal_number' => Auth::user()->branch_id . $journal->id
                ]);

                // 5. حفظ تفاصيل القيد (كشف الحساب يتغذى من هنا)

                // حساب المشتريات وحساب المورد يتبادلان الأماكن في المرتجع
                $acc_purchases = 13; // مثال لحساب المشتريات
                $acc_vat = 14; // مثال لحساب الضريبة
                $acc_supplier = 8; // يتم ربطهم بحساب الحسابات الدائنة (Accounts Payable / Creditors)
                $firstItem = collect($request->items)->first();
                $currency_id = $firstItem['currency_id'] ?? 1; // إذا لم توجد نضع 1 كافتراضي


// حساب الرصيد الجديد بناءً على نوع الحركة
                $current_debit_pur = $isReturn ? 0 : $totalNet;
                $current_credit_pur = $isReturn ? $totalNet : 0;

                // سطر المشتريات
                JournalDetail::create([
                    'journal_id' => $journal->id,
                    'account_id' => $acc_purchases,
                    'acc_debit' => $current_debit_pur, // المشتريات مدينة، المرتجع دائن
                    'acc_credit' => $current_credit_pur,
                    'currency_id' => $currency_id,

                ]);

// حساب الرصيد الجديد بناءً على نوع الحركة
                $current_debit_vat = $isReturn ? 0 : $request->vat;
                $current_credit_vat = $isReturn ? $request->vat : 0;

                // سطر الضريبة
                if ($request->vat > 0) {
                    JournalDetail::create([
                        'journal_id' => $journal->id,
                        'account_id' => $acc_vat,
                        'acc_debit' => $current_debit_vat,
                        'acc_credit' => $current_credit_vat,
                        'currency_id' => $currency_id,

                    ]);
                }


// حساب الرصيد الجديد بناءً على نوع الحركة
                $current_debit = $isReturn ? $request->all_total : 0;
                $current_credit = $isReturn ? 0 : $request->all_total;

                // سطر المورد (هذا السطر هو الذي يظهر في كشف حساب المورد)
                JournalDetail::create([
                    'journal_id' => $journal->id,
                    'account_id' => $acc_supplier,
                    'acc_debit' => $current_debit, // المورد مدين في المرتجع (نقص حقه)
                    'acc_credit' => $current_credit, // المورد دائن في الفاتورة (زاد حقه)
                    'note' => ($isReturn ? "مرتجع رقم " : "فاتورة رقم ") . $bill->id,
                    'currency_id' => $currency_id,

                ]);
            }

            DB::commit();
            return redirect('/purchases/purchases_invoice')->with('success', Lang::get('admin.added_successfully'));
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
            'purchases_invoice' => $bill,
            'purchases_invoice_details' => $bill_details,
            'product' => Product::where('status', 1)->get(),
            'currency' => Currency::get(),
            'bill_type' => BillType::whereIn('id', [2, 3])->get(),

            'supplier' => Supplier::where('branch_id', Auth::user()->branch_id)->get(),


        ));

    }


    public function update(Request $request, $id) {
        $isReturn = ($request->bill_type_id == 3);

        DB::beginTransaction();
        try {
            // 1. العثور على الفاتورة القديمة
            $bill = Bill::findOrFail($id);

            // 2. حذف البيانات المرتبطة القديمة (التفاصيل، المخزن، القيود)
            // ملاحظة: قمنا بحذفها لإعادة بنائها بناءً على التعديلات الجديدة
            $bill->billDetails()->delete();

            // حذف حركات المخزن المرتبطة بهذه الفاتورة (افترضنا وجود علاقة أو استخدام bill_id)
            // حذف حركات المخزن القديمة بناءً على النص المخزن في الملاحظات
            if ($request->post == "on") {
                Inventory::where('note','like', '%'.$bill->id.'%')->delete();

                // التعامل مع القيد القديم: ابحث عن القيد المرتبط واحذفه مع تفاصيله
                // ج. حذف القيد القديم (البحث باستخدام النوع 5 ورقم الفاتورة في الملاحظة)
                $oldJournal = Journal::where('operation_type_id', $isReturn ? 5 : 4)
                    ->first();

                if ($oldJournal) {
                    // حذف تفاصيل القيد أولاً لمنع تعارض الأرصدة
                    JournalDetail::where('journal_id', $oldJournal->id)->delete();
                    $oldJournal->delete();
                }
            }

            // 3. تحديث رأس الفاتورة بالبيانات الجديدة
            $bill->update([
                'supplier_id'  => $request->supplier_id,
                'bill_type_id' => $request->bill_type_id,
                'date'         => $request->date,
                'note'         => $request->note,
                'post'         => $request->post == "on" ? 1 : 0,
                'user_id'      => Auth::id(),
                'branch_id'    => Auth::user()->branch_id,
            ]);

            // 4. معالجة الأصناف الجديدة (نفس منطق الـ Store)
            $totalNet = 0;
            foreach ($request->items as $item) {
                $subtotal = $item['quantity'] * $item['price'];
                $discount = $subtotal * ($item['discount'] / 100);
                $lineNet = $subtotal - $discount;
                $totalNet += $lineNet;

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

                    Inventory::create([

                        'product_id' => $item['product_id'],
                        'quantity_in' => $isReturn ? 0 : $item['quantity'],
                        'quantity_out' => $isReturn ? $item['quantity'] : 0,
                        'movement_type_id' => $isReturn ? 4 : 1,
                        'price' => $item['price'],
                        'note' => ($isReturn ? "تعديل مرتجع المشتريات فاتورة: " : "تعديل مشترى فاتورة: ") . $bill->id,
                    ]);
                }
            }

            if ($request->post == "on") {
                // 5. إنشاء القيد المحاسبي الجديد (بعد التعديل)
                $journal = Journal::create([
                    'journal_number' => 0,
                    'post'  => $request->post == "on" ? 1 : 0,
                    'date' => $request->date,
                    'note' => ($isReturn ? "تعديل مرتجع: " : "تعديل فاتورة: ") . $bill->id,
                    'operation_type_id' => $isReturn ? 5 : 4,
                    'debit' => $request->all_total,
                    'credit' => $request->all_total,
                    'user_id' => Auth::id(),
                    'branch_id' => Auth::user()->branch_id,
                    'balance' => $request->all_total - $request->all_total,
                    'journal_type_id' => 1,
                ]);

                $journal->update([
                    'journal_number' => Auth::user()->branch_id . $journal->id
                ]);


                // 6. حفظ تفاصيل القيد (نفس منطق الحسابات في الـ Store)
                $acc_purchases = 13;
                $acc_vat = 14;
                $acc_supplier = 8; // يتم ربطهم بحساب الحسابات الدائنة (Accounts Payable / Creditors)
                $currency_id = collect($request->items)->first()['currency_id'] ?? 1;

                // سطر المشتريات
                $this->createJournalDetail($journal->id, $acc_purchases, ($isReturn ? 0 : $totalNet), ($isReturn ? $totalNet : 0), $currency_id);

                // سطر الضريبة
                if ($request->vat > 0) {
                    $this->createJournalDetail($journal->id, $acc_vat, ($isReturn ? 0 : $request->vat), ($isReturn ? $request->vat : 0), $currency_id);
                }

                // سطر المورد
                $this->createJournalDetail($journal->id, $acc_supplier, ($isReturn ? $request->all_total : 0), ($isReturn ? 0 : $request->all_total), $currency_id, ($isReturn ? "تعديل مرتجع " : "تعديل فاتورة ") . $bill->id);
            }
            DB::commit();
            return redirect('/purchases/purchases_invoice')->with('success', Lang::get('admin.added_successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

// دالة مساعدة لتقليل تكرار الكود وحساب الرصيد
    private function createJournalDetail($journalId, $accountId, $debit, $credit, $currencyId, $note = null) {

        return JournalDetail::create([
            'journal_id'  => $journalId,
            'account_id'  => $accountId,
            'acc_debit'   => $debit,
            'acc_credit'  => $credit,
            'currency_id' => $currencyId,
            'note'        => $note
        ]);
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
            $journal = Journal::where('operation_type_id', $isReturn ? 5 : 4)
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
