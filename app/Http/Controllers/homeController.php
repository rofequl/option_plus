<?php

namespace App\Http\Controllers;

use App\company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;

//Index page, Register page, Login Page, Logout.

class homeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login()
    {
            return view('account.login');
    }

    public function register()
    {
        return view('account.register');
    }

    public function UserLogin(Request $request){
        $request->validate([
            'email' => 'required|max:191',
            'password' => 'required|max:191|min:6',
        ]);
        $admin = user::where('email', $request->email)
            ->first();

        if (!empty($admin)) {
            if ($admin && Hash::check($request->password, $admin->password)) {
                Session::put('email', $request->email);
                Session::put('userId', $admin->user_id);
                Session::put('companyId', $admin->Company_id);
                return redirect('/');
            } else {
                $request->session()->flash('message', 'password not match');
                return redirect('/login');
            }
        } else {
            $request->session()->flash('message', 'Email id not match');
            return redirect('/login');
        }

    }

    public function forgetpassword()
    {
        return view('account.forget_password');
    }


    public function UserRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'password' => 'required|max:191|min:6',
            'company_name' => 'required|max:191',
            'company_logo' => 'required',
            'plan' => 'required',
        ]);

        if ($request->hasFile('company_logo')) {
            $extension = $request->file('company_logo')->getClientOriginalExtension();
            $fileStore = rand(10, 100) . time() . "." . $extension;
            $request->file('company_logo')->move(public_path("storage/company"), $fileStore);
        }

        $companyId = company::all()->count();
        $companyId = "C".str_pad($companyId, 3, "0", STR_PAD_LEFT);

        $register2 = new company;
        $register2->company_name = $request->company_name;
        $register2->plan = $request->plan;
        $register2->company_logo = $fileStore;
        $register2->Company_id = $companyId;
        if ($request->plan == 1){
            $register2->status = 1;
        }
        $register2->save();

        $userId = "U".$companyId.str_pad(0, 3, "0", STR_PAD_LEFT);

        $time = time();
        $register = new user;
        $register->name = $request->name;
        $register->email = $request->email;
        $register->user_id = $userId;
        $register->password = Hash::make($request->password);
        $register->Company_id = $companyId;
        $register->save();


        Session::put('email', $request->email);
        Session::put('userId', $time);
        Session::put('companyId', $companyId);
        return redirect('/');
    }


    public function logout()
    {
        Session::forget('email');
        Session::forget('userId');
        Session::forget('companyId');
        Session::flush();
        return redirect('/');
    }

}
