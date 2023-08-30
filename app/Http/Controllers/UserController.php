<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function member(User $user){
        return view('meeting/member')->with(['users' => $user->get()]);
    }
    
    public function tag(User $user){
        return view('meeting/member-tag')->with(['users' => $user->get()]);
    }
    
    public function setMember(User $user){
        return view('meeting/main-make-able-member')->with(['users' => $user->get()]);
    }
    
    public function enchant(Request $request, User $user){
        // $input=$request['tagID'];
        // $tags = $tag->whereIn('id', $input)->get();
        return view('meeting/member-tag-enchant')->with(['users' => $user->get()]);
    }
    
    public function make(Request $request, User $user){
        $input=$request['user'];
        $user->fill($input);
        $user->name = "aa";
        $user->save();
        return redirect('/meeting/member');
    }
 
    public function pass(Request $request, User $user){
        $input = $request['userID'];
        $users = $user->whereIn('id', $input)->get();
        return view('/meeting/member-delete')->with(['users' => $users]);
    }
    
    public function delete(Request $request, User $user){
        $input = $request['userID'];
        $users = $user->whereIn('id', $input)->get();
        foreach($users as $user){
            $user->delete();
        }
        return redirect('/meeting/member');
    }
}
