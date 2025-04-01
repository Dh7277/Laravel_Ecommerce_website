<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    //When user submit the login form then this method will be called
    public function authenticate(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|',
        ]);

        if($validator->passes()) {
            /* 
            *this will authenticate the user but it will not check the 
            *role of the user which we will check inside the if condition
            * if the user is admin then redirect him to the admin dashboard and if 
            * if user then show error that you are not authorized to login here
            */
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' 
            => $request->password],$request->get('remember'))){

                    return redirect()->route('admin.dashboard');

            }else {
                return redirect()->route('admin.login.route')
                    ->with('error', 'Either Email/Password is incorrect');
            }

        }else {
            return redirect()->route('admin.login.route')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }
}
