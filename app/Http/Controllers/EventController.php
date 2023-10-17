<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;
use App\Models\Client;
use App\Models\Tag;
use App\Http\Requests\ClientIDRequest;
use App\Http\Requests\EventPostRequest;
use App\Http\Requests\EventIDRequest;
use DateTime;

class EventController extends Controller
{
    public function main(Event $event){
        return view('/meeting/main')->with(['events' => $event->where('group_id', '=', Auth::user()->group_id)->get()]);
    }
    
    public function make(EventPostRequest $request){
        $event = $request['event'];
        $authID = Auth::user()->id;

        return view('/meeting/main-make-able')->with(['event' => $event, 'authID' => $authID]);
    }
    
    public function delete(Event $event){
        return view('/meeting/main-delete')->with(['events' => $event->where('group_id', '=', Auth::user()->group_id)->get()]);
    }
    
    public function checkDelete(EventIDRequest $request, Event $event){
        $input = $request['eventID'];
        $events = $event->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        
        return view('/meeting/main-delete-check')->with(['events' => $events]);
    }
    
    public function completeDelete(Request $request, Event $event){
        $input = $request['eventID'];
        $events = $event->whereIn('id', $input)->where('group_id', '=', Auth::user()->group_id)->get();
        
        foreach ($events as $event){
            $event->users()->detach();
            $event->clients()->detach();
            $event->delete();
        }
        
        return redirect('/meeting');
    }
    
    public function member(Request $request, Event $event, Client $client, Tag $tag){
        $input_start = $request['start'];
        $input_authID = $request['authID'];
        $input_event = $request['event'];
        $input_tagID = $request['tagID'];
        
        if($input_tagID == ""){
            $clients = $client->where('group_id', '=', Auth::user()->group_id)->get();
        }else{
            $tmp = $tag->where('id', '=', $input_tagID)->first();
            $clients = $tmp->clients()->get();
        }
        
        return view('/meeting/main-make-able-member')->with(['start' => $input_start, 'authID' => $input_authID, 'event'=>$input_event, 'clients' => $clients, 'tags' => $tag->get()]);
    }
    
    public function saveEvent(Request $request, Event $event , User $user, Client $client){
        $input_start = $request['start'];
        $input_authID = $request['authID'];
        $input_event = $request['event'];
        $input_clientID = $request['clientID'];

        $event->fill($input_event);
        $user->where('id', '=', $input_authID)->where('group_id', '=', Auth::user()->group_id)->get();
        $event->group_id = Auth::user()->group_id;
        $event->save();
        foreach ($input_start as $value){
            $event->users()->attach($input_authID, ['start' => $value, 'register' => null]);
        }
        $event->clients()->attach($input_clientID, ['start' => null, 'register' => $input_authID]);
        
        return redirect('/meeting');
    }
    
    public function edit(Event $event){
        return view('/meeting/main-edit')->with(['event' => $event]);
    }
    
    public function updateAble(EventPostRequest $request, Event $event){
        $input = $request['event'];
        $authID = Auth::user()->id;
        
        $registered = $event -> checked(Auth::user()->id);
        $event -> fill($input);

        return view('/meeting/main-edit-able')->with(['event'=>$event, 'authID' => $authID, 'registered'=> $registered]);
    }
    
    public function updateMember(Request $request, Event $event, Client $client, Tag $tag){
        $input_start = $request['start'];
        $input_event = $request['event'];
        $event -> fill($input_event);
        $authID = $request['authID'];
        $input_tag = $request['tagID'];
        if($input_tag == ""){
            $clients = $client->where('group_id', '=', Auth::user()->group_id)->get();
        }else{
            $tmp = $tag->where('id', '=', $input_tag)->first();
            $clients = $tmp->clients()->get();
        }
        
        $registeredUser = $event->clients()->where('register', '<>', null)->where('group_id', '=', Auth::user()->group_id)->get();

        return view('/meeting/main-edit-able-member')->with(['start' => $input_start, 'authID' => $authID, 'event'=>$event, 'clients' => $clients, 'registered' => $registeredUser, 'tags' => $tag->get()]);  
    }
    
    public function update(Request $request, Event $event , User $user, Client $client){
        $input_start = $request['start'];
        $input_authID = $request['authID'];
        $input_event = $request['event'];
        $input_clientID = $request['clientID'];

        $event->fill($input_event);
        $event->update();
        $event->users()->detach($input_authID);
  
        foreach ($input_start as $value){
            $event->users()->attach($input_authID, ['start' => $value, 'register' => null]);
        }
        $event->clients()->syncWithoutDetaching($input_clientID, ['start' => null, 'register' => $input_authID]);
        $event->clients()->updateExistingPivot($input_clientID, ['register' => $input_authID]);
        
        return redirect('/meeting');
    }
    
    public function decide(Event $event){
        
        $authID = Auth::user()->id;
        $hosts = $event->host();
        $clients = $event->client($authID);
        $register = $event->registered($authID);
        
        return view('/meeting/main-decide')->with(['event' => $event, 'authID' => $authID, 'hosts' => $hosts, 'clients' => $clients, 'register' => $register]);
    }
    
    public function manualClient(Event $event, Client $client){
        $authID = Auth::user()->id;
        $register = $event->registered($authID);
        
        return view('/meeting/main-manual')->with(['event' => $event, 'register' => $register]);
    }
    
    public function manualAble(Event $event, Client $client, ClientIDRequest $request){
        $authID = Auth::user()->id;
        $hosts = $event->host();
        $input = $request['clientID'];
        $client = $client -> where('id', '=', $input) -> first();
        
        return view('/meeting/main-manual-able')->with(['event' => $event, 'hosts' => $hosts, 'client' => $client]);
    }
    
    public function manualSave(Request $request, Event $event){
        $input_clientID = $request['clientID'];
        $input_start = $request['start'];
        $temps = $event->clients()->where([
            ['id', '=', $input_clientID],
            ['start', '<>', NULL],
            ['register', '=', NULL]
            ])->get();
        
        
        array_multisort( array_map( "strtotime", $input_start ), SORT_ASC, $input_start );
        foreach ($input_start as $value){
            $check = 0;
            foreach($temps as $temp){
                $registered = new DateTime($temp->pivot->start);
                $post = new DateTime($value);

                
                if($value == $temp->pivot->start){
                    $check = 1;
                }
            }
            
            if($check == 0){
                $event->clients()->attach($input_clientID, ['start' => $value, 'register' => null]);
            }
        }
        
        return redirect('/meeting');
    }
    
    public function result(Request $request, Event $event, Client $client){
        $input = $request['register'];
        $authID = Auth::user()->id;
        
        for($i = 0; $i < count($input); $i++){
            $pieces = explode(" ", $input[$i]);
            
            if(count($pieces) == 1){
                
            }else{
                $client = $client->getFromNameLast($pieces[2]);
                
                $start = $pieces[0]. " " .$pieces[1];
                
                $event->clients()->attach($client->id, ['start' => $start, 'register' => $authID]);
            }
        }
        
        return redirect('/meeting');
    }
    
    public function showResult(Event $event, Client $client){
        $authID = Auth::user()->id;
        $decided = $event -> decided($authID);
        $name_last = [];
        $name_first = [];
        foreach($decided as $value){
            $temp = $client -> getFromID($value->id);
            $name_last[] = $temp -> name_last;
            $name_first[] = $temp -> name_first;
        }

        return view('/meeting/main-result')->with(['event' => $event, 'decided' => $decided, 'name_last' => $name_last, 'name_first' => $name_first]);
    }
}
