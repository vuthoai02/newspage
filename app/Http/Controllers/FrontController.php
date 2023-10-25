<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\NewsModel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserModel;

class FrontController extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public function home()
    {
        $categories = CategoryModel::getAllCategories();
        $news = NewsModel::get_news(15);
        if ($news !== null && !$categories->isEmpty()) {
            return view('front.index', ['categories' => $categories, 'news' => $news]);
        }
    }
    public function detail($alias)
    {
        $categories = CategoryModel::getAllCategories();
        $news = NewsModel::get_only_news($alias);
        if ($news !== null) {
            $news->view += 1;
            $news->save();
            $newByAuthor = NewsModel::get_news_author($news->idUser, $news->id);
            return view('front.detail', ['categories' => $categories, 'news' => $news, 'newsByAuthor' => $newByAuthor]);
        }
        else{
            return view('front.detail', ['categories' => $categories, 'news' => null, 'newsByAuthor' => null]);
        }
    }

    public function get_news_category($alias)
    {
        $category = CategoryModel::where('alias', $alias)->first();
        if ($category) {
            $categories = CategoryModel::getAllCategories();
            $news = NewsModel::get_news_cat($category->id, 10);
            return view('front.index', [
                'categories' => $categories,
                'news' => $news,
            ]);
        }
    }

    public function search(Request $request)
    {
        $categories = CategoryModel::getAllCategories();
        $news = NewsModel::get_news_title($request->search, 10);
        if ($news !== null && !$categories->isEmpty()) {
            return view('front.index', ['categories' => $categories, 'news' => $news]);
        }
    }
}
