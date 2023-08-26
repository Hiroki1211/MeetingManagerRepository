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
}