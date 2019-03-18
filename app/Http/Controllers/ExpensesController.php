<?php

namespace App\Http\Controllers;

use App\expance;
use App\expance_list;
use DataTables;
use Validator;
use Session;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{

    public function Expenses()
    {
        return view('expenses.expance');
    }

    public function ViewExpenses()
    {
        $expence = expance::where('Company_id',Session('companyId'))->select('id', 'name', 'created_at');

        return DataTables::of($expence)->addColumn('action', function ($expence) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" class="btn btn-white edit" id="' . $expence->id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $expence->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->make(true);
    }

    public function AddExpenses(Request $request)
    {
        $value = expance::where('Company_id',Session('companyId'))->where('name', $request->name)->count();
        if ($value > 0) {
            echo 0;
        } else {
            $insert = new expance;
            $insert->name = $request->name;
            $insert->Company_id = Session('companyId');
            $insert->save();
            echo 1;
        }
    }

    public function DeleteExpenses(Request $request)
    {
        $category = expance::find($request->input('id'));
        if ($category->delete()) {
            echo "1";
        }
    }

    public function ViewEditExpenses(Request $request)
    {
        $unit = expance::find($request->input('id'));
        $output = array(
            'name' => $unit->name,
            'id' => $unit->id
        );
        echo json_encode($output);
    }

    public function UpdateExpenses(Request $request)
    {
        $insert = expance::find($request->id);
        $insert->name = $request->name;
        $insert->save();
        echo 1;
    }


    public function ExpensesList()
    {
        $expense = expance::where('Company_id',Session('companyId'))->get();
        return view('expenses.expence_list', compact('expense'));
    }

    public function ViewExpensesList()
    {
        $expence = expance_list::where('Company_id',Session('companyId'))->select('id', 'expenses_id','amount', 'created_at');

        return DataTables::of($expence)->addColumn('action', function ($expence) {
            return '<div class="d-table mx-auto btn-group-sm btn-group">
            <button type="button" class="btn btn-white edit" id="' . $expence->id . '"><i class="material-icons"></i></button>
            <button type="button" id="' . $expence->id . '" class="btn btn-white delete"><i class="material-icons"></i></button>
            </div>';
        })->addColumn('expenses', function ($expence) {
            return expance::where('id', $expence->expenses_id)->pluck('name')->first();
        })->make(true);
    }

    public function AddExpensesList(Request $request)
    {
            $insert = new expance_list;
            $insert->expenses_id = $request->expance;
            $insert->amount = $request->name;
            $insert->Company_id = Session('companyId');
            $insert->save();
            echo 1;

    }

    public function DeleteExpensesList(Request $request)
    {
        $category = expance_list::find($request->input('id'));
        if ($category->delete()) {
            echo "1";
        }
    }

    public function ViewEditExpensesList(Request $request)
    {
        $unit = expance_list::find($request->input('id'));
        $output = array(
            'amount' => $unit->amount,
            'expenses' => $unit->expenses_id,
            'id' => $unit->id
        );
        echo json_encode($output);
    }

    public function UpdateExpensesList(Request $request)
    {
        $insert = expance_list::find($request->id);
        $insert->expenses_id = $request->expance;
        $insert->amount = $request->name;
        $insert->save();
        echo 1;
    }





}
