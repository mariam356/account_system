<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StoreController extends Controller
{
    public function index(Request $request)
    {

        return view('managements.stores.stores.index');
    }

    public function show(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;
        $stores = Store::orderBy('id', 'desc')->paginate($table_length);
        return response()->json($stores);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Store::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%")
                    ->orwhereTranslationLike('manager_name', "%{$query}%")
                    ->orwhereTranslationLike('address', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $stores->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);




        $stores = new Store();

        $stores->status = $request->input('status', 1);
        $stores->phone = $request->phone;


        $stores->save();


        $stores->translateOrNew('ar')->name = $request->name_ar;
        $stores->translateOrNew('en')->name = $request->name_en;

        $stores->translateOrNew('ar')->address = $request->address_ar;
        $stores->translateOrNew('en')->address = $request->address_en;

        $stores->translateOrNew('ar')->manager_name = $request->manager_name_ar;
        $stores->translateOrNew('en')->manager_name = $request->manager_name_en;
        $stores->save();



        return response()->json([
            'status' => 200,
            'stores' => $stores,
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


            'phone' => [$required],

        ]);
    }

    public function edit($id)
    {
        $stores = Store::find($id);
        $stores_ar = StoreTranslation::where('store_id', '=', $id)->where('locale', 'ar')->first();
        $stores_en = StoreTranslation::where('store_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $stores->id,
            'name_ar' => $stores_ar->name,
            'name_en' => $stores_en->name,
            'address_ar' => $stores_ar->address,
            'address_en' => $stores_en->address,

            'manager_name_ar' => $stores_ar->manager_name,
            'manager_name_en' => $stores_en->manager_name,
            'phone' => $stores->phone,

            'status' => $stores->status,


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


        $stores = Store::find($id);


        $stores->status = $request->input('status', 1);
        $stores->phone = $request->phone;


        $stores->save();


        $stores->translateOrNew('ar')->name = $request->name_ar;
        $stores->translateOrNew('en')->name = $request->name_en;

        $stores->translateOrNew('ar')->address = $request->address_ar;
        $stores->translateOrNew('en')->address = $request->address_en;

        $stores->translateOrNew('ar')->manager_name = $request->manager_name_ar;
        $stores->translateOrNew('en')->manager_name = $request->manager_name_en;
        $stores->save();


        return response()->json([
            'status' => 200,
            'stores' => $stores,
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
        Store::find($id)->delete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Store::count()
        ],
            200
        );
    }
}
