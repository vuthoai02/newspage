<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line to import the Auth facade

class UserController extends Controller
{
    public function __construct()
    {
        @session_start();
    }

    public function getLogin()
    {
        return view('product.login');
    }

    public function postLogin(Request $request)
    {
        if ($request->username == '' || $request->password == '') {
            return redirect('/admin-login')->with('notice', 'Tài khoản hoặc mật khẩu không được để trống!');
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('/admin/home');
        } else {
            return redirect('/admin-login')->with('notice', 'Đăng nhập thất bại');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect('/login');
    }

}