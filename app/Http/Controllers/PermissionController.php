<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\ModelHasRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        return view('managements.file.permission.index');

    }

    public function display(Request $request)
    {
        $table_length = $request->get('table_length', 10);

        $data = Role::where('name', '!=', 'user_administrator')->where('branch_id', Auth::user()->branch_id)
            ->where('guard_name', 'user')
            ->paginate($table_length);

        return response()->json($data);
    }



    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = Role::query()->
            where('name', '!=', 'user_administrator')->where('branch_id', Auth::user()->branch_id)
                ->where('guard_name', 'user')
            ->when($query, function ($q) use ($query) {
                $q->where('name','like', "%{$query}%")
                    ->orWhere('created_at', 'like', "%{$query}%")
                    ->orWhere('updated_at', 'like', "%{$query}%");
            })
            ->get();

        // if you use accessors like $Journal->actions, include them
        return response()->json($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $user = Auth::user();
        $permissions = Role::where('name', '!=', 'user_administrator')->where('guard_name', 'user');

        $permissions->where('branch_id', $user->branch_id);


        return view('managements.file.permission.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'role' => 'required|string|max:191|min:2|unique:roles,name',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $role = Role::create([
            'name' =>  Auth::user()->branch->name . '_' . $request->role,
            'branch_id' => Auth::user()->branch_id,
            'guard_name' => 'user'
        ]);
        $role->syncPermissions($request->permission);
//        Cache::tags(['permissions'])->flush();
        return redirect()->route('permission')->with('success', Lang::get('admin.added_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permission = $role->getPermissionNames();
        return view('managements.file.permission.show')
            ->with('permission', $permission)
            ->with('role', $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $role = Role::where('name', '!=', 'user_administrator')->find($id);
        $permission = $role->getPermissionNames();
        return view('managements.file.permission.edit')
            ->with('permission', $permission)
            ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
//        $role = Role::find($id);
        $role = Role::where('name', '!=', 'user_administrator')->find($id);

        if ($role->name != $request->role) {
            $validator = Validator::make($request->all(), [
                'role' => 'required|string|max:191|min:2|unique:roles,name',

            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
        $validator = Validator::make($request->all(), [
            'role' => 'required|string|max:191|min:2',

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $role->syncPermissions($request->permission);
        $role->name =  Auth::user()->enterprise_name . '_' . $request->role;
//        Cache::tags(['permissions'])->flush();
        $role->save();
        return redirect()->route('permission')->with('success', Lang::get('admin.edited_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy($id)
    {

        $package_enterprise = ModelHasRole::where('role_id', $id)->count();
        if ($package_enterprise > 0) {
            return response()->json([
                'error_delete' => Lang::get('admin.Sorry_you_cannot_delete_this_record_because_it_has_other_links')
            ], 401);
        }


        Package::where('id', $id)->delete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
        ]);
    }
}

