<?php


namespace App\Exports;

use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;
use Illuminate\Http\Request;

class JournalExports
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
            __('admin.account_name'),
            __('admin.debit'),
            __('admin.creditor'),
            __('admin.note'),
            __('admin.currency'),

        ];
    }

    public function map($report): array
    {


        return [

            $report->account->acc_code ?? '',
            $report->account->name ?? '',
            $report->acc_debit,
            $report->acc_credit,
            $report->note,
            $report->currency->name ?? '',



        ];
    }


    public function generatePdf()
    {
        $mappedData = collect($this->data)->map(function($item) {
            return (object) $item;
        });



        $pdf = PDF::loadView('managements.accounts.journal.report_export', [
            'headings' => $this->headings(),
            'data' => $mappedData,
            'title' => __('admin.journal'),
            'request' => $this->request,
            'isPdf' => true
        ]);


        return $pdf->download('journal_' . now()->format('Y-m-d') . '.pdf');
    }
}
