<?php

namespace App\Http\Controllers;

use App\country;
use App\item;
use App\product_price;
use App\subcategory;
use App\unit;
use DataTables;
use App\category;
use Illuminate\Http\Request;
use Validator;
use Session;

class ProductController extends Controller
{

    public function category()
    {
        return view('product.category');
    }

    public function ViewCategory()
    {
        $category = category::where('Company_id',Session('companyId'))->select('id', 'category_name', 'created_at');
        return DataTables::of($category)->addColumn('action', function ($category) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" class="btn btn-white edit" id="' . $category->id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $category->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->make(true);
    }

    public function AddCategory(Request $request)
    {

        $value = category::where('Company_id',Session('companyId'))->where('category_name', $request->category)->count();
        if ($value > 0) {
            echo 0;
        } else {
            $insert = new category;
            $insert->category_name = $request->category;
            $insert->Company_id = Session('companyId');
            $insert->save();
            echo 1;
        }
    }

    public function DeleteCategory(Request $request)
    {
        $category = category::find($request->input('id'));
        if ($category->delete()) {
            echo "1";
        }
    }

    public function ViewEditCategory(Request $request)
    {
        $category = category::find($request->input('id'));
        $output = array(
            'category_name' => $category->category_name,
            'id' => $category->id
        );
        echo json_encode($output);
    }

    public function UpdateCategory(Request $request)
    {
        $insert = category::find($request->id);
        $insert->category_name = $request->category;
        $insert->save();
        echo 1;
    }

    public function subcategory()
    {
        $category = category::where('Company_id',Session('companyId'))->get();
        return view('product.subcategory', compact('category'));
    }

    public function AddSubcategory(Request $request)
    {
        $value = subcategory::where('Company_id',Session('companyId'))->where('category_id', $request->categoryId)->where('subcategory_name', $request->subcategory)->count();
        if ($value > 0) {
            echo 0;
        } else {
            $insert = new subcategory;
            $insert->category_id = $request->categoryId;
            $insert->subcategory_name = $request->subcategory;
            $insert->Company_id = Session('companyId');
            $insert->save();
            echo 1;
        }
    }

    public function ViewSubcategory()
    {
        $subcategory = subcategory::where('Company_id',Session('companyId'))->select('id', 'category_id', 'subcategory_name', 'created_at');

        return DataTables::of($subcategory)->addColumn('action', function ($subcategory) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" class="btn btn-white edit" id="' . $subcategory->id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $subcategory->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->addColumn('category', function ($subcategory) {
            return category::where('id', $subcategory->category_id)->pluck('category_name')->first();
        })->make(true);
    }

    public function DeleteSubcategory(Request $request)
    {
        $category = subcategory::find($request->input('id'));
        if ($category->delete()) {
            echo "1";
        }
    }

    public function ViewEditSubcategory(Request $request)
    {
        $category = subcategory::find($request->input('id'));
        $output = array(
            'subcategory_name' => $category->subcategory_name,
            'category_id' => $category->category_id,
            'id' => $category->id
        );
        echo json_encode($output);
    }

    public function UpdateSubcategory(Request $request)
    {
        $insert = subcategory::find($request->id);
        $insert->category_id = $request->categoryid;
        $insert->subcategory_name = $request->subcategory;
        $insert->save();
        echo 1;
    }

    public function Unit()
    {
        return view('product.unit');
    }

    public function AddUnit(Request $request)
    {
        $value = unit::where('Company_id',Session('companyId'))->where('name', $request->name)->count();
        if ($value > 0) {
            echo 0;
        } else {
            $insert = new unit;
            $insert->name = $request->name;
            $insert->Company_id = Session('companyId');
            $insert->save();
            echo 1;
        }
    }

