<?php

namespace App\Http\Controllers;

use DataTables;
use App\category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function category()
    {
        return view('product.category');
    }

    public function ViewCategory()
    {
        return DataTables::of(category::query())->make(true);
    }

    public function AddCategory(Request $request)
    {
        $data = array('category_name'=>$request->category,);

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
}
