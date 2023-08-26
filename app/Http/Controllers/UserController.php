<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function member(User $user){
        return view('meeting/member')->with(['users' => $user->get()]);
    }
}
