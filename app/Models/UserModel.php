<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'users'; // Tên bảng trong cơ sở dữ liệu

    protected $fillable = [
        'username', 'email', 'password',
    ];

    protected $hidden = [
        'password','remember_token',
    ];
}

?>



