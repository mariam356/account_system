<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTranslation;
use App\Models\AccReportType;
use App\Models\AccType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class AccountController extends Controller
{
    public $view_path = 'managements.accounts.accounting_guide.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $AccReportTypeQuery = AccReportType::orderBy('id', 'desc')->get();
        $AccTypeQuery = AccType::orderBy('id', 'desc')->get();
        return view($this->view_path . 'index', compact('AccReportTypeQuery', 'AccTypeQuery'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function treeBuilding()
    {


        $dataQuery = Account::where('branch_id',Auth::user()->branch_id)->select(DB::raw('count(*) as ranks_count, ranks'))
            ->groupBy('ranks');


        $rank = $dataQuery->get();

        $i = 0;
        $accounting_guide = [];

        foreach ($rank as $ranks) {

            $accounting_guide[$i] = Account::where('ranks', $ranks->ranks)->get()->toArray();
            $i++;

        }

        return response()->json([
            'account' => $accounting_guide
        ]);


    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'acc_type_id' => 'required',
            'acc_report_type_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',

            'acc_code' => 'required|unique:accounts,acc_code',
            'acc_level' => 'required|unique:accounts,acc_level',

        ]);


        DB::transaction(function () use ($request, &$accounting_guide) {

            $accounting_guide = new Account();


            $accounting_guide->acc_type_id = $request->acc_type_id;

            $accounting_guide->acc_code = $request->acc_code;
            $accounting_guide->acc_level = $request->acc_level;
            $accounting_guide->acc_debit = $request->acc_debit;
            $accounting_guide->acc_credit = $request->acc_credit;
            $accounting_guide->acc_balance = $request->acc_balance;
            $accounting_guide->acc_report_type_id = $request->acc_report_type_id;
            $accounting_guide->status = $request->status;
            $accounting_guide->branch_id = Auth::user()->branch_id;
            $accounting_guide->ranks = $request->ranks + 1;
            if ($request->account_id != 0) {
                $accounting_guide->account_id = $request->account_id;
            }
            $accounting_guide->save();

            $accounting_guide->translateOrNew('ar')->name = $request->name_ar;
            $accounting_guide->translateOrNew('en')->name = $request->name_en;
            $accounting_guide->save();


        });
        return response()->json([
            'status' => 200,
            'accounting_guide' => $accounting_guide,
            'title' => Lang::get('admin.added'),
            'message' => Lang::get('admin.added_successfully'),
        ]);
    }




    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {

        $account = Account::find($id);

        $account_ar = AccountTranslation::where('account_id', '=', $id)->where('locale', 'ar')->first();
        $account_en = AccountTranslation::where('account_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $account->id,
            'name_ar' => $account_ar->name,
            'name_en' => $account_en->name,


            'acc_code' => $account->acc_code,
            'acc_balance' => $account->acc_balance,
            'acc_debit' => $account->acc_debit,
            'acc_type_id' => $account->acc_type_id,
            'status' => $account->status,
            'acc_level' => $account->acc_level,
            'acc_report_type_id' => $account->acc_report_type_id,

            'acc_credit' => $account->acc_credit,
            'created_at' => Carbon::Parse($account->created_at)->format('Y/m/d'),
            'updated_at' => Carbon::Parse($account->updated_at)->format('Y/m/d'),


        ]);
    }


    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'acc_type_id' => 'required',
            'acc_report_type_id' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',

            'acc_code' => 'required|unique:accounts,acc_code,'. $request->id,
            'acc_level' => 'required|unique:accounts,acc_level,'. $request->id,

        ]);


        $accounting_guide = Account::find($request->id);


        $accounting_guide->acc_type_id = $request->acc_type_id;

        $accounting_guide->acc_code = $request->acc_code;
        $accounting_guide->acc_level = $request->acc_level;
        $accounting_guide->acc_debit = $request->acc_debit;
        $accounting_guide->acc_credit = $request->acc_credit;
        $accounting_guide->acc_balance = $request->acc_balance;
        $accounting_guide->status = $request->status;
        $accounting_guide->acc_report_type_id = $request->acc_report_type_id;
        $accounting_guide->branch_id = Auth::user()->branch_id;

        $accounting_guide->save();

        $accounting_guide->translateOrNew('ar')->name = $request->name_ar;
        $accounting_guide->translateOrNew('en')->name = $request->name_en;
        $accounting_guide->save();



        return response()->json([
            'status' => 200,
            'accounting_guide' => $accounting_guide,
            'title' => Lang::get('admin.added'),
            'message' => Lang::get('admin.added_successfully'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $accounting_guide = Account::find($request->items_id);

        $accounting_guide->deleteTranslations();
        $result = $accounting_guide->delete();

        if ($result == 0) {
            $result = 'عذراً. لم يتم تحديد اي عنصر ';
            return response()->json(['message' => $result], 401);
        }

//        $result = ' تم حذف ' . $result . ' عنصر بنجاح.';
        $result = Lang::get('admin.deleted_successfully');
        return response()->json(['message' => $result], 200);

    }


}
