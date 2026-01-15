<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerTranslation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index(Request $request)
    {

        return view('managements.sales.customer.index');
    }

    public function show(Request $request)
    {
        $table_length = isset($_GET['table_length']) ? $_GET['table_length'] : 10;
        if ($table_length == '') $table_length = 10;
        $customers = Customer::where('branch_id',Auth::user()->branch_id)->orderBy('id', 'desc')->paginate($table_length);
        return response()->json($customers);
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');

        $data = \App\Models\Customer::query()
            ->when($query, function($q) use ($query) {
                $q->whereTranslationLike('name', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%")
                    ->orWhere('debit_limit', 'like', "%{$query}%");
            })
            ->orderBy('id', 'desc')->get();

        // if you use accessors like $customers->actions, include them
        return response()->json($data);
    }


    public function store(Request $request)
    {

        $validatedData = $this->validatedData($request);
        if ($validatedData->fails())
            return response()->json(['error' => $validatedData->errors()], 401);


        $customer = new Customer();
        $customer->debit_limit = $request->debit_limit;
        $customer->branch_id = Auth::user()->branch_id;
        $customer->email = $request->email;
        $customer->phone = $request->phone;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'accounting_system_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/Customer/'), $imageName);
            $customer->image = 'Customer/' . $imageName ?? null;
        }


        $customer->save();


        $customer->translateOrNew('ar')->name = $request->name_ar;
        $customer->translateOrNew('en')->name = $request->name_en;

        $customer->save();



        return response()->json([
            'status' => 200,
            'customer' => $customer,
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
            'debit_limit' =>['required', 'numeric', 'min:0', 'max:5000'],
            'email' => [
                'required',
                'email',
                Rule::unique('customers', 'email')->ignore($request->id),
            ],
            'phone' => [$required],

        ]);
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        $customer_ar = CustomerTranslation::where('customer_id', '=', $id)->where('locale', 'ar')->first();
        $customer_en = CustomerTranslation::where('customer_id', '=', $id)->where('locale', 'en')->first();


        return response()->json([
            'id' => $customer->id,
            'name_ar' => $customer_ar->name,
            'name_en' => $customer_en->name,
            'email' => $customer->email,
            'phone' => $customer->phone,
            'debit_limit' => $customer->debit_limit,

            'image' => asset('storage') . '/' . $customer->image,


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
            $image->move(public_path('storage/Customer/'), $imageName);
            $filename = public_path() . '/' . Customer::where('id', '=', $id)->get()->first()->image;
            File::delete($filename);
        }

        $customer = Customer::find($id);

        if ($request->hasFile('image')) {
            $customer->image = 'Customer/' . $imageName;
        }


        $customer->debit_limit = $request->debit_limit;

        $customer->email = $request->email;
        $customer->phone = $request->phone;


        $customer->save();


        $customer->translateOrNew('ar')->name = $request->name_ar;
        $customer->translateOrNew('en')->name = $request->name_en;

        $customer->save();


        return response()->json([
            'status' => 200,
            'customer' => $customer,
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
        Customer::find($id)->forceDelete();
        $message = Lang::get('admin.deleted_successfully');
        return response()->json([
            'message' => $message,
            'data_count' => Customer::count()
        ],
            200
        );
    }
}
