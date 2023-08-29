<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function make(Request $request, Tag $tag){
        $input = $request['tag'];
        $tag->name = $input["name"];
        $tag->color = $input["color"];
        $tag->save();
        return redirect('/meeting/member/tag');
    }

    public function tag(Tag $tag){
        return view('meeting/member-tag')->with(['tags' => $tag->get()]);
    }
    
    public function search(Request $request, Tag $tag){
        $input = $request['tagID'];
        $tags = $tag->whereIn('id', $input)->get();
        return view("meeting/member-tag-delete")->with(['tags' => $tags]);
    }
    
    public function delete(Request $request, Tag $tag){
        $input = $request['tagID'];
        $tags = $tag->whereIn('id', $input)->get();
        foreach ($tags as $tag){
            $tag->delete();
        }
        return redirect('/meeting/member/tag');
    }
}