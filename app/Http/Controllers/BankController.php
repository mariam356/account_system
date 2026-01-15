<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\BankTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    public function index(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;

        $data = new Bank();

        $data = $data->orderBy('id', 'desc');


        $data_count = $data->count();

        return view('managements.system_setting.bank.index')
            ->with('data', $data->paginate($table_length))
            ->with('account', Account::where('acc_type_id', 2)->where('status', 1)->where('branch_id', Auth::user()->branch_id)->get())

            ->with('pagination_links', [
                'table_length' =>
                    isset($_GET['table_length']) ? $_GET['table_length'] : '',
            ])
            ->with('data_count', $data_count);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Bank::query()
            ->when($query, function($q) use ($query) {
                 $q->whereTranslationLike('name', "%{$query}%")
                     ->orWhereHas('account', function ($q1) use ($query) {
                         $q1->whereTranslationLike('name', "%{$query}%");
                     });
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $Bank->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);




        $Bank = new Bank();
        $Bank->account_id = $request->account_id;


        $Bank->save();
        $Bank->translateOrNew('ar')->name = $request->name_ar;
        $Bank->translateOrNew('en')->name = $request->name_en;

        $Bank->save();



        return response()->json([
            'status' => 200,
            'Bank' => $Bank,
            'title' => Lang::get('admin.added'),
            'message' => Lang::get('admin.added_successfully'),
        ]);
    }

    public function validatedData($request, $required = 'required')
    {
        return Validator::make(
            $request->all(), [

            'name_ar' => [$required],
            'name_en' => [$required],
            'account_id' => [$required],


        ]);
    }

    public function edit($id)
    {
        $Bank = Bank::find($id);
        $Bank_ar = BankTranslation::where('bank_id', '=', $id)->where('locale', 'ar')->first();
        $Bank_en = BankTranslation::where('bank_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $Bank->id,
            'name_ar' => $Bank_ar->name,
            'name_en' => $Bank_en->name,
            'account_id' => $Bank->account_id,


        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        $validatedData = $this->validatedData($request, 'nullable');
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);


        $Bank = Bank::find($id);

        $Bank->account_id = $request->account_id;

        $Bank->save();


        $Bank->translateOrNew('ar')->name = $request->name_ar;
        $Bank->translateOrNew('en')->name = $request->name_en;


        return response()->json([
            'status' => 200,
            'Bank' => $Bank,
            'title' => Lang::get('admin.updated'),
            'message' => Lang::get('admin.edited_successfully'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Bank::find($id)->delete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Bank::count()
        ],
            200
        );
    }
}
