<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\SupplierTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index(Request $request)
    {


        return view('managements.purchases.suppliers.index');
    }

    public function show(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;
        $suppliers = Supplier::where('branch_id',Auth::user()->branch_id)->orderBy('id', 'desc')->paginate($table_length);
        return response()->json($suppliers);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Supplier::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%")

                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $suppliers->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);




        $suppliers = new Supplier();
        $suppliers->branch_id = Auth::user()->branch_id;
        $suppliers->email = $request->email;
        $suppliers->phone = $request->phone;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'accounting_system_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/Supplier/'), $imageName);
            $suppliers->image = 'Supplier/' . $imageName ?? null;
        }


        $suppliers->save();


        $suppliers->translateOrNew('ar')->name = $request->name_ar;
        $suppliers->translateOrNew('en')->name = $request->name_en;

        $suppliers->save();



        return response()->json([
            'status' => 200,
            'suppliers' => $suppliers,
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

            'email' => [
                'required',
                'email',
                Rule::unique('suppliers', 'email')->ignore($request->id),
            ],
            'phone' => [$required],

        ]);
    }

    public function edit($id)
    {
        $suppliers = Supplier::find($id);
        $suppliers_ar = SupplierTranslation::where('Supplier_id', '=', $id)->where('locale', 'ar')->first();
        $suppliers_en = SupplierTranslation::where('Supplier_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $suppliers->id,
            'name_ar' => $suppliers_ar->name,
            'name_en' => $suppliers_en->name,
            'email' => $suppliers->email,
            'phone' => $suppliers->phone,


            'image' => asset('storage') . '/' . $suppliers->image,


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
            $image->move(public_path('storage/Supplier/'), $imageName);
            $filename = public_path() . '/' . Supplier::where('id', '=', $id)->get()->first()->image;
            File::delete($filename);
        }

        $suppliers = Supplier::find($id);

        if ($request->hasFile('image')) {
            $suppliers->image = 'Supplier/' . $imageName;
        }


        $suppliers->email = $request->email;
        $suppliers->phone = $request->phone;


        $suppliers->save();


        $suppliers->translateOrNew('ar')->name = $request->name_ar;
        $suppliers->translateOrNew('en')->name = $request->name_en;

        $suppliers->save();


        return response()->json([
            'status' => 200,
            'suppliers' => $suppliers,
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
        Supplier::find($id)->forceDelete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Supplier::count()
        ],
            200
        );
    }
}
