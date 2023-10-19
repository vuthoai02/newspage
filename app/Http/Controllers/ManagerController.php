<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct()
    {
        @session_start();
    }

    public function user(){
        $users = UserModel::where('username', '!=', 'Administrator')->get();
        return view('Manager.user', ['users' => $users]);
    }

    public function delete_user(Request $request){
        $user = UserModel::find($request->id);
        if ($user) {
            $result = $user->delete();
            if($result){
                return redirect('/admin/manager/user')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công!']);
            } else{
                return redirect('/admin/manager/user')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thất bại!']);
            }
            // Thông báo xóa thành công hoặc thực hiện các tác vụ khác sau khi xóa
        } else {
            // Xử lý khi không tìm thấy người dùng
            return redirect('/admin/manager/user')->with(['flash_level' => 'success', 'flash_message' => 'Không tìm thấy người dùng!']);
        }

    }
}
