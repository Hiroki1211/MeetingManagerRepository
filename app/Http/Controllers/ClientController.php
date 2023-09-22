<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;
use App\Models\Tag;

class ClientController extends Controller
{
    public function member(Client $client){
        return view('/meeting/client-member')->with(['clients' => $client->get()]);
    }
    
    public function make(Request $request, Client $client, User $user){
        $input=$request['client'];
        $authID = Auth::user()->id;
        $group_id = $user->groupID($authID);
        $client->fill($input);
        $client->group_id = $group_id;
        $client->save();
        return redirect('/meeting/client/member');
    }
    
    public function pass(Request $request, Client $client){
        $input = $request['clientID'];
        $clients = $client->whereIn('id', $input)->get();
        return view('/meeting/client-member-delete')->with(['clients' => $clients]);
    }
    
    public function delete(Request $request, Client $client){
        $input = $request['clientID'];
        $clients = $client->whereIn('id', $input)->get();
        foreach($clients as $client){
            $client->delete();
        }
        return redirect('/meeting/client/member');
    }
    
    public function enchant(Request $request, Client $client, Tag $tag){
        $input=$request['tagID'];
        $tags = $tag->whereIn('id', $input)->get();
        return view('meeting/client-member-tag-enchant')->with(['clients' => $client->get(), 'tags' => $tags]);
    }
    
    public function saveTag(Request $request, Client $client, Tag $tag){
        $input_tag = $request->tagID;
        $input_client = $request['clientID'];
        $clients = $client->whereIn('id', $input_client)->get();
        foreach($clients as $client){
            
            $client->tags()->attach($input_tag);
        }
        return redirect('/meeting/client/member/tag');
    }    
}
