<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tag;
use App\Http\Requests\UserIDRequest;
use App\Http\Requests\TagIDRequest;
use App\Http\Requests\MemberPostRequest;

class UserController extends Controller
{
    public function member(User $user){

        $group_id = Auth::user()->group_id;
        
        return view('meeting/member')->with(['users' => $user->where('group_id', '=', $group_id)->get()]);
    }
    
    public function tag(User $user){
        return view('meeting/member-tag')->with(['users' => $user->where('group_id', '=', Auth::user()->group_id)->get()]);
    }
    
    public function setMember(User $user){
        return view('meeting/main-make-able-member')->with(['users' => $user->where('group_id', '=', Auth::user()->group_id)->get()]);
    }
    
    public function enchant(TagIDRequest $request, User $user, Tag $tag){
        $input=$request['tagID'];
        $tags = $tag->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        return view('meeting/member-tag-enchant')->with(['users' => $user->where('group_id', '=', Auth::user()->group_id)->get(), 'tags' => $tags]);
    }
    
    public function make(MemberPostRequest $request, User $user){
        $input=$request['user'];
        $group_id = Auth::user()->group_id;
        $user->group_id = $group_id;
        $user->fill($input);
        $user->save();
        return redirect('/meeting/member');
    }
 
    public function pass(UserIDRequest $request, User $user){
        $input = $request['userID'];
        $users = $user->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        return view('/meeting/member-delete')->with(['users' => $users]);
    }
    
    public function delete(Request $request, User $user){
        $input = $request['userID'];
        $users = $user->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        foreach($users as $user){
            $user->delete();
        }
        return redirect('/meeting/member');
    }
    
    public function saveTag(UserIDRequest $request, User $user, Tag $tag){
        $input_tag = $request->tagID;
        $input_user = $request['userID'];
        $users = $user->whereIn('id', $input_user)->where('group_id', '=', Auth::user()->group_id)->get();
        foreach($users as $user){
            
            $user->tags()->attach($input_tag);
        }
        return redirect('/meeting/member/tag');
    }
}
