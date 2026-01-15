<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\UnitTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function index(Request $request)
    {

        return view('managements.stores.units.index');
    }

    public function show(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;
        $units = Unit::orderBy('id', 'desc')->paginate($table_length);
        return response()->json($units);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Unit::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%");
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $units->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);




        $units = new Unit();


        $units->conversion_factor = $request->conversion_factor;
        $units->save();


        $units->translateOrNew('ar')->name = $request->name_ar;
        $units->translateOrNew('en')->name = $request->name_en;

        $units->save();



        return response()->json([
            'status' => 200,
            'units' => $units,
            'title' => Lang::get('admin.added'),
            'message' => Lang::get('admin.added_successfully'),
        ]);
    }

    public function validatedData($request, $required = 'required')
    {
        return Validator::make(
            $request->all(), [

            'conversion_factor' => [$required],
            'name_ar' => [$required],
            'name_en' => [$required],


        ]);
    }

    public function edit($id)
    {
        $units = Unit::find($id);
        $units_ar = UnitTranslation::where('unit_id', '=', $id)->where('locale', 'ar')->first();
        $units_en = UnitTranslation::where('unit_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $units->id,
            'name_ar' => $units_ar->name,
            'name_en' => $units_en->name,
            'conversion_factor' => $units->conversion_factor,


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


        $units = Unit::find($id);


        $units->conversion_factor = $request->conversion_factor;

        $units->save();


        $units->translateOrNew('ar')->name = $request->name_ar;
        $units->translateOrNew('en')->name = $request->name_en;

        $units->save();


        return response()->json([
            'status' => 200,
            'units' => $units,
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
        Unit::find($id)->delete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Unit::count()
        ],
            200
        );
    }
}
