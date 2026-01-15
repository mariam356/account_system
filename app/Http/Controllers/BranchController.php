<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\BranchTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;

        $data = new Branch();

        $data = $data->orderBy('id', 'desc');


        $data_count = $data->count();

        return view('managements.system_setting.branch.index')
            ->with('data', $data->paginate($table_length))
            ->with('pagination_links', [
                'table_length' =>
                    isset($_GET['table_length']) ? $_GET['table_length'] : '',
            ])
            ->with('data_count', $data_count);
    }

    public function show(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;
        $branches = Branch::orderBy('id', 'desc')->paginate($table_length);
        return response()->json($branches);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Branch::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%")
                    ->orwhereTranslationLike('address', "%{$query}%")
                    ->orWhere('activity', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%")
                    ->orWhere('fax', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $branch->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);




        $branch = new Branch();
        $branch->activity = $request->activity;

        $branch->fax = $request->fax;
        $branch->email = $request->email;
        $branch->phone = $request->phone;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'accounting_system_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/branch/'), $imageName);
            $branch->image = 'branch/' . $imageName ?? null;
        }


        $branch->save();


        $branch->translateOrNew('ar')->name = $request->name_ar;
        $branch->translateOrNew('en')->name = $request->name_en;

        $branch->translateOrNew('ar')->address = $request->address_ar;
        $branch->translateOrNew('en')->address = $request->address_en;
        $branch->save();



        return response()->json([
            'status' => 200,
            'branch' => $branch,
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
            'activity' => [$required],
            'email' => [
                'required',
                'email',
                Rule::unique('branches', 'email')->ignore($request->id),
            ],
            'phone' => [$required],

        ]);
    }

    public function edit($id)
    {
        $branch = Branch::find($id);
        $branch_ar = BranchTranslation::where('branch_id', '=', $id)->where('locale', 'ar')->first();
        $branch_en = BranchTranslation::where('branch_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $branch->id,
            'name_ar' => $branch_ar->name,
            'name_en' => $branch_en->name,
            'address_ar' => $branch_ar->address,
            'address_en' => $branch_en->address,

            'email' => $branch->email,
            'phone' => $branch->phone,
            'fax' => $branch->fax,
            'activity' => $branch->activity,

            'image' => asset('storage') . '/' . $branch->image,


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
            $image->move(public_path('storage/branch/'), $imageName);
            $filename = public_path() . '/' . Branch::where('id', '=', $id)->get()->first()->image;
            File::delete($filename);
        }

        $branch = Branch::find($id);

        if ($request->hasFile('image')) {
            $branch->image = 'branch/' . $imageName;
        }


        $branch->activity = $request->activity;

        $branch->fax = $request->fax;
        $branch->email = $request->email;
        $branch->phone = $request->phone;


        $branch->save();


        $branch->translateOrNew('ar')->name = $request->name_ar;
        $branch->translateOrNew('en')->name = $request->name_en;

        $branch->translateOrNew('ar')->address = $request->address_ar;
        $branch->translateOrNew('en')->address = $request->address_en;
        $branch->save();


        return response()->json([
            'status' => 200,
            'branch' => $branch,
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
        Branch::find($id)->forceDelete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Branch::count()
        ],
            200
        );
    }
}
