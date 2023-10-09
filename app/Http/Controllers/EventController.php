<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;
use App\Models\Client;
use App\Http\Requests\ClientIDRequest;
use App\Http\Requests\EventPostRequest;
use App\Http\Requests\EventIDRequest;

class EventController extends Controller
{
    public function main(Event $event){
        return view('/meeting/main')->with(['events' => $event->getGroup(Auth::user()->group_id)]);
    }
    
    public function make(EventPostRequest $request){
        $event = $request['event'];
        $authID = Auth::user()->id;

        return view('/meeting/main-make-able')->with(['event' => $event, 'authID' => $authID]);
    }
    
    public function delete(Event $event){
        return view('/meeting/main-delete')->with(['events' => $event->get()]);
    }
    
    public function checkDelete(EventIDRequest $request, Event $event){
        $input = $request['eventID'];
        $events = $event->whereIn('id', $input)->get();
        
        return view('/meeting/main-delete-check')->with(['events' => $events]);
    }
    
    public function completeDelete(Request $request, Event $event){
        $input = $request['eventID'];
        $events = $event->whereIn('id', $input)->get();
        
        foreach ($events as $event){
            $event->delete();
        }
        
        return redirect('/meeting');
    }
    
    public function member(Request $request, Event $event, Client $client){
        $input_start = $request['start'];
        $input_authID = $request['authID'];
        $input_event = $request['event'];
        
        return view('/meeting/main-make-able-member')->with(['start' => $input_start, 'authID' => $input_authID, 'event'=>$input_event, 'clients' => $client->get()]);
    }
    
    public function saveEvent(Request $request, Event $event , User $user, Client $client){
        $input_start = $request['start'];
        $input_authID = $request['authID'];
        $input_event = $request['event'];
        $input_clientID = $request['clientID'];

        $event->fill($input_event);
        $user->where('id', '=', $input_authID)->get();
        $event->group_id = $user->group_id;
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
    
    public function updateMember(Request $request, Event $event, Client $client){
        $input_start = $request['start'];
        $input_event = $request['event'];
        $event -> fill($input_event);
        $authID = $request['authID'];
        
        $registeredUser = $event->clients()->where('register', '<>', null)->get();

        return view('/meeting/main-edit-able-member')->with(['start' => $input_start, 'authID' => $authID, 'event'=>$event, 'clients' => $client->get(), 'registered' => $registeredUser]);  
    }
    
    public function update(Request $request, Event $event , User $user, Client $client){
        $input_start = $request['start'];
        $input_authID = $request['authID'];
        $input_event = $request['event'];
        $input_clientID = $request['clientID'];

        $event->fill($input_event);
        $event->update();
  
        foreach ($input_start as $value){
            $event->users()->syncWithoutDetaching($input_authID, ['start' => $value, 'register' => null]);
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
        
        array_multisort( array_map( "strtotime", $input_start ), SORT_ASC, $input_start );
        foreach ($input_start as $value){
            $event->clients()->attach($input_clientID, ['start' => $value, 'register' => null]);
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
                
                $start = $pieces[0]. "-" .$pieces[1];
                
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
