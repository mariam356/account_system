<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        return view('managements.stores.categories.index');
    }

    public function show(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;
        $categories = Category::orderBy('id', 'desc')->paginate($table_length);
        return response()->json($categories);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Category::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%");
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $categories->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);




        $categories = new Category();

        $categories->status = $request->input('status', 1);
        $categories->save();


        $categories->translateOrNew('ar')->name = $request->name_ar;
        $categories->translateOrNew('en')->name = $request->name_en;

        $categories->save();



        return response()->json([
            'status' => 200,
            'categories' => $categories,
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


        ]);
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        $categories_ar = CategoryTranslation::where('category_id', '=', $id)->where('locale', 'ar')->first();
        $categories_en = CategoryTranslation::where('category_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $categories->id,
            'name_ar' => $categories_ar->name,
            'name_en' => $categories_en->name,
            'status' => $categories->status,


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


        $categories = Category::find($id);


        $categories->status = $request->input('status', 1);

        $categories->save();


        $categories->translateOrNew('ar')->name = $request->name_ar;
        $categories->translateOrNew('en')->name = $request->name_en;

        $categories->save();


        return response()->json([
            'status' => 200,
            'categories' => $categories,
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
        Category::find($id)->delete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Category::count()
        ],
            200
        );
    }
}
