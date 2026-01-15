<?php

namespace App\Http\Controllers;

use App\Exports\AccountStatementExports;
use App\Models\Account;

use App\Models\Currency;
use App\Models\Journal;
use App\Models\JournalDetail;
use App\Models\OperationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountStatementController extends Controller
{
    public $view_path = 'managements.accounts.account_statement.';
    public function index(Request $request)
    {


        return view('managements.accounts.account_statement.index')
            ->with('operation_type', OperationType::get())
            ->with('currency', Currency::get())
            ->with('account', Account::where('acc_type_id', 2)->where('status', 1)->where('branch_id', Auth::user()->branch_id)->get());
    }

    private function getSearchQuery(Request $request)
    {
        $journalIds = Journal::where('branch_id', Auth::user()->branch_id)->pluck('id');

        $query = JournalDetail::whereIn('journal_id', $journalIds);
        if ($request->filled('ids')) {

            $ids = explode(',', $request->ids);
            return $query->whereIn('id', $ids)->orderBy('id', 'desc');
        }

        $query->when($request->from_date, function ($q) use ($request) {
            $q->whereHas('journal', function ($sub) use ($request) {
                $sub->whereDate('date', '>=', $request->from_date);
            });
        });

        $query->when($request->to_date, function ($q) use ($request) {
            $q->whereHas('journal', function ($sub) use ($request) {
                $sub->whereDate('date', '<=', $request->to_date);
            });
        });

        $query->when($request->currency_id, function ($q) use ($request) {
            $q->where('currency_id', $request->currency_id);
        });

        $query->when($request->account_id, function ($q) use ($request) {
            $q->where('account_id', $request->account_id);
        });

        $query->when($request->operation_type_id, function ($q) use ($request) {
            $q->whereHas('journal', function ($sub) use ($request) {
                $sub->where('operation_type_id', $request->operation_type_id);
            });
        });

        return $query->orderBy('id', 'desc');
    }


    public function search(Request $request)
    {
        $table_length = $request->table_length ?? 10;
        $data = $this->getSearchQuery($request)->paginate($table_length);
        return response()->json($data);
    }

    public function reportExport(Request $request)
    {
        $query = $this->getSearchQuery($request);

        $data = $query->get();

        return view($this->view_path . 'report_export')
            ->with('data', $data)
            ->with('request', $request)
            ->with('isPdf', false);
    }

    public function export(Request $request)
    {
        $data = $this->getSearchQuery($request)->get();
        $report = new AccountStatementExports($data, $request);
        return $report->generatePdf();
    }




}
