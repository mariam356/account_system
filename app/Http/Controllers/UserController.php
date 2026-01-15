<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;

        $data = new User();
        $data = $data->where('branch_id',Auth::user()->branch_id)->where('id','!=',Auth::id())->orderBy('id', 'desc');


        $data_count = $data->count();

        return view('managements.file.users.index')
            ->with('role', Role::where('guard_name', 'user')->where(function ($q) {
                $q->where('branch_id', Auth::user()->branch_id);
            })->get())
            ->with('data', $data->paginate($table_length))
            ->with('pagination_links', [
                'table_length' =>
                    $_GET['table_length'] ?? '',
            ])
            ->with('data_count', $data_count);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\User::query()
            ->when($query, function($q) use ($query) {
                $q
                    ->orWhere('full_name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%")
                    ->orWhere('name', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $User->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);

        $User = new User();
        $User->full_name = $request->full_name;
        $User->password = bcrypt($request->password);
        $User->name = $request->name;
        $User->email = $request->email;
        $User->phone = $request->phone;
        $User->branch_id = Auth::user()->branch_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'accounting_system_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/User/'), $imageName);
            $User->image = 'User/' . $imageName ?? null;
        }
        $User->syncRoles($request->role_name);

        $User->save();




        return response()->json([
            'status' => 200,
            'User' => $User,
            'title' => Lang::get('admin.added'),
            'message' => Lang::get('admin.added_successfully'),
        ]);
    }

    public function validatedData($request, $required = 'required')
    {
        return Validator::make(
            $request->all(), [

            'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'name' => [$required],
            'full_name' => [$required],

            'email' => 'required|unique:users,email,'. $request->id,
            'phone' => [$required],

        ]);
    }

    public function edit($id)
    {
        $User = User::find($id);


        return response()->json([
            'id' => $User->id,
            'full_name' => $User->full_name,
            'name' => $User->name,
            'email' => $User->email,
            'phone' => $User->phone,

            'activity' => $User->activity,

            'image' => asset('storage') . '/' . $User->image,


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
            $image->move(public_path('storage/User/'), $imageName);
            $filename = public_path() . '/' . User::where('id', '=', $id)->get()->first()->image;
            File::delete($filename);
        }

        $User = User::find($id);

        if ($request->hasFile('image')) {
            $User->image = 'User/' . $imageName;
        }

        $User->full_name = $request->full_name;
        $User->password = bcrypt($request->password);
        $User->name = $request->name;
        $User->email = $request->email;
        $User->phone = $request->phone;
        $User->branch_id = Auth::user()->branch_id;
        $User->syncRoles($request->role_name);
        $User->save();

        return response()->json([
            'status' => 200,
            'User' => $User,
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
        User::find($id)->delete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => User::count()
        ],
            200
        );
    }
}
