<?php

namespace App\Http\Controllers;

use App\company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

//Index page, Register page, Login Page, Logout.

class homeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        $user = user::all()->count();
        if($user > 0){
            return view('account.login');
        }else{
            return view('account.register');
        }
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


    public function firstRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|max:191',
            'password' => 'required|max:191|min:6',
            'company_name' => 'required|max:191',
            'company_logo' => 'required',
        ]);

        if ($request->hasFile('company_logo')) {
            $extension = $request->file('company_logo')->getClientOriginalExtension();
            $fileStore = rand(10, 100) . time() . "." . $extension;
            $request->file('company_logo')->move(public_path("storage/company"), $fileStore);
        }

        $time = time();
        $register = new user;
        $register->name = $request->name;
        $register->email = $request->email;
        $register->user_id = $time;
        $register->password = Hash::make($request->password,);
        $register->save();


        $register2 = new company;
        $register2->company_name = $request->company_name;
        $register2->company_logo = $fileStore;
        $register2->save();

        Session::put('email', $request->email);
        Session::put('userId', $time);
        return redirect('/');
    }
}
