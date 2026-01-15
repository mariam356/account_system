<?php


namespace App\Exports;

use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;
use Illuminate\Http\Request;

class TrialBalanceExports
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

            __('admin.account_name'),
            __('admin.debit'),
            __('admin.creditor'),


        ];
    }

    public function map($report): array
    {

        $rawBalance = $report->total_debit - $report->total_credit;

        $balanceAfterCurrency = $rawBalance;
        return [


            $report->account->name ?? '',
            $balanceAfterCurrency >= 0 ? number_format($balanceAfterCurrency, 2) : '0.00',
            $balanceAfterCurrency < 0 ? number_format(abs($balanceAfterCurrency), 2) : '0.00',



        ];
    }


    public function generatePdf()
    {
        $mappedData = collect($this->data)->map(function($item) {
            return (object) $item;
        });



        $pdf = PDF::loadView('managements.accounts.trial_balance.report_export', [
            'headings' => $this->headings(),
            'data' => $mappedData,
            'title' => __('admin.trial_balance'),
            'request' => $this->request,
            'isPdf' => true
        ]);


        return $pdf->download('trial_balance_' . now()->format('Y-m-d') . '.pdf');
    }
}
