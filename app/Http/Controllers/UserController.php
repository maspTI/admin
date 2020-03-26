<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if(request()->wantsJson()){
            $users = new User;
            return $users->search(request()->all());
        }
        return view('users.index');
    }
}
