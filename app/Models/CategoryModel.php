<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isEmpty;

class CategoryModel extends Model
{
    protected $table = "categories";

    public static function getCategories($paginate)
    {
        $categories = CategoryModel::paginate($paginate);

        if ($categories->isEmpty()) {
            return null;
        } else {
            return $categories;
        }
    }
    public static function getAllCategories()
    {
        $categories = CategoryModel::all();
        return $categories;
    }
}
