<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\NewsModel;
use App\Models\UserModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


function RemoveAccents($str)
{
    $accentedChars = 'ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ';
    $unaccentedChars = 'AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn';
    $str = strtr($str, $accentedChars, $unaccentedChars);
    return $str;
}
function ChangeToSlug($title)
{
    $slug = strtolower($title);
    $slug = RemoveAccents($slug);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');
    return $slug;
}
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
        return view('Manager.category.categories', ['categories' => $categories]);
    }

    public function add_categories()
    {
        $categories = CategoryModel::getAllCategories();
        return view('Manager.category.insert', ['categories' => $categories]);
    }

    public function add_news()
    {
        $categories = CategoryModel::getAllCategories();
        return view('Manager.news.insert', ['categories' => $categories]);
    }

    public function upload_images(Request $request): JsonResponse
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            $request->session()->put('uploadedImageUrl', 'media/'.$fileName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        } else {
            echo "không có file !";
        }
    }

    public function post_news(Request $request)
    {
        if (!isset($request->title) && !isset($request->idCat) && !isset($request->content)) {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền đầy đủ!']);
        }
        $imageUrl = $request->session()->get('uploadedImageUrl');
        //POST
        $news = new NewsModel();
        $news->title = $request->title;
        $news->idUser = $request->idUser;
        $news->description = $request->description;
        $news->alias = ChangeToSlug($request->title);
        $news->idCat = $request->idCat;
        $news->imgUrl = $imageUrl;
        $news->content = $request->content;
        $news->view = 0;
        $flag = $news->save();
        if ($flag) {
            return redirect()->back()->with(['flash_level' => 'success', 'flash_message' => 'Đăng thành công!']);
        } else {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Đăng bài thất bại!']);
        }
    }

    public function post_categories(Request $request)
    {
        $existCat = CategoryModel::where('name', $request->name)->exists();
        if ($existCat) {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Danh mục đã tồn tại!']);
        }
        $category = new CategoryModel();
        $category->name = $request->name;
        $category->alias = ChangeToSlug($request->name);
        $flag = $category->save();
        if ($flag) {
            return redirect()->back()->with(['flash_level' => 'success', 'flash_message' => 'Thêm thành công!']);
        } else {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Thêm danh mục không thành công!']);
        }
    }

    public function get_user_news($id)
    {
        $news = NewsModel::get_user_news($id, 10);
        return view('Manager.news.news', ['news' => $news]);
    }

    public function get_admin_news()
    {
        $news = NewsModel::get_news(10);
        return view('Manager.news.news', ['news' => $news]);
    }

    public function get_update_cat($id)
    {
        $category = CategoryModel::find($id);
        if ($category) {
            return view('Manager.category.update', ['category' => $category]);
        } else {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy danh mục!']);
        }
    }

    public function get_update_news($id)
    {
        $news = NewsModel::find($id);
        if ($news) {
            return view('Manager.news.update', ['news' => $news]);
        } else {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy bài viết!']);
        }
    }

    public function update_news(Request $request)
    {
        if (!isset($request->title) || !isset($request->idCat) || !isset($request->content)) {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền thông tin thay đổi!']);
        }
        $updatenew = NewsModel::find($request->id);
        if ($updatenew) {
            $updatenew->title = $request->title;
            $updatenew->idUser = $request->idUser;
            $updatenew->description = $request->description;
            $updatenew->alias = $request->alias;
            $updatenew->idCat = $request->idCat;
            $updatenew->content = $request->content;
            $updatenew->view = $request->view;
            $flag = $updatenew->save();
            if ($flag) {
                return redirect()->back()->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật thành công']);
            } else {
                return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Cập nhật thất bại!']);
            }
        } else {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy bài đăng để cập nhật!']);
        }
    }

    public function update_cat(Request $request)
    {
        if (!isset($request->name) || !isset($request->parentId)) {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Vui lòng điền thông tin thay đổi!']);
        }
        $category = CategoryModel::find($request->id);
        $category->name = $request->name;
        $category->alias = $request->alias;
        $flag = $category->save();
        if ($flag) {
            return redirect()->back()->with(['flash_level' => 'success', 'flash_message' => 'Cập nhật thành công']);
        } else {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Cập nhật thất bại!']);
        }
    }

    public function delete_user(Request $request)
    {
        $user = UserModel::find($request->id);
        if ($user) {
            $newsOfUser = NewsModel::where('idUser', $request->id)->get();
            foreach ($newsOfUser as $post) {
                $post->delete();
            }
            $result = $user->delete();
            if ($result) {
                return redirect()->back()->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công!']);
            } else {
                return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Xóa thất bại!']);
            }
            // Thông báo xóa thành công hoặc thực hiện các tác vụ khác sau khi xóa
        } else {
            // Xử lý khi không tìm thấy người dùng
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy người dùng!']);
        }
    }

    public function delete_category(Request $request)
    {
        $category = CategoryModel::find($request->id);
        if ($category) {
            $result = $category->delete();
            if ($result) {
                return redirect()->back()->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công!']);
            } else {
                return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Xóa thất bại!']);
            }
            // Thông báo xóa thành công hoặc thực hiện các tác vụ khác sau khi xóa
        } else {
            // Xử lý khi không tìm thấy người dùng
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy người dùng!']);
        }
    }

    public function delete_news(Request $request)
    {
        $news = NewsModel::find($request->id);
        if ($news) {
            $imageUrl = $news->imgUrl;
            $result = $news->delete();
            if ($result) {
                $imagePath = public_path($imageUrl);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                return redirect()->back()->with(['flash_level' => 'success', 'flash_message' => 'Xóa thành công!']);
            } else {
                return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Xóa thất bại!']);
            }
            // Thông báo xóa thành công hoặc thực hiện các tác vụ khác sau khi xóa
        } else {
            // Xử lý khi không tìm thấy người dùng
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy bài viết!']);
        }
    }

    public function search_news(Request $request)
    {
        $news = NewsModel::get_news_title($request->search, 10);
        if ($news) {
            return view('Manager.news.news', ['news' => $news]);
        } else {
            return redirect()->back()->with(['flash_level' => 'danger', 'flash_message' => 'Không tìm thấy bài viết!']);
        }
    }
}
