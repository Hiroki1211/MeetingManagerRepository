<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;
use App\Models\Tag;
use App\Models\Event;
use App\Http\Requests\ClientIDRequest;
use App\Http\Requests\ClientPostRequest;
use App\Http\Requests\TagIDRequest;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function main(Client $client){
        $client = $client->getFromID(Auth::guard('client')->user()->id);
        $events = $client -> registeredEvent();
        
        return view('/client/dashboard')->with(['events' => $events]);
    }
    
    public function result(Event $event){
        $authID = Auth::guard('client')->user()->id;
        $temps = $event->clients()->where('id', '=', $authID)->get();
        
        foreach($temps as $value){
            if($value->pivot->start != null){
                $temps2[] = $value;
            }
        }
        
        foreach($temps2 as $value){
            if($value->pivot->register != null){
                $registered = $value->pivot->start;
            }
        }
        
        return view('/client/result')->with(['registered' => $registered, 'event' => $event]);
    }
    
    
    public function member(Client $client, Tag $tag){
        return view('/meeting/client-member')->with(['clients' => $client->where('group_id', '=', Auth::user()->group_id)->get(), 'tags' => $tag->where('group_id', '=', Auth::user()->group_id)->get()]);
    }
    
    
    
    public function make(ClientPostRequest $request, Client $client, User $user){
        $input=$request['client'];
        $authID = Auth::user()->id;
        $group_id = Auth::user()->group_id;
        $client->fill($input);
        $client->group_id = $group_id;
        $client->password = Hash::make($client->password);
        $client->save();
        return redirect('/meeting/client/member');
    }
    
    public function narrow(Request $request, Client $client, Tag $tag){
        $input = $request['tag'];
        $group_id = Auth::user()->group_id;
        
        if($input == ""){
            return view('meeting/client-member')->with(['clients' => $client->where('group_id', '=', $group_id)->get(), 'tags' => $tag->where('group_id', '=', $group_id)->get()]);
        }else{
            $decidedTag = $tag->where('id', '=', $input)->first();
            $clients = $decidedTag->clients()->get();
            return view('meeting/client-member')->with(['clients' => $clients, 'tags' => $tag->where('group_id', '=', $group_id)->get()]); 
        }
        
    }
    
    public function pass(ClientIDRequest $request, Client $client){
        $input = $request['clientID'];
        $clients = $client->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
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
    
    public function enchant(TagIDRequest $request, Client $client, Tag $tag){
        $input=$request['tagID'];
        $tags = $tag->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        return view('meeting/client-member-tag-enchant')->with(['clients' => $client->where('group_id', '=', Auth::user()->group_id)->get(), 'tags' => $tags]);
    }
    
    public function saveTag(ClientIDRequest $request, Client $client, Tag $tag){
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
