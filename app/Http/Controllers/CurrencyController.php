<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\CurrencyTranslation;
use App\Models\CurrencyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;

        $data = new Currency();

        $data = $data->orderBy('id', 'desc');

        $currency_type = CurrencyType::orderBy('id', 'desc')->get();
        $data_count = $data->count();

        return view('managements.system_setting.currency.index')
            ->with('currency_type', $currency_type)
            ->with('data', $data->paginate($table_length))
            ->with('pagination_links', [
                'table_length' =>
                    isset($_GET['table_length']) ? $_GET['table_length'] : '',
            ])
            ->with('data_count', $data_count);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Currency::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%")
                    ->orWhere('symbol', 'like', "%{$query}%")
                    ->orWhere('curr_val', 'like', "%{$query}%")
                    ->orWhere('curr_penny', 'like', "%{$query}%")
                    ->orWhereHas('currency_type', function ($q2) use ($query) {
                        $q2->whereTranslationLike('name', "%{$query}%");
                    });
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $Currency->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);

        $Currency = new Currency();
        $Currency->symbol = $request->symbol;

        $Currency->currency_type_id = $request->currency_type_id;
        $Currency->curr_val = $request->curr_val;
        $Currency->curr_penny = $request->curr_penny;


        $Currency->save();


        $Currency->translateOrNew('ar')->name = $request->name_ar;
        $Currency->translateOrNew('en')->name = $request->name_en;

        $Currency->save();



        return response()->json([
            'status' => 200,
            'Currency' => $Currency,
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
            'symbol' => [$required],
            'curr_val' => [$required],
            'curr_penny' => [$required],
            'currency_type_id' => [$required],

        ]);
    }

    public function edit($id)
    {
        $Currency = Currency::find($id);
        $Currency_ar = CurrencyTranslation::where('currency_id', '=', $id)->where('locale', 'ar')->first();
        $Currency_en = CurrencyTranslation::where('currency_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $Currency->id,
            'name_ar' => $Currency_ar->name,
            'name_en' => $Currency_en->name,
            'email' => $Currency->email,
            'symbol' => $Currency->symbol,
            'currency_type_id' => $Currency->currency_type_id,
            'curr_val' => $Currency->curr_val,
            'curr_penny' => $Currency->curr_penny,


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


        $Currency = Currency::find($id);
        $Currency->symbol = $request->symbol;

        $Currency->currency_type_id = $request->currency_type_id;
        $Currency->curr_val = $request->curr_val;
        $Currency->curr_penny = $request->curr_penny;


        $Currency->save();


        $Currency->translateOrNew('ar')->name = $request->name_ar;
        $Currency->translateOrNew('en')->name = $request->name_en;

        $Currency->save();


        return response()->json([
            'status' => 200,
            'Currency' => $Currency,
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
        Currency::find($id)->delete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Currency::count()
        ],
            200
        );
    }
}
