<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {


        return view('managements.stores.product.index')
            ->with('category', Category::where('status',1)->get())
            ->with('unit', Unit::get());
    }

    public function show(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;
        $product = Product::orderBy('id', 'desc')->paginate($table_length);
        return response()->json($product);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Product::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%")
                    ->orWhereHas('category', function ($q1) use ($query) {
                        $q1->whereTranslationLike('name', "%{$query}%");
                    })
                    ->orWhereHas('unit', function ($q1) use ($query) {
                        $q1->whereTranslationLike('name', "%{$query}%");
                    })
                    ->orWhere('price', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $product->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);


        $product = new Product();
        $product->category_id = $request->category_id;

        $product->unit_id = $request->unit_id;
        $product->price = $request->price;
        $product->status =  $request->input('status', 1);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'accounting_system_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/product/'), $imageName);
            $product->image = 'Product/' . $imageName ?? null;
        }


        $product->save();


        $product->translateOrNew('ar')->name = $request->name_ar;
        $product->translateOrNew('en')->name = $request->name_en;

        $product->save();



        return response()->json([
            'status' => 200,
            'product' => $product,
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
            'category_id' => [$required],
            'price' => [$required],
            'unit_id' => [$required],

        ]);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $product_ar = ProductTranslation::where('product_id', '=', $id)->where('locale', 'ar')->first();
        $product_en = ProductTranslation::where('product_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $product->id,
            'name_ar' => $product_ar->name,
            'name_en' => $product_en->name,
            'category_id' => $product->category_id,
            'unit_id' => $product->unit_id,
            'price' => $product->price,
            'status' => $product->status,

            'image' => asset('storage') . '/' . $product->image,


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
            $image->move(public_path('storage/product/'), $imageName);
            $filename = public_path() . '/' . Product::where('id', '=', $id)->get()->first()->image;
            File::delete($filename);
        }

        $product = Product::find($id);

        if ($request->hasFile('image')) {
            $product->image = 'product/' . $imageName;
        }


        $product->category_id = $request->category_id;

        $product->unit_id = $request->unit_id;
        $product->price = $request->price;
        $product->status =  $request->input('status', 1);

        $product->save();


        $product->translateOrNew('ar')->name = $request->name_ar;
        $product->translateOrNew('en')->name = $request->name_en;

        $product->save();




        return response()->json([
            'status' => 200,
            'product' => $product,
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
        Product::find($id)->delete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Product::count()
        ],
            200
        );
    }
}
