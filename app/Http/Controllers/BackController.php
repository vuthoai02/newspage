<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BackController extends Controller
{
    public function __construct(){
        session_start();
    }

    public function home(){
        return view('back.home.home');
    }

    public function staff_profile(){
        return view('back.staff.profile');
    }

    public function staff_profile_post(Request $request){
        if($request->fullname == '' || $request->email == '' || $request->phone == ''){
            return redirect('admin/staff/profile')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đầy đủ thông tin']);
        }

        $user = User::find($request->id);
        $user->fullname = $request->fullname; 
        $user->address = $request->address; 
        $user->email = $request->email; 
        $user->phone = $request->phone; 
        if(isset($request->password) && $request->password != ''){
            $user->password = bcrypt($request->password); 
        }
        $flag = $user->save(); 
        if($flag){ 
            return redirect('admin/staff/profile')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật tài khoản thành công']);
        } else { 
            return redirect('admin/staff/profile')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi tài khoản']); 
        }
    }
}