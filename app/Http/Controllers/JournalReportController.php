<?php

namespace App\Http\Controllers;

use App\Exports\JournalExports;

use App\Models\JournalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class JournalReportController extends Controller
{
    public $view_path = 'managements.accounts.journal.';


    public function index(Request $request)
    {
        $table_length = $request->get('table_length', 10);
        if (empty($table_length)) $table_length = 10;

// 1. استقبال الـ IDs وتحويلها لمصفوفة
        $ids = $request->has('ids') ? explode(',', $request->ids) : [];


        $query = JournalDetail::query()->with('journal','account'); // افترضنا وجود علاقة اسمها journal

        if (!empty($ids)) {

            $query->whereIn('journal_id', $ids);
        }

        $data = $query->orderBy('id', 'desc');

        $results = $data->paginate($table_length);

        return view($this->view_path . 'report')
            ->with('data', $results)
            ->with('pagination_links', ['table_length' => $table_length])
            ->with('data_count', $results->total());
    }

    // دالة خاصة لجلب البيانات لتستخدمها في الـ API وفي الـ View
    private function getJournalData(Request $request)
    {
        $ids = $request->has('ids') ? explode(',', $request->ids) : [];

        if (empty($ids)) return collect();

        return JournalDetail::with(['account', 'journal', 'currency'])
            ->whereIn('journal_id', $ids)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function show(Request $request)
    {
        // هنا نعيد JSON للـ Vue
        return response()->json($this->getJournalData($request));
    }

    public function reportExport(Request $request)
    {
        // هنا نعيد المصفوفة مباشرة للـ Blade
        $data = $this->getJournalData($request);

        return view($this->view_path . '.report_export')
            ->with('data', $data)
            ->with('request', $request)
            ->with('isPdf', false);
    }

    public function export(Request $request)
    {

        $data = $this->getJournalData($request);

        $report = new JournalExports($data, $request);

        return $report->generatePdf();

    }

    public function exportExcel(Request $request)
    {
        $data = $this->getJournalData($request);
        return Excel::download(
            new JournalExports(
                $data
                , $request
            ),
            'journal_' . now() . '.xlsx'
        );
    }
}
