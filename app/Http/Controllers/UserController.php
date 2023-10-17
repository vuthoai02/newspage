<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function __construct()
    {
        @session_start();
    }

    public function getLogin()
    {
        return view('Authentication.login');
    }

    public function getRegister()
    {
        return view('Authentication.register');
    }

    public function postLogin(Request $request)
    {
        if(!isset($request->email) && !isset($request->password)){
            return redirect('/login')->with('notice', 'Vui lòng điền đầy đủ thông tin!');
        }
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            if($user->role == 'admin'){
                return redirect("/admin/home");
            } else{
                return redirect("/user/home");
            }
        }else{
            return redirect('/login')->with('notice', 'Tài khoản mật khẩu không chính xác!');
        }
    }
    public function postRegister(Request $request)
    {
        if(!isset($request->email) && !isset($request->password) && !isset($request->username)){
            return redirect('/register')->with('notice', 'Vui lòng điền đầy đủ thông tin!');
        }
        $unexist = UserModel::where('username', $request->username)->first();
        $emexist = UserModel::where('email', $request->email)->first();
        if(isset($unexist)){
            return redirect('/register')->with('notice', 'Tên người dùng đã được sử dụng!');
        } elseif(isset($emexist)){
            return redirect('/register')->with('notice', 'Email đã được đăng ký!');
        }
        $user = new UserModel();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $flag = $user->save();
        if ($flag) {
            return redirect("/login")->with('notice', 'Đăng ký thành công!');
        }else{
            return redirect('/register')->with('notice', 'Đăng ký thất bại');
        }
    }

    public function infor(){
        return view('User.profile');
    }

    public function get_newpass(){
        return view('User.password');
    }

    public function infor_post(Request $request){
        if(!isset($request->email)){
            return redirect('/infor')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đầy đủ thông tin']);
        }
        $existEmail = UserModel::find($request->email);
        if(isset($existEmail)){
            return redirect('/infor')->with(['flash_level' => 'danger', 'flash_message' => 'Email đã tồn tại!']);
        }
        $user = UserModel::find($request->id);
        $user->email = $request->email; 
        $flag = $user->save(); 
        if($flag){ 
            return redirect('/infor')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật tài khoản thành công']);
        } else { 
            return redirect('/infor')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi tài khoản']); 
        }
    }

    public function change_pass(Request $request){
        if(!isset($request->oldpass) && !isset($request->newpass) && !isset($request->repass)){
            return redirect('/change-password')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đầy đủ thông tin!']);
        }
        if($request->newpass !== $request->repass){
            return redirect('/change-password')->with(['flash_level' => 'danger', 'flash_message' => 'Mật khẩu nhập lại không khớp!']);
        }

        $user = UserModel::find($request->id);
        if(password_verify($request->oldpass,$user->password)){
            $user->password = bcrypt($request->newpass);
            $flag = $user->save(); 
            if($flag){ 
                return redirect('/change-password')->with(['flash_level' => 'success', 'flash_message' => 'Thay đổi thành công!']);
            } else { 
                return redirect('/change-password')->with(['flash_level' => 'danger', 'flash_message' => 'Thay đổi thất bại!']); 
            }
        } else{
            return redirect('/change-password')->with(['flash_level' => 'danger', 'flash_message' => 'Mật khẩu cũ không đúng!']);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
