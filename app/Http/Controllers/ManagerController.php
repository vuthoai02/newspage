<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function __construct()
    {
        @session_start();
    }

    public function user()
    {
        $users = UserModel::getUsers(10);
        return view('Manager.user.user', ['users' => $users]);
    }

    public function categories()
    {
        $categories = CategoryModel::getCategories(10);
        return view('Manager.category.categories',['categories' => $categories]);
    }

    public function add_categories()
    {
        $categories = CategoryModel::getAllCategories();
        return view('Manager.category.insert', ['categories'=>$categories]);
    }

    public function post_categories(Request $request)
    {
        $existCat = CategoryModel::where('name', $request->name)->exists();
        if($existCat){
            return redirect('/admin/manager/categories')->with(['flash_level' => 'danger', 'flash_message' => 'Danh mục đã tồn tại!']);
        }
        $category = new CategoryModel();
        $category->name= $request->name;
        $category->parentId= $request->parentId;
        $flag = $category->save();
        if ($flag) {
            return redirect('/admin/manager/categories')->with(['flash_level' => 'success', 'flash_message' => 'Thêm thành công!']);
        } else {
            return redirect('/admin/manager/categories')->with(['flash_level' => 'danger', 'flash_message' => 'Thêm danh mục không thành công!']);
        }
    }

    public function news()
    {
        $users = UserModel::where('username', '!=', 'Administrator')->get();
        return view('Manager.user.user', ['users' => $users]);
    }

    public function get_update_cat(Request $request)
    {
        $category = CategoryModel::find($request->id);
        if ($category) {
            return view('Manager.category.update', ['category' => $category]);
        } else {
            return redirect('/admin/manager/categories')->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy danh mục!']);
        }
    }

    public function update_cat(Request $request)
    {
        if(!isset($request->name) && !isset($request->parentId)){
            return redirect('/admin/manager/categories')->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền thông tin thay đổi!']);
        }
        $category = CategoryModel::find($request->id);
        $category->name = $request->name;
        $category->parentId = $request->parentId;
        $flag = $category->save();
        if($flag){ 
            return redirect('/admin/manager/update-category/'.$category->id)->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật thành công']);
        } else { 
            return redirect('/admin/manager/update-category/'.$category->id)->with(['flash_level' => 'danger', 'flash_message' => 'Cập nhật thất bại!']); 
        }
    }

    public function delete_user(Request $request)
    {
        $user = UserModel::find($request->id);
        if ($user) {
            $result = $user->delete();
            if ($result) {
                return redirect('/admin/manager/user')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công!']);
            } else {
                return redirect('/admin/manager/user')->with(['flash_level' => 'danger', 'flash_message' => 'Xóa thất bại!']);
            }
            // Thông báo xóa thành công hoặc thực hiện các tác vụ khác sau khi xóa
        } else {
            // Xử lý khi không tìm thấy người dùng
            return redirect('/admin/manager/user')->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy người dùng!']);
        }
    }

    public function delete_category(Request $request)
    {
        $category = CategoryModel::find($request->id);
        if ($category) {
            $result = $category->delete();
            if ($result) {
                return redirect('/admin/manager/categories')->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công!']);
            } else {
                return redirect('/admin/manager/categories')->with(['flash_level' => 'danger', 'flash_message' => 'Xóa thất bại!']);
            }
            // Thông báo xóa thành công hoặc thực hiện các tác vụ khác sau khi xóa
        } else {
            // Xử lý khi không tìm thấy người dùng
            return redirect('/admin/manager/categories')->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy người dùng!']);
        }
    }
}
