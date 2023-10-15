<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\User;
use App\Models\Client;
use App\Http\Requests\TagIDRequest;
use App\Http\Requests\TagPostRequest;

class TagController extends Controller
{
    public function make(TagPostRequest $request, Tag $tag, User $user){
        $input = $request['tag'];
        $tag->name = $input["name"];
        $tag->color = $input["color"];
        $authID = Auth::user()->id;
        $group_id = Auth::user()->group_id;
        $tag -> group_id = $group_id;
        $tag->save();
        return redirect('/meeting/member/tag');
    }
    
    public function clientMake(TagPostRequest $request, Tag $tag, User $user){
        $input = $request['tag'];
        $tag->name = $input["name"];
        $tag->color = $input["color"];
        $authID = Auth::user()->id;
        $group_id = Auth::user()->group_id;
        $tag -> group_id = $group_id;
        $tag->save();
        return redirect('/meeting/client/member/tag');
    }    

    public function tag(Tag $tag){
        return view('meeting/member-tag')->with(['tags' => $tag->where('group_id', '=', Auth::user()->group_id)->get()]);
    }
    
    public function search(TagIDRequest $request, Tag $tag){
        $input = $request['tagID'];
        $tags = $tag->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        return view("meeting/member-tag-delete")->with(['tags' => $tags]);
    }
    
    public function clientSearch(TagIDRequest $request, Tag $tag){
        $input = $request['tagID'];
        $tags = $tag->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        return view("meeting/client-member-tag-delete")->with(['tags' => $tags]);
    }    
    
    public function delete(Request $request, Tag $tag){
        $input = $request['tagID'];
        $tags = $tag->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        foreach ($tags as $tag){
            $tag->users()->detach();
            $tag->clients()->detach();
            $tag->delete();
        }
        return redirect('/meeting/member/tag');
    }
    
    public function clientTag(Tag $tag){
        return view('meeting/client-member-tag')->with(['tags' => $tag->where('group_id', '=', Auth::user()->group_id)->get()]);
    }
    
    public function clientDelete(Request $request, Tag $tag){
        $input = $request['tagID'];
        $tags = $tag->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        foreach ($tags as $tag){
            $tag->users()->detach();
            $tag->clients()->detach();
            $tag->delete();
        }
        return redirect('/meeting/client/member/tag');
    }    
}