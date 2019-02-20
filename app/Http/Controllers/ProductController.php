<?php

namespace App\Http\Controllers;

use App\item;
use App\subcategory;
use DataTables;
use App\category;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    public function category()
    {
        return view('product.category');
    }

    public function ViewCategory()
    {
        $category = category::select('id', 'category_name', 'created_at');
        return DataTables::of($category)->addColumn('action', function ($category) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" class="btn btn-white edit" id="' . $category->id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $category->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->make(true);
    }

    public function AddCategory(Request $request)
    {
        $data = array('category_name' => $request->category,);

        $value = category::where('category_name', $request->category)->count();
        if ($value > 0) {
            echo 0;
        } else {
            $insert = new category;
            $insert->category_name = $request->category;
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
        $category = category::all();
        return view('product.subcategory', compact('category'));
    }

    public function AddSubcategory(Request $request)
    {
        $value = subcategory::where('subcategory_name', $request->subcategory)->count();
        if ($value > 0) {
            echo 0;
        } else {
            $insert = new subcategory;
            $insert->category_id = $request->categoryId;
            $insert->subcategory_name = $request->subcategory;
            $insert->save();
            echo 1;
        }
    }

    public function ViewSubcategory()
    {
        $subcategory = subcategory::select('id', 'category_id', 'subcategory_name', 'created_at');

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

    public function SubcategorySelect(Request $request)
    {
        $subcategory = subcategory::where('category_id', $request->id)->get();
        echo json_encode($subcategory);
    }

    public function product()
    {
        $category = category::all();
        return view('product.item', compact('category'));
    }

    public function AddProduct(Request $request)
    {

        $rules = array(
            'CategoryId' => 'required',
            'SubcategoryId' => 'required',
            'ItemName' => 'required',
            'description' => 'required',
            'Manufacturer' => 'required',
        );

        $validation = Validator::make($request->all(), $rules);
        if ($validation->passes()) {
            $item = new item;
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
        $item = item::all();

        return DataTables::of($item)->addColumn('action', function ($item) {
            return '<div class="d-table mx-auto storage/product/btn-group-sm btn-group">
            <button type="button" id="' . $item->id . '" class="btn btn-white view"><i class="material-icons"></i></button>
            <button type="button" class="btn btn-white edit" id="' . $item->id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $item->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->addColumn('image', function ($item) {
            return '<img src="' . $item->item_pic . '" class="img-thumbnail" width="70px">';
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
            'status' => $item->status,
            'created' => $item->created_at,
            'id' => $item->id,
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

    public function ViewEditItem(Request $request)
    {
        $item = item::find($request->id);
        $output = array(
            'subcategory' => $item->subcategory_id,
            'category' => $item->category_id,
            'name' => $item->item_name,
            'pic' => $item->item_pic,
            'description' => $item->description,
            'manufacturer' => $item->manufacturer,
            'status' => $item->status,
            'created' => $item->created_at,
            'id' => $item->id,
        );
        echo json_encode($output);
    }
}




















