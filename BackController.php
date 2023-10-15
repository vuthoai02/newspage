<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\UserLevel;
use App\Models\System;


class BackController extends Controller
{
    //
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
        if($flag == true){ 
            return redirect('admin/staff/profile')->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật tài khoản thành công']);
        } else { 
            return redirect('admin/staff/profile')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi tài khoản']); 
        }
    }
    public function staff_list(){
        $User = DB::table('users as a')
        ->join('users_level as b', 'a.level','=','b.id')
        ->selectRaw('a.id, a.fullname, a.address, a.email, a.phone, b.name')->get();


        return view('back.staff.list', compact('User'));
    }
    public function staff_add(){
        $UserLevel = UserLevel::where('status', 1)->get();
        return view('back.staff.add', compact('UserLevel'));
    }
    public function staff_add_post(Request $request){
        if($request->fullname == '' || $request->email == '' || $request->phone == '' ||  $request->username == '' || $request->password == ''){
            return redirect('admin/staff/add')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đầy đủ thông tin']);
        }
        $User = new User;
        $User->level = $request->level;
        $User->status = 1;
        $User->username = $request->username;
        if(isset($request->password) && $request->password != ''){
            $User->password = bcrypt($request->password); 
        }


        $User->fullname = $request->fullname;
        $User->address = $request->address;
        $User->email = $request->email;
        $User->phone = $request->phone;
        $Flag = $User->save(); 
        if($Flag == true){ 
            return redirect('admin/staff/list')->with(['flash_level' => 'success', 'flash_message' => 'Thêm nhân viên thành công']);
        } else { 
            return redirect('admin/staff/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi Thêm nhân viên']); 
        }
    }
    public function staff_edit(Request $request, $id){
        $User = User::find($id);
        $UserLevel = UserLevel::where('status', 1)->get();
        return view('back.staff.edit', compact('User', 'UserLevel'));
    }
    public function staff_edit_post(Request $request, $id){
        if($request->fullname == '' || $request->email == '' || $request->phone == ''){
            return redirect('admin/staff/add')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đầy đủ thông tin']);
        }
        $User = User::find($id);
        $User->level = $request->level;
        $User->status = $request->status;
        $User->username = $request->username;
        $User->password = bcrypt($request->password);
        $User->fullname = $request->fullname;
        $User->address = $request->address;
        $User->email = $request->email;
        $User->phone = $request->phone;
        $Flag = $User->save(); 
        if($Flag == true){ 
            return redirect('admin/staff/edit/' .$id)->with(['flash_level' => 'success', 'flash_message' => 'Chỉnh sửa nhân viên thành công']);
        } else { 
            return redirect('admin/staff/list')->with(['flash_level' => 'danger', 'flash_message' => 'Lỗi chỉnh sửa nhân viên']); 
        }
    }
    public function staff_delete(Request $request, $id){
    $user = User::find($id);

        if($user){
            $user->delete();
            return redirect('admin/staff/list')->with(['flash_level' => 'success', 'flash_message' => 'Xóa nhân viên thành công']);
        } else {
            return redirect('admin/staff/list')->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy người dùng']);
        }
    }


}