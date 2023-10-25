<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    protected $table = "news";

    public static function get_user_news($id, $paginate)
    {
        $news = NewsModel::join('categories', 'news.idCat', '=', 'categories.id')
            ->join('users', 'news.idUser', '=', 'users.id')->where('news.idUser', $id)
            ->select('news.*', 'categories.name AS nameCat', 'users.username')
            ->orderBy('news.created_at', 'desc')
            ->paginate($paginate, ['*'], 'pp');

        if ($news->isEmpty()) {
            return null;
        } else {
            return $news;
        }
    }

    public static function get_only_news($alias)
    {
        $news = NewsModel::join('categories', 'news.idCat', '=', 'categories.id')
            ->join('users', 'news.idUser', '=', 'users.id')
            ->where('news.alias', $alias)
            ->select('news.*', 'categories.name AS nameCat', 'users.username')
            ->first();

        if ($news === null) {
            return null;
        } else {
            return $news;
        }
    }

    public static function get_news($paginate)
    {
        $news = NewsModel::join('categories', 'news.idCat', '=', 'categories.id')
            ->join('users', 'news.idUser', '=', 'users.id')
            ->select('news.*', 'categories.name AS nameCat', 'users.username')
            ->orderBy('news.created_at', 'desc')
            ->paginate($paginate, ['*'], 'pp');

        if ($news->isEmpty()) {
            return null;
        } else {
            return $news;
        }
    }
    public static function get_news_author($id, $newsId)
    {
        $news = NewsModel::join('categories', 'news.idCat', '=', 'categories.id')
            ->join('users', 'news.idUser', '=', 'users.id')
            ->where('news.idUser', $id)
            ->where('news.id', '!=', $newsId)
            ->select('news.*', 'categories.name AS nameCat', 'users.username')
            ->orderBy('news.created_at', 'desc')
            ->limit(9)->get();

        if ($news->isEmpty()) {
            return null;
        } else {
            return $news;
        }
    }

    public static function get_news_title($text,$paginate)
    {
        $news = NewsModel::join('categories', 'news.idCat', '=', 'categories.id')
            ->join('users', 'news.idUser', '=', 'users.id')
            ->where('news.title', 'like','%'.$text.'%')
            ->select('news.*', 'categories.name AS nameCat', 'users.username')
            ->orderBy('news.created_at', 'desc')
            ->paginate($paginate, ['*'], 'pp');

        if ($news->isEmpty()) {
            return null;
        } else {
            return $news;
        }
    }
    public static function get_news_cat($id,$paginate)
    {
        $news = NewsModel::join('categories', 'news.idCat', '=', 'categories.id')
            ->join('users', 'news.idUser', '=', 'users.id')
            ->where('news.idCat', $id)
            ->select('news.*', 'categories.name AS nameCat', 'users.username')
            ->orderBy('news.created_at', 'desc')
            ->paginate($paginate, ['*'], 'pp');

        if ($news->isEmpty()) {
            return null;
        } else {
            return $news;
        }
    }
}
