<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Activity;
use App\Models\Admin;
use App\Models\AdminEnterprise;
use App\Models\Bill;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\DailyEntry;
use App\Models\ElectronicInvoice;
use App\Models\Enterprise;
use App\Models\ExchangeBond;
use App\Models\Inventory;
use App\Models\ModelHasRole;
use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\ReceiveBond;
use App\Models\Sale;
use App\Models\Store;
use App\Models\Supplier;
use App\Models\User;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class DashboardController extends Controller
{

    public function Appointment()
    {
        $dates = collect();
        $posts = Sale::groupBy('created_at')
            ->orderBy('created_at')
            ->get([
                DB::raw('DATE( created_at ) as date'),
                DB::raw('COUNT( * ) as "count"')
            ])
            ->pluck('count', 'date');
        $dates = $dates->merge($posts);
        $rep = [
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
        ];
        foreach ($dates as $key => $value) {
            $rep[Carbon::create($key)->dayOfWeek] += $value;
        }
        return $rep;
    }



    public function index()
    {



        $daysName = [
            0 => Lang::get('admin.SUN'),
            1 => Lang::get('admin.MON'),
            2 => Lang::get('admin.TUE'),
            3 => Lang::get('admin.WED'),
            4 => Lang::get('admin.THU'),
            5 => Lang::get('admin.FRI'),
            6 => Lang::get('admin.SAT'),
        ];
        $weekday = $daysName[Carbon::now()->dayOfWeek];
        $user = Auth::user();

        $product = Product::count();
        $purchases_invoice = Bill::whereIn('bill_type_id',[2,3])->count();
        $sales_invoice = Bill::whereIn('bill_type_id',[1,4])->count();
        $inventoryValue = DB::table('inventories')
            ->selectRaw('SUM((quantity_in - quantity_out) * price) as total')
            ->value('total');
        $totalIn  = Inventory::sum('quantity_in');
        $totalOut = Inventory::sum('quantity_out');

        $stockQty = $totalIn - $totalOut;
        $lastMovements = Inventory::with('product')
            ->latest()
            ->limit(5)
            ->get();

        return view('/dashboard', array(

            'product' => $product,
            'inventoryValue' => $inventoryValue,
            'purchases_invoice'=>$purchases_invoice,
            'sales_invoice'=>$sales_invoice,
            'totalIn'=>$totalIn,
            'totalOut'=>$totalOut,
            'stockQty'=>$stockQty,
'lastMovements'=>$lastMovements,


//            'admin_enterprise' => $this->Appointment(),

        ));
    }

}
