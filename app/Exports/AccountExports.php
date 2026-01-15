<?php


namespace App\Exports;

use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;
use Illuminate\Http\Request;

class AccountExports
{
    public $data;
    protected $request;

    public function __construct($data, $request)
    {
        $this->data = $data; // يجب أن تكون Collection
        $this->request = $request;
    }

    public function headings(): array
    {
        return [
            __('admin.account_number'),
            __('admin.parent_account'),
            __('admin.name'),
            __('admin.level'),
            __('admin.account_type'),
            __('admin.account_report'),
            __('admin.balance'),
            __('admin.debit'),
            __('admin.creditor'),
            __('admin.status'),
        ];
    }

    public function map($report): array
    {

        if ($report->status == 1)
        {
            $status = "<i class='ft-unlock' style='color:#0679f0'></i>";
        }else
        {
            $status = "<i class='ft-lock' style='color:#0679f0'></i>";
        }

        return [

            $report->acc_code,
            $report->account_id,
            $report->name,
            $report->acc_level,
            $report->acc_type_id,
            $report->acc_report_type_id,
            $report->acc_balance,
            $report->acc_debit,
            $report->acc_credit,
            $status


        ];
    }


    public function generatePdf()
    {
        $mappedData = collect($this->data)->map(function($item) {
            return (object) $item;
        });



        $pdf = PDF::loadView('managements.accounts.accounting_guide.report_export', [
            'headings' => $this->headings(),
            'data' => $mappedData,
            'title' => __('admin.accounting_guide'),
            'request' => $this->request,
            'isPdf' => true
        ]);


        return $pdf->download('accounting_guide_' . now()->format('Y-m-d') . '.pdf');
    }
}
