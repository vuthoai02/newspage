<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'users';
    public $timestamps = true;

    protected $fillable = [
        'email', 'password','username','role'
    ];

    protected $hidden = [
        'password','remember_token',
    ];

    public static function getUsers($paginate){
        return UserModel::where('username', '!=', 'Administrator')->paginate($paginate, ['*'], 'pp');
    }
}

?>



