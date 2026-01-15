<?php


namespace App\Exports;

use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;
use Illuminate\Http\Request;

class ProfitLossExports
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
            __('admin.balance'),


        ];
    }

    public function map($report): array
    {


        return [


            $report->account->name ?? '',
            $report->total_debit ?? '',
            $report->total_credit ?? '',
            $report->balance ?? '',


        ];
    }


    public function generatePdf()
    {
        $mappedData = collect($this->data)->map(function($item) {
            return (object) $item;
        });



        $pdf = PDF::loadView('managements.accounts.profit_loss.report_export', [
            'headings' => $this->headings(),
            'data' => $mappedData,
            'title' => __('admin.profit_loss'),
            'request' => $this->request,
            'isPdf' => true
        ]);


        return $pdf->download('profit_loss_' . now()->format('Y-m-d') . '.pdf');
    }
}
