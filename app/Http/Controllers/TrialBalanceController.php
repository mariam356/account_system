<?php

namespace App\Http\Controllers;

use App\Exports\TrialBalanceExports;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Journal;
use App\Models\JournalDetail;
use App\Models\OperationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrialBalanceController extends Controller
{
   public $view_path = 'managements.accounts.trial_balance.';
    public function index(Request $request)
    {


        return view('managements.accounts.trial_balance.index')
            ->with('currency', Currency::get());

    }



    public function getSearchQuery(Request $request)
    {
        $table_length = $request->table_length ?? 10;


        $journalIds = Journal::where('branch_id', Auth::user()->branch_id)
            ->pluck('id'); // ترجع Collection من الأرقام



        $query = JournalDetail::whereIn('journal_id', $journalIds)
            ->select(
                'account_id',
                DB::raw('SUM(acc_debit) as total_debit'),
                DB::raw('SUM(acc_credit) as total_credit'),
                DB::raw('(SUM(acc_debit) - SUM(acc_credit)) as balance')
            )
            ->groupBy('account_id')
            ->with('account') // لجلب اسم الحساب
            ;

        if ($request->filled('ids')) {

            $ids = explode(',', $request->ids);
            return $query->whereIn('account_id', $ids)->orderBy('id', 'desc');
        }
        // 🔍 فلاتر البحث
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
        $report = new TrialBalanceExports($data, $request);
        return $report->generatePdf();
    }

}
