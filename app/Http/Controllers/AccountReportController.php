<?php

namespace App\Http\Controllers;

use App\Exports\AccountExports;


use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class AccountReportController extends Controller
{
    public $view_path = 'managements.accounts.accounting_guide.';
    public function index(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;

        $data = new Account();

        $data = $data->orderBy('id', 'desc');


        $data_count = $data->count();

        return view($this->view_path . 'report')
            ->with('data', $data->paginate($table_length))
            ->with('pagination_links', [
                'table_length' =>
                    isset($_GET['table_length']) ? $_GET['table_length'] : '',
            ])
            ->with('data_count', $data_count);
    }

    public function show(Request $request)
    {
        $Account = Account::with(['acc_type', 'acc_report_type','account'])
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($Account);
    }



    public function search(Request $request)
    {

        $query = $request->get('query', '');

        $data = \App\Models\Account::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%")
                    ->orWhere('acc_code', 'like', "%{$query}%")
                    ->orWhere('account_id', 'like', "%{$query}%")
                    ->orWhere('acc_level', 'like', "%{$query}%")
                    ->orWhereHas('acc_type', function ($q1) use ($query) {
                        $q1->whereTranslationLike('name', "%{$query}%");
                    })
                    ->orWhereHas('acc_report_type', function ($q2) use ($query) {
                        $q2->whereTranslationLike('name', "%{$query}%");
                    })

                    ->orWhereHas('account', function ($q3) use ($query) {
                        $q3->whereTranslationLike('name', "%{$query}%");
                    })
                    ->orWhere('acc_report_type_id', 'like', "%{$query}%")
                    ->orWhere('acc_debit', 'like', "%{$query}%")
                    ->orWhere('acc_credit', 'like', "%{$query}%")
                    ->orWhere('status', 'like', "%{$query}%")
                    ->orWhere('acc_balance', 'like', "%{$query}%");
            })
            ->with(['acc_type', 'acc_report_type','account'])->orderBy('id', 'desc')->get();

        // if you use accessors like $Fund->actions, include them
        return response()->json($data);
    }


    public function getReport($request)
    {
        $query = Account::all();

        return $query; // مهم جداً: الحصول على البيانات الفعلية

    }

    public function reportExport(Request $request)
    {

        $data = $this->getReport($request);
        return view($this->view_path . '.report_export')
            ->with('isPdf', false)
            ->with('data', $data);
    }

    public function export(Request $request)
    {

        $data = $this->getReport($request);

        $report = new AccountExports($data, $request);

        return $report->generatePdf();

    }

    public function exportExcel(Request $request)
    {
        $data = $this->getReport($request);
        return Excel::download(
            new AccountExports(
                $data
                , $request
            ),
            'accounting_guide_' . now() . '.xlsx'
        );
    }
}
