<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Admin;
use Hash;

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

    public function checkCurrentPassword(Request $request){
        $data = $request->all();

        if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
            echo "true";
        }
        else{
            echo "false";
        }
    }

    public function updateCurrentPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // Check if current password is correct
            if(Hash::check($data['current_password'], Auth::guard('admin')->user()->password)){
                // Check is new and confirm password is matching
                if($data['new_password'] == $data['confirm_password']){
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    Session::flash('success_message', ' Password has been updated successfully');
                }
                else{
                    Session::flash('error_message', 'Your new password and confirm password is not match');
                    return redirect()->back();
                }
            }
            else{
                Session::flash('error_message', 'Your current password is incorrect');
                return redirect()->back();
            }

            return redirect()->back();

            // echo "<pre>";
            // print_r($data);
            // die;

        }
    }

    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'admin_mobile' => 'required|numeric',
            ];

            $customMessages = [
                'admin_name.required' => 'Name is required',
                'admin_name.regex' => 'Valid Name is required',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => 'Valid Mobile is required',
            ];

            $this->validate($request, $rules, $customMessages);

            // Update Admin details
            Admin::where('email', Auth::guard('admin')->user()->email)
                ->update([
                    ['name']=>$data['admin_name'],
                    ['mobile']=>$data['admin_mobile'],
                ]);

            Session::flash('success_message', 'Admin details updated successfully!');
            return redirect()->back();

            // echo "<pre>";
            // print_r($data);
            // die();
        }
        else{

        }
        return view('layouts.admin.update_admin_details');
    }

}
