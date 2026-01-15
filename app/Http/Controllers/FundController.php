<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Fund;
use App\Models\FundTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class FundController extends Controller
{
    public function index(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;

        $data = new Fund();

        $data = $data->orderBy('id', 'desc');


        $data_count = $data->count();

        return view('managements.system_setting.fund.index')
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

        $data = \App\Models\Fund::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%")
                    ->orWhereHas('account', function ($q1) use ($query) {
                        $q1->whereTranslationLike('name', "%{$query}%");
                    });
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $Fund->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);




        $Fund = new Fund();
        $Fund->account_id = $request->account_id;


        $Fund->save();
        $Fund->translateOrNew('ar')->name = $request->name_ar;
        $Fund->translateOrNew('en')->name = $request->name_en;

        $Fund->save();



        return response()->json([
            'status' => 200,
            'Fund' => $Fund,
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
        $Fund = Fund::find($id);
        $Fund_ar = FundTranslation::where('Fund_id', '=', $id)->where('locale', 'ar')->first();
        $Fund_en = FundTranslation::where('Fund_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $Fund->id,
            'name_ar' => $Fund_ar->name,
            'name_en' => $Fund_en->name,
            'account_id' => $Fund->account_id,


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


        $Fund = Fund::find($id);

        $Fund->account_id = $request->account_id;

        $Fund->save();


        $Fund->translateOrNew('ar')->name = $request->name_ar;
        $Fund->translateOrNew('en')->name = $request->name_en;


        return response()->json([
            'status' => 200,
            'Fund' => $Fund,
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

        Fund::find($id)->delete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Fund::count()
        ],
            200
        );
    }
}
