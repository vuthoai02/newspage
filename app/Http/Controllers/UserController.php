<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line to import the Auth facade
use App\Models\UserModel;

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
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        // if ($request->remember == trans('remember.Remember Me')) {
        //     $remember = true;
        // } else {
        //     $remember = false;
        // }
        //kiểm tra trường remember có được chọn hay không
        
        if (Auth::guard('web')->attempt($arr)) {

            //..code tùy chọn
            //đăng nhập thành công thì hiển thị thông báo đăng nhập thành công
            return redirect("/admin/home");
        } else {

            dd('tài khoản và mật khẩu chưa chính xác');
            //...code tùy chọn
            //đăng nhập thất bại hiển thị đăng nhập thất bại
            return redirect('/admin-login')->with('notice', 'Đăng nhập thất bại');
        }
    }

    // public function postLogin(Request $request)
    // {
    //     if ($request->username == '' || $request->password == '') {
    //         return redirect('/admin-login')->with('notice', 'Tài khoản hoặc mật khẩu không được để trống!');
    //     }

    //     $user = UserModel::where('username', $request->username)->where('password', md5($request->getPassword))->get();

    //     if ($user) {
    //         return redirect("/admin/home")->with('loggedInUser', $user);
    //     } else {
    //         return redirect('/admin-login')->with('notice', 'Đăng nhập thất bại');
    //     }
    // }
    public function getLogout(){
        Auth::logout();
        return redirect('/login');
    }

}