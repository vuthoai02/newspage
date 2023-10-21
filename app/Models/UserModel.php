<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isEmpty;

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
        $users = UserModel::where('username', '!=', 'Administrator')->paginate($paginate, ['*'], 'pp');

        if ($users->isEmpty()){
            return null;
        } else {
            return $users;
        }
    }
}

?>