    public function ViewUnit()
    {
        $unit = unit::where('Company_id',Session('companyId'))->select('id', 'name', 'created_at');

        return DataTables::of($unit)->addColumn('action', function ($unit) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" class="btn btn-white edit" id="' . $unit->id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $unit->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->make(true);
    }

    public function DeleteUnit(Request $request)
    {
        $category = unit::find($request->input('id'));
        if ($category->delete()) {
            echo "1";
        }
    }

    public function ViewEditUnit(Request $request)
    {
        $unit = unit::find($request->input('id'));
        $output = array(
            'name' => $unit->name,
            'id' => $unit->id
        );
        echo json_encode($output);
    }

    public function UpdateUnit(Request $request)
    {
        $insert = unit::find($request->id);
        $insert->name = $request->name;
        $insert->save();
        echo 1;
    }

    public function SubcategorySelect(Request $request)
    {
        $subcategory = subcategory::where('Company_id',Session('companyId'))->where('category_id', $request->id)->get();
        echo json_encode($subcategory);
    }

    public function product()
    {
        $category = category::where('Company_id',Session('companyId'))->get();
        $unit = unit::where('Company_id',Session('companyId'))->get();
        return view('product.item', compact('category','unit'));
    }

    public function AddProduct(Request $request)
    {

        $rules = array(
            'CategoryId' => 'required',
            'SubcategoryId' => 'required',
            'ItemName' => 'required',
            'description' => 'required',
            'Manufacturer' => 'required',
            'UnitId' => 'required',
        );

        $validation = Validator::make($request->all(), $rules);
        if ($validation->passes()) {
            if($request->itemId != ""){
                $item = item::find($request->itemId);
            }else{
                $item = new item;
            }
            if ($request->hasFile('ProductPic')) {
                $extension = $request->file('ProductPic')->getClientOriginalExtension();
                $fileStore2 = rand(10, 100) . time() . "." . $extension;
                $request->file('ProductPic')->move(public_path("storage/product"), $fileStore2);
                $item->item_pic = $fileStore2;
            }

            $item->category_id = $request->CategoryId;
            $item->subcategory_id = $request->SubcategoryId;
            $item->item_name = $request->ItemName;
            $item->description = $request->description;
            $item->manufacturer = $request->Manufacturer;
            $item->unit_id = $request->UnitId;
            $item->Company_id = Session('companyId');
            $item->save();
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

    public function ViewProduct()
    {
        $item = item::where('Company_id',Session('companyId'))->get();

        return DataTables::of($item)->addColumn('action', function ($item) {
            return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">
            <button type="button" id="' . $item->id . '" class="btn btn-white view"><i class="material-icons"></i></button>
            <button type="button" class="btn btn-white edit" id="' . $item->id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $item->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->addColumn('image', function ($item) {
            return '<img src="storage/product/' . $item->item_pic . '" class="img-thumbnail" width="70px">';
        })->addColumn('category', function ($item) {
            return category::where('id', $item->category_id)->pluck('category_name')->first();
        })->addColumn('subcategory', function ($item) {
            return subcategory::where('id', $item->subcategory_id)->pluck('subcategory_name')->first();
        })->rawColumns(['image', 'action'])->make(true);
    }

    public function ViewSingleProduct(Request $request)
    {
        $item = item::find($request->id);
        $output = array(
            'subcategory' => subcategory::where('id', $item->subcategory_id)->pluck('subcategory_name')->first(),
            'category' => category::where('id', $item->category_id)->pluck('category_name')->first(),
            'name' => $item->item_name,
            'pic' => $item->item_pic,
            'description' => $item->description,
            'manufacturer' => $item->manufacturer,
            'unit' => unit::where('id', $item->unit_id)->pluck('name')->first(),
            'status' => $item->status,
            'created' => $item->created_at,
            'id' => $item->id,
            'categoryId' => $item->category_id,
            'subcategoryId' => $item->subcategory_id,
            'unitId' => $item->unit_id,
        );
        echo json_encode($output);
    }

    public function DeleteItem(Request $request)
    {
        $category = item::find($request->input('id'));
        if ($category->delete()) {
            echo "1";
        }
    }

    public function PriceList()
    {
        $item = item::where('Company_id',Session('companyId'))->get();
        $country = country::all();
        return view('product.price_list',compact('item','country'));
    }

    public function AddPriceList(Request $request)
    {
        $value = product_price::where('item_id', $request->ItemId)->where('country_id', $request->CountryId)->count();
        if ($value > 0) {
            $insert = product_price::where('item_id', $request->ItemId)->where('country_id', $request->CountryId)->first();
            $insert->country_id = $request->CountryId;
            $insert->item_id = $request->ItemId;
            $insert->price = $request->price;
            $insert->vat = $request->vat;
            $insert->tax = $request->tax;
            $insert->discount = $request->discount;
            $insert->ait = $request->ait;
            $insert->save();
            echo 0;
        } else {
            $insert = new product_price;
            $insert->country_id = $request->CountryId;
            $insert->item_id = $request->ItemId;
            $insert->price = $request->price;
            $insert->vat = $request->vat;
            $insert->tax = $request->tax;
            $insert->discount = $request->discount;
            $insert->ait = $request->ait;
            $insert->Company_id = Session('companyId');
            $insert->save();
            echo 1;
        }
    }

    public function ViewPriceList()
    {
        $price = product_price::where('Company_id',Session('companyId'))->get();

        return DataTables::of($price)->addColumn('action', function ($price) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" class="btn btn-white edit" id="' . $price->id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $price->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->addColumn('country', function ($price) {
            return country::where('id', $price->country_id)->pluck('name')->first();
        })->addColumn('item', function ($price) {
            return item::where('id', $price->item_id)->pluck('item_name')->first();
        })->make(true);
    }

    public function DeletePriceList(Request $request)
    {
        $price = product_price::find($request->input('id'));
        if ($price->delete()) {
            echo "1";
        }
    }

    public function ViewEditPriceList(Request $request)
    {
        $price = product_price::find($request->input('id'));
        $output = array(
            'item' => $price->item_id,
            'country' => $price->country_id,
            'price' => $price->price,
            'vat' => $price->vat,
            'tax' => $price->tax,
            'discount' => $price->discount,
            'ait' => $price->ait,
            'id' => $price->id
        );
        echo json_encode($output);
    }

    public function UpdatePriceList(Request $request)
    {
        $insert = product_price::find($request->id);
        $insert->product_id = $request->itemId;
        $insert->price = $request->price;
        $insert->save();
        echo 1;
    }
}




















