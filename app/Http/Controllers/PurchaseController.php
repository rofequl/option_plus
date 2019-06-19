<?php

namespace App\Http\Controllers;

use App\item;
use App\product_price;
use App\purchase;
use App\purchase_product;
use App\warehouse;
use DataTables;
use Ramsey\Uuid\Codec\OrderedTimeCodec;
use Session;
use App\supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function ViewPurchaseRequisition()
    {
        $purchase = purchase::where('Company_id',Session('companyId'))->where('status',0)->get();

        return DataTables::of($purchase)->addColumn('action', function ($purchase) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" id="' . $purchase->id . '" class="btn btn-white view" data-toggle="tooltip" data-placement="top" title="View Requisition"><i class="material-icons">pageview</i></button>
            <button type="button" id="' . $purchase->id . '" class="btn btn-white delete" data-toggle="tooltip" data-placement="top" title="Delete Requisition"><i class="material-icons"></i></button>
            </div>';
        })->addColumn('warehouse', function ($purchase) {
            return warehouse::where('id', $purchase->warehouse_no)->pluck('name')->first();
        })->addColumn('supplier', function ($purchase) {
            return supplier::where('id', $purchase->supplier_id)->pluck('company_name')->first();
        })->make(true);
    }

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

    public function AllProductPriceListSelect(Request $request)
    {
        $price = product_price::where('item_id',$request->productId)->where('country_id',$request->countryId)->where('Company_id',Session('companyId'))->first();
        if ($price){
            $output = array(
                'price' => $price->price,
                'vat' => $price->vat,
                'tax' => $price->tax,
                'discount' => $price->discount,
                'ait' => $price->ait,
            );
        }else{
            $output = array(
                'status' => 5
            );
        }
        echo json_encode($output);
    }

    public function AddPurchaseRequisition(Request $request)
    {

        //dd($request->all());

        $purchaseId = purchase::where('Company_id', Session('companyId'))->get()->count();
        $purchaseId = "PR" . Session('companyId') . rand(100, 999) . str_pad($purchaseId, 3, "0", STR_PAD_LEFT);

        $purchase = new purchase;
        $purchase->requisition_no = $purchaseId;
        $purchase->date = $request->date;
        $purchase->supplier_id = $request->supplier;
        $purchase->warehouse_no = $request->wearehouse;
        $purchase->country_no = $request->country;
        $purchase->remarks = $request->remarks;
        $purchase->subtotal = $request->subtotal;
        $purchase->freight = $request->freight;
        $purchase->total = $request->total;
        $purchase->total = $request->total;
        $purchase->Company_id = Session('companyId');
        $purchase->save();

        for ($i=0;$i<count($request->product);$i++){
            if ($request->product[$i] != null){
                $purpro = new purchase_product;
                $purpro->purchase_id = $purchase->id;
                $purpro->product_code = $request->product_code[$i];
                $purpro->product_id = $request->product[$i];
                $purpro->price = $request->price[$i];
                $purpro->quantity = $request->quantity[$i];
                $purpro->vat = $request->vat[$i];
                $purpro->tax = $request->tax[$i];
                $purpro->discount = $request->discount[$i];
                $purpro->ait = $request->ait[$i];
                $purpro->total_amount = $request->prototal[$i];
                $purpro->Company_id = Session('companyId');
                $purpro->save();
            }
        }


    }

    public function PurchaseInvoice(){
        return view('purchase.invoice');
    }

    public function RequisitionSelect(Request $request)
    {

//        Status: 0=requisition
//                1=Order
//                2=Invoice

        $subcategory = purchase::where('Company_id',Session('companyId'))->where('status', 0)->get();
        echo json_encode($subcategory);
    }

    public function OrderSelect(Request $request)
    {

//        Status: 0=requisition
//                1=Order
//                2=Invoice

        $subcategory = purchase::where('Company_id',Session('companyId'))->where('status', 1)->get();
        echo json_encode($subcategory);
    }

    public function AddPurchaseInvoice(Request $request){
        $purchaseId = purchase::where('Company_id', Session('companyId'))->get()->count();
        $purchaseId = "PI" . Session('companyId') . rand(100, 999) . str_pad($purchaseId, 3, "0", STR_PAD_LEFT);


        $invoice = purchase::where('Company_id',Session('companyId'))->where('id', $request->requisition)->first();
        $invoice->status = 2;
        $invoice->invoice_no = $purchaseId;
        $invoice->save();

        return "done";

    }

    public function ViewPurchaseInvoice()
    {
        $purchase = purchase::where('Company_id',Session('companyId'))->where('status',2)->get();

        return DataTables::of($purchase)->addColumn('action', function ($purchase) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" id="' . $purchase->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->addColumn('warehouse', function ($purchase) {
            return warehouse::where('id', $purchase->warehouse_no)->pluck('name')->first();
        })->addColumn('supplier', function ($purchase) {
            return supplier::where('id', $purchase->supplier_id)->pluck('company_name')->first();
        })->make(true);
    }

    public function PurchaseOrder(){
        return view('purchase.purchase_order');
    }

    public function AddPurchaseOrder(Request $request)
    {

        //dd($request->all());

        $purchaseId = purchase::where('Company_id', Session('companyId'))->get()->count();
        $purchaseId = "PO" . Session('companyId') . rand(100, 999) . str_pad($purchaseId, 3, "0", STR_PAD_LEFT);

        $purchase = new purchase;
        $purchase->order_no = $purchaseId;
        $purchase->date = $request->date;
        $purchase->supplier_id = $request->supplier;
        $purchase->warehouse_no = $request->wearehouse;
        $purchase->country_no = $request->country;
        $purchase->remarks = $request->remarks;
        $purchase->subtotal = $request->subtotal;
        $purchase->freight = $request->freight;
        $purchase->total = $request->total;
        $purchase->status = 1;
        $purchase->Company_id = Session('companyId');
        $purchase->save();

        for ($i=0;$i<count($request->product);$i++){
            if ($request->product[$i] != null){
                $purpro = new purchase_product;
                $purpro->purchase_id = $purchase->id;
                $purpro->product_code = $request->product_code[$i];
                $purpro->product_id = $request->product[$i];
                $purpro->price = $request->price[$i];
                $purpro->quantity = $request->quantity[$i];
                $purpro->vat = $request->vat[$i];
                $purpro->tax = $request->tax[$i];
                $purpro->discount = $request->discount[$i];
                $purpro->ait = $request->ait[$i];
                $purpro->total_amount = $request->prototal[$i];
                $purpro->Company_id = Session('companyId');
                $purpro->save();
            }
        }


    }

    public function ViewPurchaseOrder()
    {
        $purchase = purchase::where('Company_id',Session('companyId'))->where('status',1)->get();

        return DataTables::of($purchase)->addColumn('action', function ($purchase) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" id="' . $purchase->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->addColumn('warehouse', function ($purchase) {
            return warehouse::where('id', $purchase->warehouse_no)->pluck('name')->first();
        })->addColumn('supplier', function ($purchase) {
            return supplier::where('id', $purchase->supplier_id)->pluck('company_name')->first();
        })->make(true);
    }

    public function ViewPurchase()
    {
        return view('purchase.view_purchase');
    }
}
