<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function checklogin(Request $request)
    {
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        
        if (Auth()->attempt($arr)) {

            return redirect()->route('home');
            
        } else {
            return redirect()->back()->with(['message' => 'Tài khoản hoặc mật khẩu không chính xác']);
            
        }
    }
}
