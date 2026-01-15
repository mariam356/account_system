<?php

namespace App\Http\Controllers;


use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    public function index()
    {

        return view('managements.profile_management.profile.index');
    }

    public function edit($id)
    {
        return view('managements.profile_management.profile.index')->with('profile', Auth::id());
    }

    public function update(Request $request)
    {
        if ($request->name == null && $request->email == null && $request->phone == null) {
            return redirect('/profile_management/profile')->with('error', Lang::get('admin.no_data_for_edit'));
        }

        $validatedData = $request->validate([
            'email' => 'nullable|email|max:191|unique:admins,email',
            'name' => 'nullable|string|max:191',
            'phone' => 'nullable|numeric|max:999999999',
        ]);

        $profile = User::find(Auth::user()->id);
        if ($request->name != null) {
            $profile->name = $request->name;
        }
        if ($request->email != null) {
            $profile->email = $request->email;
        }
        if ($request->phone != null) {
            $profile->phone = $request->phone;
        }
        $profile->save();
        return redirect('/profile_management/profile')->with('success', Lang::get('admin.edited_successfully'));
    }

    public function edit_password($id)
    {
        $profile = User::find($id);
        return view('managements.profile_management.profile.edit_password')->with('profile', $profile);
    }

    public function edit_image(Request $request)
    {

        $validatedData = $request->validate([
            'image' => 'required',
        ]);

        if ($request->image) {
        }

        $id = Auth::user()->id;


        $profile = User::find($id);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'accounting_system_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/User/'), $imageName);
            $profile->image = 'User/' . $imageName ?? null;
        }
        $profile->save();
        return redirect('/profile_management/profile')->with('success', Lang::get('admin.edited_successfully'));
    }

    public function delete_image()
    {
        $image = 'avatar.jpg';
        if (Auth::user()->image == $image) {
            return response()->json([
                'message' => Lang::get('admin.no_image_for_delete')
            ]);
        }
        $id = Auth::user()->id;

        $profile = User::find($id);
        if ($profile->image && file_exists(public_path('storage/' . $profile->image))) {
            unlink(public_path('storage/' . $profile->image));
        }
        $profile->save();
        return response()->json([
            'image' => $image
        ]);
    }

    public function update_password(Request $request, $id)
    {

        $messages = [
            'password_Present.required' => Lang::get('validation.required'),
            'password_Present.match_old_password' => Lang::get('validation.match_old_password'),
            'password.required' => Lang::get('validation.required'),
            'password.confirmed' => Lang::get('validation.confirmed'),
        ];
        $validator = Validator::make($request->all(), [
//            'password_Present' => ['required', 'match_old_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/profile_management/profile')->with('success', Lang::get('admin.edited_successfully'));
    }



}
