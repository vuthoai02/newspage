<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserModel;

class BackController extends Controller
{
    public function __construct(){
        session_start();
    }

    public function home(){
        return view('back.home.home');
    }
}