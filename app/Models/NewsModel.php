<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsModel extends Model
{
    protected $table = "news";

    public static function get_user_news($id,$paginate){
        $news = NewsModel::where('idUser', $id)->paginate($paginate, ['*'], 'pp');

        if ($news->isEmpty()){
            return null;
        } else {
            return $news;
        }
    }

    public static function get_news($paginate){
        $news = NewsModel::paginate($paginate, ['*'], 'pp');

        if ($news->isEmpty()){
            return null;
        } else {
            return $news;
        }
    }
}

