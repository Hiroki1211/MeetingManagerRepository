<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;
use App\Models\Tag;
use App\Models\Event;

class ClientController extends Controller
{
    public function main(Client $client){
        $client = $client->getFromID(Auth::guard('client')->user()->id);
        $events = $client -> registeredEvent();
        
        return view('/client/dashboard')->with(['events' => $events]);
    }
    
    
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
    
    public function edit(Event $event){
        $host = $event->host();
        $authID = Auth::guard('client')->user()->id;
        $clientRegistered = $event->client($authID);
        
        return view('client/edit')->with(['hosts' => $host, 'clientRegistered' => $clientRegistered, 'event' => $event]);
    }
    
    public function saveEdit(Request $request, Event $event){
        $authID = Auth::guard('client')->user()->id;
        $input_start = $request['start'];
        
        array_multisort( array_map( "strtotime", $input_start ), SORT_ASC, $input_start );
        foreach ($input_start as $value){
            $event->clients()->attach($authID, ['start' => $value, 'register' => null]);
        }
        
        return redirect('/client/dashboard');
    }
}
