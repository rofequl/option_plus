<?php

namespace App\Http\Controllers;

use App\customer;
use Illuminate\Http\Request;
use Validator;
use Session;
use DataTables;

class CustomerController extends Controller
{
    public function Customer()
    {
        return view('customer.customer');
    }

    public function AddCustomer(Request $request)
    {

        $rules = array(
            'name' => 'required|max:191',
            'phoneNumber' => 'required|max:15',
            'location' => 'required|max:191',
            'emailAddress' => 'required|max:191',
            'userBio' => 'required|max:999',
        );

        $validation = Validator::make($request->all(), $rules);
        if ($validation->passes()) {
            $customer = new customer;
            if ($request->hasFile('ProductPic')) {
                $extension = $request->file('ProductPic')->getClientOriginalExtension();
                $fileStore2 = rand(10, 100) . time() . "." . $extension;
                $request->file('ProductPic')->move(public_path("storage/customer"), $fileStore2);
                $customer->image = $fileStore2;
            }

            $customerId = customer::where('Company_id',Session('companyId'))->get()->count();
            $customerId = "S".Session('companyId').rand(100,999).str_pad($customerId, 3, "0", STR_PAD_LEFT);

            $customer->customer_id = $customerId;
            $customer->name = $request->name;
            $customer->phone = $request->phoneNumber;
            $customer->location = $request->location;
            $customer->email = $request->emailAddress;
            $customer->details = $request->userBio;
            $customer->Company_id = Session('companyId');
            $customer->save();
            echo 1;
        } else {
            $errors = $validation->errors(); //here's the magic
            $out = '';
            foreach ($rules as $key => $value) {
                if ($errors->has($key)) { //checks whether that input has an error.
                    $out .= $errors->first($key) . '<br>'; //echo out the first error of that input
                }
            }
            echo $out;
        }
    }

    public function ViewCustomer()
    {
        $customer = customer::where('Company_id',Session('companyId'))->get();

        return DataTables::of($customer)->addColumn('action', function ($customer) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" id="' . $customer->customer_id . '" class="btn btn-white view"><i class="material-icons"></i></button>
            <button type="button" id="' . $customer->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->make(true);
    }

    public function DeleteCustomer(Request $request)
    {
        $category = customer::find($request->input('id'));
        if ($category->delete()) {
            echo "1";
        }
    }
}
