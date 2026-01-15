<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyResource;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Journal;
use App\Models\JournalDetail;
use App\Models\JournalType;
use App\Models\OperationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class JournalController extends Controller
{
    public $view_path = 'managements.accounts.journal.';

    public function index(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;

        $data = new Journal();

        $data = $data->where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc');


        $data_count = $data->count();

        return view('managements.accounts.Journal.index')
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
        $journal = Journal::where('branch_id', Auth::user()->branch_id)->orderBy('id', 'desc')->paginate($table_length);

        return response()->json($journal);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Journal::query()
            ->when($query, function ($q) use ($query) {
                $q->where('date', 'like', "%{$query}%")
                    ->orWhere('debit', 'like', "%{$query}%")
                    ->orWhere('credit', 'like', "%{$query}%")
                    ->orWhere('balance', 'like', "%{$query}%")
                    ->orWhereHas('operation_type', function ($q1) use ($query) {
                        $q1->whereTranslationLike('name', "%{$query}%");
                    })
                    ->orWhereHas('journal_type', function ($q1) use ($query) {
                        $q1->whereTranslationLike('name', "%{$query}%");
                    });
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $Journal->actions, include them
        return response()->json($data);
    }

    public function create()
    {

        $data = Journal::where('branch_id', Auth::user()->branch_id)->get();

        return view($this->view_path . 'created')
            ->with('account', Account::where('acc_type_id', 2)->where('status', 1)->where('branch_id', Auth::user()->branch_id)->get())
            ->with('currency', Currency::get())
            ->with('operation_type', OperationType::where('id', 1)->first())
            ->with('journal_type', JournalType::get())
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

        if ($request->journal_type_id == 1 && $request->credit != $request->debit) {
            return redirect()
                ->back()
                ->withErrors([
                    'debit_credit' => 'يجب أن يكون إجمالي المدين مساوياً لإجمالي الدائن'
                ])
                ->withInput();
        } else {
            $journal = new Journal();
            $journal->branch_id = Auth::user()->branch_id;
            $journal->operation_type_id = 1;
            $journal->journal_type_id = $request->journal_type_id;

            $journal->debit = $request->debit;
            $journal->credit = $request->credit;
            $journal->balance = $request->balance;
            $journal->note = $request->note;
            $journal->date = $request->date;
            $journal->user_id = Auth::id();
            $journal->post = $request->post == "on" ? 1 : 0;
            $journal->save();
            $journal->journal_number = Auth::user()->branch_id . $journal->id;
            $journal->save();

            foreach ($request->items as $index => $itemData) {


                JournalDetail::create([
                    'journal_id' => $journal->id,
                    'account_id' => $itemData['account_id'],
                    'acc_debit' => $itemData['acc_debit'],
                    'acc_credit' => $itemData['acc_credit'],
                    'note' => $itemData['note'],
                    'currency_id' => $itemData['currency_id'],

                ]);

            }

            return redirect('/accounts/journal')->with('success', Lang::get('admin.added_successfully'));
        }


    }

    public function edit($id)
    {

        $journal = Journal::where('branch_id', Auth::user()->branch_id)->find($id);
        $journal_details = JournalDetail::where('journal_id', $id)->get();

        return view($this->view_path . 'edit', array(
            'id' => $journal->id,
            'journal' => $journal,
            'journal_details' => $journal_details,
            'account' => Account::where('acc_type_id', 2)->where('status', 1)->where('branch_id', Auth::user()->branch_id)->get(),
            'currency' => Currency::get(),
            'journal_type' => JournalType::get(),
            'operation_type' => OperationType::first(),


        ));

    }


    public function update(Request $request, $id)
    {

        if ($request->journal_type_id == 1 && $request->credit != $request->debit) {
            return redirect()
                ->back()
                ->withErrors([
                    'debit_credit' => 'يجب أن يكون إجمالي المدين مساوياً لإجمالي الدائن'
                ])
                ->withInput();
        }
        elseif ($request->journal_type_id == 3)
        {
            $journal = new Journal();
            $journal->branch_id = Auth::user()->branch_id;

            $journal->journal_type_id = $request->journal_type_id;

            $journal->debit = $request->debit;
            $journal->credit = $request->credit;
            $journal->balance = $request->balance;
            $journal->note = $request->note;
            $journal->date = $request->date;
            $journal->user_id = Auth::id();
            $journal->post = $request->post == "on" ? 1 : 0;
            $journal->save();
            $journal->journal_number = Auth::user()->branch_id . $journal->id;
            $journal->save();

            foreach ($request->items as $index => $itemData) {


                JournalDetail::create([
                    'journal_id' => $journal->id,
                    'account_id' => $itemData['account_id'],
                    'acc_debit' => $itemData['acc_credit'],
                    'acc_credit' => $itemData['acc_debit'],
                    'note' => $itemData['note'],
                    'currency_id' => $itemData['currency_id'],

                ]);
            }
            return redirect('/accounts/journal')->with('success', Lang::get('admin.added_successfully'));
        }
        else{
            $journal = Journal::find($id);
            $journal->branch_id = Auth::user()->branch_id;
            $journal->operation_type_id = 1;
            $journal->journal_type_id = $request->journal_type_id;
            $journal->debit = $request->debit;
            $journal->credit = $request->credit;
            $journal->balance = $request->balance;
            $journal->note = $request->note;
            $journal->date = $request->date;
            $journal->journal_number = $request->journal_number;
            $journal->user_id = Auth::id();
            $journal->post = $request->post == "on" ? 1 : 0;
            $journal->save();


            foreach ($request->items as $index => $itemData) {

                if (isset($itemData['id'])) {
                    // تحديث إذا كان هناك id موجود (لن يضيف سطر جديد)
                    JournalDetail::where('id', $itemData['id'])->update([
                        'account_id' => $itemData['account_id'],
                        'acc_debit' => $itemData['acc_debit'],
                        'acc_credit' => $itemData['acc_credit'],
                        'note' => $itemData['note'],
                        'currency_id' => $itemData['currency_id'],
                    ]);
                } else {
                    // إضافة جديد فقط إذا لم يكن هناك id
                    JournalDetail::create([
                        'journal_id' => $journal->id,
                        'account_id' => $itemData['account_id'],
                        'acc_debit' => $itemData['acc_debit'],
                        'acc_credit' => $itemData['acc_credit'],
                        'note' => $itemData['note'],
                        'currency_id' => $itemData['currency_id'],
                    ]);
                }
            }


            return redirect('/accounts/journal')->with('success', Lang::get('admin.added_successfully'));
        }
    }


    public function delete($id)
    {

        $detail = JournalDetail::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }

    public function destroy($id)
    {


        DB::transaction(function () use ($id) {
            Journal::where('id', $id)->delete();
            JournalDetail::where('journal_id', $id)->delete(); //Redundant if ON DELETE CASCADE is set.
        });
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Journal::count()
        ],
            200
        );
    }


}
