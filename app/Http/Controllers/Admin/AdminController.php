<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Admin;

class AdminController extends Controller
{
    public function dashboard(){
        return view('layouts.admin.admin_dashboard');
    }

    public function settings(){

        // echo "<pre>";
        // print_r(Auth::guard('admin')->user()->id);
        // die;

        // Auth::guard('admin')->user()->id


        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('layouts.admin.admin_settings')->with(compact('adminDetails'));
    }

    public function login(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();

            // Start Note: Validation version 1
            $validatedData = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);
            // End Note: Validation version 1

            // Start Note: Validation version 2
            // $rules = [
            //     'email' => 'required|email|max:255',
            //     'password' => 'required',
            // ];

            // $customMessages = [
            //     'email.required' => 'Email is required',
            //     'email.email' => 'Valid Email is required',
            //     'password.required' => 'Password is required',
            // ];

            // $this->validate($request,$rules,$customMessages);
            // End Note: Validation version

            // Guard : Only admin can access
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                return redirect('admin/dashboard');
            }
            else{
                Session::flash('error_message','Invalid Email or Password');
                return redirect()->back();
            }

            // TO DEBUG ERROR
            // echo "<pre>";
            // print_r($data);
            // die;
        }
        return view('layouts.admin.admin_login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
