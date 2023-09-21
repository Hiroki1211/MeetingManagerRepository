<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tag;

class UserController extends Controller
{
    public function member(User $user){
        $authID = Auth::user()->id;
        $group_id = $user->groupID($authID);
        
        return view('meeting/member')->with(['users' => $user->where('group_id', '=', $group_id)->get()]);
    }
    
    public function tag(User $user){
        return view('meeting/member-tag')->with(['users' => $user->get()]);
    }
    
    public function setMember(User $user){
        return view('meeting/main-make-able-member')->with(['users' => $user->get()]);
    }
    
    public function enchant(Request $request, User $user, Tag $tag){
        $input=$request['tagID'];
        $tags = $tag->whereIn('id', $input)->get();
        return view('meeting/member-tag-enchant')->with(['users' => $user->get(), 'tags' => $tags]);
    }
    
    public function make(Request $request, User $user){
        $input=$request['user'];
        $authID = Auth::user()->id;
        $group_id = $user->groupID($authID);
        $user->fill($input);
        $user->group_id = $group_id;
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
    
    public function saveTag(Request $request, User $user, Tag $tag){
        $input_tag = $request->tagID;
        $input_user = $request['userID'];
        $users = $user->whereIn('id', $input_user)->get();
        foreach($users as $user){
            
            $user->tags()->attach($input_tag);
        }
        return redirect('/meeting/member/tag');
    }
}
