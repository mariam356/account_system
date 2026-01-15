<?php

namespace App\Http\Controllers;

use App\Exports\BondExports;
use App\Models\Account;
use App\Models\Bond;
use App\Models\BondDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReceiveBondReportController extends Controller
{
    public $view_path = 'managements.accounts.receive_bond.';


    public function index(Request $request)
    {
        $table_length = $request->get('table_length', 10);
        if (empty($table_length)) $table_length = 10;

// 1. استقبال الـ IDs وتحويلها لمصفوفة
        $ids = $request->has('ids') ? explode(',', $request->ids) : [];


        $query = BondDetail::query()->with('bond','account'); // افترضنا وجود علاقة اسمها receive_bond

        if (!empty($ids)) {

            $query->whereIn('bond_id', $ids);
        }

        $data = $query->orderBy('id', 'desc');

        $results = $data->paginate($table_length);

        return view($this->view_path . 'report')
            ->with('data', $results)
            ->with('pagination_links', ['table_length' => $table_length])
            ->with('data_count', $results->total());
    }

    // دالة خاصة لجلب البيانات لتستخدمها في الـ API وفي الـ View
    private function getBondData(Request $request)
    {
        $ids = $request->has('ids') ? explode(',', $request->ids) : [];

        if (empty($ids)) return collect();

        return BondDetail::with(['account', 'bond', 'currency'])
            ->whereIn('bond_id', $ids)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function show(Request $request)
    {
        // هنا نعيد JSON للـ Vue
        return response()->json($this->getBondData($request));
    }

    public function reportExport(Request $request)
    {
        // هنا نعيد المصفوفة مباشرة للـ Blade
        $data = $this->getBondData($request);

        return view($this->view_path . '.report_export')
            ->with('data', $data)
            ->with('request', $request)
            ->with('isPdf', false);
    }

    public function export(Request $request)
    {

        $data = $this->getBondData($request);

        $report = new BondExports($data, $request);

        return $report->generatePdf();

    }

    public function exportExcel(Request $request)
    {
        $data = $this->getBondData($request);
        return Excel::download(
            new BondExports(
                $data
                , $request
            ),
            'journal_' . now() . '.xlsx'
        );
    }
}
