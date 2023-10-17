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
}
