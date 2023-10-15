<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tag;
use App\Http\Requests\UserIDRequest;
use App\Http\Requests\TagIDRequest;
use App\Http\Requests\MemberPostRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function member(User $user, Tag $tag){

        $group_id = Auth::user()->group_id;
        
        return view('meeting/member')->with(['users' => $user->where('group_id', '=', $group_id)->get(), 'tags' => $tag->where('group_id', '=', $group_id)->get()]);
    }
    
    public function narrow(Request $request, User $user, Tag $tag){
        $input = $request['tag'];
        $group_id = Auth::user()->group_id;
        
        if($input == ""){
            return view('meeting/member')->with(['users' => $user->where('group_id', '=', $group_id)->get(), 'tags' => $tag->where('group_id', '=', $group_id)->get()]);
        }else{
            $decidedTag = $tag->where('id', '=', $input)->first();
            $users = $decidedTag->users()->get();
            return view('meeting/member')->with(['users' => $users, 'tags' => $tag->where('group_id', '=', $group_id)->get()]); 
        }
        
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
        
        $users = $user->where('group_id', '=', Auth::user()->group_id)->get();
        
        return view('meeting/member-tag-enchant')->with(['users' => $users, 'tags' => $tags]);
    }
    
    public function make(MemberPostRequest $request, User $user){
        $input=$request['user'];
        $group_id = Auth::user()->group_id;
        $user->group_id = $group_id;
        $user->fill($input);
        $user->password = Hash::make($user->password);
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
            $temps = $user->tags()->get();
            foreach($input_tag as $value){
                $check = 0;
                foreach($temps as $temp){
                    if($value == $temp->id){
                        $check = 1;
                    }
                }
                
                if($check != 1){
                    $user->tags()->attach($value);
                }
            }
        }
        return redirect('/meeting/member/tag');
    }
    
    public function detach(Tag $tag){
        return view('/meeting/member-tag-detach')->with(['tags' => $tag->get()]);
    }
    
    public function detachUser(TagIDRequest $request, Tag $tag){
        $input = $request['tagID'];
        
        $tag = $tag -> where('id', '=', $input)->first();
        $users = $tag->users()->get();
        
        return view('/meeting/member-tag-detach-user')->with(['users' => $users, 'tag' => $tag]);
    }
    
    public function detachEnd(UserIDRequest $request, User $user, Tag $tag){
        $input = $request['userID'];
        $tagID = $request['tagID'];
        $users = $user->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        
        $tag = $tag->where('id', '=', $tagID)->first();
        $tag -> users() -> detach($users);
        
        return redirect('/meeting/member/tag');
    }
}
