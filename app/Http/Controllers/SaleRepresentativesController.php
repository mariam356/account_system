<?php

namespace App\Http\Controllers;

use App\Models\SaleRepresentative;
use App\Models\SaleRepresentativeTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SaleRepresentativesController extends Controller
{
    public function index(Request $request)
    {

        return view('managements.sales.sale_representative.index');
    }

    public function show(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;
        $sale_representatives = SaleRepresentative::where('branch_id',Auth::user()->branch_id)->orderBy('id', 'desc')->paginate($table_length);
        return response()->json($sale_representatives);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\SaleRepresentative::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%")
                    ->orWhere('commission', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $sale_representatives->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);


        $sale_representative = new SaleRepresentative();
        $sale_representative->commission = $request->commission;
        $sale_representative->branch_id = Auth::user()->branch_id;
        $sale_representative->email = $request->email;
        $sale_representative->phone = $request->phone;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'accounting_system_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/Sale_Representative/'), $imageName);
            $sale_representative->image = 'Sale_Representative/' . $imageName ?? null;
        }


        $sale_representative->save();


        $sale_representative->translateOrNew('ar')->name = $request->name_ar;
        $sale_representative->translateOrNew('en')->name = $request->name_en;

        $sale_representative->save();



        return response()->json([
            'status' => 200,
            'sale_representative' => $sale_representative,
            'title' => Lang::get('admin.added'),
            'message' => Lang::get('admin.added_successfully'),
        ]);
    }

    public function validatedData($request, $required = 'required')
    {
        return Validator::make(
            $request->all(), [

            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name_ar' => [$required],
            'name_en' => [$required],
            'commission' =>['required', 'numeric'],
            'email' => [
                'required',
                'email',
                Rule::unique('sale_representatives', 'email')->ignore($request->id),
            ],
            'phone' => [$required],

        ]);
    }

    public function edit($id)
    {
        $sale_representative = SaleRepresentative::find($id);
        $sale_representative_ar = SaleRepresentativeTranslation::where('sale_representative_id', '=', $id)->where('locale', 'ar')->first();
        $sale_representative_en = SaleRepresentativeTranslation::where('sale_representative_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $sale_representative->id,
            'name_ar' => $sale_representative_ar->name,
            'name_en' => $sale_representative_en->name,
            'email' => $sale_representative->email,
            'phone' => $sale_representative->phone,
            'commission' => $sale_representative->commission,

            'image' => asset('storage') . '/' . $sale_representative->image,


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


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'accounting_system' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/Sale_Representative/'), $imageName);
            $filename = public_path() . '/' . SaleRepresentative::where('id', '=', $id)->get()->first()->image;
            File::delete($filename);
        }

        $sale_representative = SaleRepresentative::find($id);

        if ($request->hasFile('image')) {
            $sale_representative->image = 'Sale_Representative/' . $imageName;
        }


        $sale_representative->commission = $request->commission;

        $sale_representative->email = $request->email;
        $sale_representative->phone = $request->phone;


        $sale_representative->save();


        $sale_representative->translateOrNew('ar')->name = $request->name_ar;
        $sale_representative->translateOrNew('en')->name = $request->name_en;

        $sale_representative->save();


        return response()->json([
            'status' => 200,
            'sale_representative' => $sale_representative,
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
        SaleRepresentative::find($id)->forceDelete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => SaleRepresentative::count()
        ],
            200
        );
    }
}
