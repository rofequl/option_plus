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
            'company_name' => 'required|max:191',
            'company_phone' => 'required|max:15',
            'company_location' => 'required|max:191',
            'company_email' => 'required|max:191',
            'company_reg_no' => 'required|max:191',
            'total_employ' => 'required|max:191',
            'accountant_name' => 'required|max:191',
            'accountant_address' => 'required|max:191',
            'accountant_phone' => 'required|max:191',
            'bank_name' => 'required|max:191',
            'bank_address' => 'required|max:191',
            'account_no' => 'required|max:191',
            'director_name' => 'required|max:191',
            'director_dob' => 'required|max:191',
            'director_address' => 'required|max:191',
        );

        $validation = Validator::make($request->all(), $rules);
        if ($validation->passes()) {
            if ($request->id != ""){
                $supplier = supplier::find($request->id);
            }else{
                $supplier = new supplier;
            }
            if ($request->hasFile('ProductPic')) {
                $extension = $request->file('ProductPic')->getClientOriginalExtension();
                $fileStore2 = rand(10, 100) . time() . "." . $extension;
                $request->file('ProductPic')->move(public_path("storage/supplier"), $fileStore2);
                $supplier->company_logo = $fileStore2;
            }
            if ($request->id == "") {
                $supplierId = supplier::where('Company_id', Session('companyId'))->get()->count();
                $supplierId = "S" . Session('companyId') . rand(100, 999) . str_pad($supplierId, 3, "0", STR_PAD_LEFT);
                $supplier->supplier_id = $supplierId;
            }

            $supplier->company_name = $request->company_name;
            $supplier->company_phone = $request->company_phone;
            $supplier->company_location = $request->company_location;
            $supplier->company_email = $request->company_email;
            $supplier->company_reg_no = $request->company_reg_no;
            $supplier->total_employ = $request->total_employ;
            $supplier->accountant_name = $request->accountant_name;
            $supplier->accountant_address = $request->accountant_address;
            $supplier->accountant_phone = $request->accountant_phone;
            $supplier->bank_name = $request->bank_name;
            $supplier->bank_address = $request->bank_address;
            $supplier->account_no = $request->account_no;
            $supplier->director_name = $request->director_name;
            $supplier->director_dob = $request->director_dob;
            $supplier->director_address = $request->director_address;
            $supplier->Company_id = Session('companyId');
            $supplier->save();
            echo 1;
        } else {
            $errors = $validation->errors();
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

    public function ViewSingleSupplier(Request $request)
    {
        $supplier = supplier::find($request->id);
        $output = array(
            'company_name' => $supplier->company_name,
            'company_phone' => $supplier->company_phone,
            'company_location' => $supplier->company_location,
            'company_email' => $supplier->company_email,
            'company_reg_no' => $supplier->company_reg_no,
            'total_employ' => $supplier->total_employ,
            'accountant_name' => $supplier->accountant_name,
            'accountant_address' => $supplier->accountant_address,
            'accountant_phone' => $supplier->accountant_phone,
            'bank_name' => $supplier->bank_name,
            'bank_address' => $supplier->bank_address,
            'account_no' => $supplier->account_no,
            'director_name' => $supplier->director_name,
            'director_dob' => $supplier->director_dob,
            'director_address' => $supplier->director_address,
            'company_logo' => $supplier->company_logo,
            'id' => $supplier->id,
        );
        echo json_encode($output);
    }
}
