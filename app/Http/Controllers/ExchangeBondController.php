<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyResource;
use App\Models\Account;
use App\Models\Bank;
use App\Models\Bond;
use App\Models\BondDetail;
use App\Models\BondType;
use App\Models\Currency;

use App\Models\Fund;
use App\Models\Journal;
use App\Models\JournalDetail;
use App\Models\OperationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ExchangeBondController extends Controller
{
    public $view_path = 'managements.accounts.exchange_bond.';

    public function index(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;

        $data = new Bond();

        $data = $data->where('bond_type_id',2)->where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc');


        $data_count = $data->count();

        return view('managements.accounts.exchange_bond.index')
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
        $exchange_bond = Bond::where('bond_type_id',2)->where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->paginate($table_length);

        return response()->json($exchange_bond);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Bond::query()
            ->when($query, function ($q) use ($query) {
                $q->where('date', 'like', "%{$query}%")
                    ->orWhere('amount', 'like', "%{$query}%")
                    ->orWhere('note', 'like', "%{$query}%")
                    ->orWhereHas('fund', function ($q1) use ($query) {
                        $q1->whereTranslationLike('name', "%{$query}%");
                    });

            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $exchange_bond->actions, include them
        return response()->json($data);
    }

    public function create()
    {

        $data = Bond::where('branch_id', Auth::user()->branch_id)->get();

        return view($this->view_path . 'created')
            ->with('account', Account::where('acc_type_id', 2)->where('status', 1)->where('branch_id', Auth::user()->branch_id)->get())
            ->with('currency', Currency::get())
            ->with('operation_type', OperationType::where('id', 2)->first())
            ->with('fund', Fund::get())
            ->with('bank', Bank::get())
            ->with('data', $data);

    }

    public function falterCurrVal($id)
    {


        $currency = Currency::where('id', $id)
            ->get();
        $data = CurrencyResource::collection($currency);

        return response()->json($data);

    }


    public function store(Request $request)
    {


        $exchange_bond = new Bond();
        $exchange_bond->branch_id = Auth::user()->branch_id;
        $exchange_bond->bond_type_id = 2;
        $exchange_bond->amount = $request->amount;
        $exchange_bond->fund_id = $request->fund_id;
        $exchange_bond->bank_id = $request->bank_id;
        $exchange_bond->note = $request->note;
        $exchange_bond->date = $request->date;
        $exchange_bond->user_id = Auth::id();
        $exchange_bond->post = $request->post == "on" ? 1 : 0;
        $exchange_bond->save();
        $exchange_bond->check_no = Auth::user()->branch_id . 2 . $exchange_bond->id;
        $exchange_bond->save();

        foreach ($request->items as $index => $itemData) {


            BondDetail::create([
                'bond_id' => $exchange_bond->id,
                'account_id' => $itemData['account_id'],
                'amount' => $itemData['amount'],

                'currency_id' => $itemData['currency_id'],

            ]);

        }

        $journal = new Journal();
        $journal->branch_id = Auth::user()->branch_id;
        $journal->operation_type_id = 2;
        $journal->journal_type_id = 1;

        $journal->note = $request->note;
        $journal->date = $request->date;
        $journal->user_id = Auth::id();
        $journal->post = $request->post == "on" ? 1 : 0;
        $journal->save();
        $journal->journal_number = Auth::user()->branch_id . $journal->id;
        $journal->save();

        $exchange_bond->journal_id = $journal->id;
        $exchange_bond->save();


        foreach ($request->items as $itemData) {
            $amount = $itemData['amount'] ?? 0;
            $journal->debit += $amount;
            $journal->credit = $request->amount;
            $journal->balance = 0;
            $journal->save();



            JournalDetail::create([
                'journal_id' => $journal->id,
                'account_id' => $itemData['account_id'],
                'acc_debit' => $amount,
                'acc_credit' => 0,
                'note' => $request->note,
                'currency_id' => $itemData['currency_id'],
            ]);

        }



        $fundAccount = Fund::find($request->fund_id);
        $bankAccount = Bank::find($request->bank_id);
        JournalDetail::create([
            'journal_id' => $journal->id,
            'account_id' => $fundAccount->account_id ?? $bankAccount->account_id,
            'acc_debit' => 0,
            'acc_credit' => $request->amount,
            'note' => $request->note,
            'currency_id' => $itemData['currency_id'],
        ]);
        return redirect('/accounts/exchange_bond')->with('success', Lang::get('admin.added_successfully'));


    }

    public function edit($id)
    {

        $exchange_bond = Bond::where('branch_id', Auth::user()->branch_id)->find($id);
        $exchange_bond_details = BondDetail::where('bond_id', $id)->get();

        return view($this->view_path . 'edit', array(
            'id' => $exchange_bond->id,
            'exchange_bond' => $exchange_bond,
            'exchange_bond_details' => $exchange_bond_details,
            'account' => Account::where('acc_type_id', 2)->where('status', 1)->where('branch_id', Auth::user()->branch_id)->get(),
            'currency' => Currency::get(),
            'fund' => Fund::get(),
            'bank' => Bank::get(),
            'operation_type' => OperationType::first(),


        ));

    }


    public function update(Request $request, $id)
    {

        $exchange_bond = Bond::find($id);
        $exchange_bond->branch_id = Auth::user()->branch_id;
        $exchange_bond->bond_type_id = 2;
        $exchange_bond->amount = $request->amount;
        $exchange_bond->fund_id = $request->fund_id;
        $exchange_bond->bank_id = $request->bank_id;
        $exchange_bond->note = $request->note;
        $exchange_bond->date = $request->date;
        $exchange_bond->user_id = Auth::id();
        $exchange_bond->post = $request->post == "on" ? 1 : 0;
        $exchange_bond->save();


        foreach ($request->items as $index => $itemData) {

            if (isset($itemData['id'])) {
                // تحديث إذا كان هناك id موجود (لن يضيف سطر جديد)
                BondDetail::where('id', $itemData['id'])->update([

                    'account_id' => $itemData['account_id'],
                    'amount' => $itemData['amount'],

                    'currency_id' => $itemData['currency_id'],
                ]);
            } else {
                // إضافة جديد فقط إذا لم يكن هناك id
                BondDetail::create([
                    'bond_id' => $exchange_bond->id,
                    'account_id' => $itemData['account_id'],
                    'amount' => $itemData['amount'],

                    'currency_id' => $itemData['currency_id'],
                ]);
            }
        }

        $journal = Journal::find($exchange_bond->journal_id);
        $journal->branch_id = Auth::user()->branch_id;
        $journal->operation_type_id = 2;
        $journal->journal_type_id = 1;

        $journal->note = $request->note;
        $journal->date = $request->date;
        $journal->user_id = Auth::id();
        $journal->post = $request->post == "on" ? 1 : 0;
        $journal->save();
        $journal->journal_number = Auth::user()->branch_id . $journal->id;

        JournalDetail::where('journal_id', $journal->id)->delete();
        $totalAmount = 0;
        foreach ($request->items as $itemData) {
            $amount = $itemData['amount'] ?? 0;
            $totalAmount += $amount;
            $journal->debit = $totalAmount;
            $journal->credit = $request->amount;
            $journal->balance = 0;
            $journal->save();



            JournalDetail::create([
                'journal_id' => $journal->id,
                'account_id' => $itemData['account_id'],
                'acc_debit' => $amount,
                'acc_credit' => 0,
                'note' => $request->note,
                'currency_id' => $itemData['currency_id'],
            ]);

        }



        $fundAccount = Fund::find($request->fund_id);
        $bankAccount = Bank::find($request->bank_id);
        JournalDetail::create([
            'journal_id' => $journal->id,
            'account_id' => $fundAccount->account_id ??  $bankAccount->account_id,
            'acc_debit' => 0,
            'acc_credit' => $request->amount,
            'note' => $request->note,
            'currency_id' => $itemData['currency_id'],
        ]);



        return redirect('/accounts/exchange_bond')->with('success', Lang::get('admin.added_successfully'));

    }


    public function delete($id)
    {

        $detail = BondDetail::findOrFail($id);

        $detail->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function destroy($id)
    {


        DB::transaction(function () use ($id) {
            $bond = Bond::findOrFail($id);
            $detail = BondDetail::where('bond_id', $id); //Redundant if ON DELETE CASCADE is set.

            $journal_detail = JournalDetail::where('journal_id',$bond->journal_id);
            $journal = Journal::find($bond->journal_id);
            $journal_detail->delete();
            $journal->delete();
            $detail->delete();
            $bond->delete();

        });
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Bond::count()
        ],
            200
        );
    }

}
