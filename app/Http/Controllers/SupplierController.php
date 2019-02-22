<?php

namespace App\Http\Controllers;

use App\supplier;
use Illuminate\Http\Request;
use Validator;
use Session;
use DataTables;

class SupplierController extends Controller
{
    public function Supplier()
    {
        return view('supplier.supplier');
    }

    public function AddSupplier(Request $request)
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
            $supplier = new supplier;
            if ($request->hasFile('ProductPic')) {
                $extension = $request->file('ProductPic')->getClientOriginalExtension();
                $fileStore2 = rand(10, 100) . time() . "." . $extension;
                $request->file('ProductPic')->move(public_path("storage/supplier"), $fileStore2);
                $supplier->image = $fileStore2;
            }

            $supplierId = supplier::where('Company_id',Session('companyId'))->get()->count();
            $supplierId = "S".Session('companyId').str_pad($supplierId, 3, "0", STR_PAD_LEFT);

            $supplier->supplier_id = $supplierId;
            $supplier->name = $request->name;
            $supplier->phone = $request->phoneNumber;
            $supplier->location = $request->location;
            $supplier->email = $request->emailAddress;
            $supplier->details = $request->userBio;
            $supplier->Company_id = Session('companyId');
            $supplier->save();
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

    public function ViewSupplier()
    {
        $supplier = supplier::where('Company_id',Session('companyId'))->get();

        return DataTables::of($supplier)->addColumn('action', function ($supplier) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" id="' . $supplier->supplier_id . '" class="btn btn-white view"><i class="material-icons"></i></button>
            <button type="button" id="' . $supplier->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->make(true);
    }

    public function DeleteSupplier(Request $request)
    {
        $category = supplier::find($request->input('id'));
        if ($category->delete()) {
            echo "1";
        }
    }

    public function SupplierIndividual($data)
    {
        $supplier = supplier::where('supplier_id',$data)->where('Company_id',Session('companyId'))->first();
        if ($supplier){
            return view('supplier.supplier-data',compact('supplier'));
        }else{
            echo "Error";
        }

    }
}
