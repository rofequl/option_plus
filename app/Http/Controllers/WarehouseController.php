<?php

namespace App\Http\Controllers;

use App\country;
use App\warehouse;
use DataTables;
use Validator;
use Session;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function Warehouses()
    {
        $country = country::all();
        return view('warehouse.warehouse',compact('country'));
    }

    public function AddWarehouses(Request $request)
    {
        $value = warehouse::where('Company_id',Session('companyId'))->where('name', $request->name)->count();
        if ($value > 0) {
            echo 0;
        } else {
            $insert = new warehouse();
            $warehouse = warehouse::where('Company_id', Session('companyId'))->get()->count();
            $warehouse = "W" . Session('companyId') . rand(100, 999) . str_pad($warehouse, 3, "0", STR_PAD_LEFT);
            $insert->warehouse_id = $warehouse;
            $insert->name = $request->name;
            $insert->phone = $request->phone;
            $insert->email = $request->email;
            $insert->country_id = $request->country;
            $insert->address = $request->address;
            $insert->Company_id = Session('companyId');
            $insert->save();
            echo 1;
        }
    }

    public function ViewWarehouses()
    {
        $warehouse = warehouse::where('Company_id',Session('companyId'));

        return DataTables::of($warehouse)->addColumn('action', function ($warehouse) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" class="btn btn-white edit" id="' . $warehouse->id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $warehouse->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->addColumn('country', function ($warehouse) {
            return country::where('id', $warehouse->country_id)->pluck('name')->first();
        })->make(true);
    }

    public function DeleteWarehouses(Request $request)
    {
        $warehouse = warehouse::find($request->input('id'));
        if ($warehouse->delete()) {
            echo "1";
        }
    }

    public function ViewEditWarehouses(Request $request)
    {
        $unit = warehouse::find($request->input('id'));
        $output = array(
            'name' => $unit->name,
            'phone' => $unit->phone,
            'country' => $unit->country_id,
            'email' => $unit->email,
            'address' => $unit->address,
            'id' => $unit->id
        );
        echo json_encode($output);
    }

    public function UpdateWarehouses(Request $request)
    {
        $insert = warehouse::find($request->id);
        $insert->name = $request->name;
        $insert->phone = $request->phone;
        $insert->email = $request->email;
        $insert->address = $request->address;
        $insert->country_id = $request->country;
        $insert->save();
        echo 1;
    }

    public function AllWarehousesListSelect(Request $request)
    {
        $subcategory = warehouse::where('Company_id',Session('companyId'))->get();
        echo json_encode($subcategory);
    }

}
