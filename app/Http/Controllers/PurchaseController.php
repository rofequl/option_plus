<?php

namespace App\Http\Controllers;

use App\item;
use App\supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function PurchaseRequisition(){
        return view('purchase.purchase_requisition');
    }

    public function AllProductListSelect(Request $request)
    {
        $subcategory = item::where('Company_id',Session('companyId'))->get();
        echo json_encode($subcategory);
    }

    public function AllSupplierListSelect(Request $request)
    {
        $subcategory = supplier::where('Company_id',Session('companyId'))->get();
        echo json_encode($subcategory);
    }

}
