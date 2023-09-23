<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;
use App\Models\Client;

class EventController extends Controller
{
    public function main(Event $event){
        return view('/meeting/main')->with(['events' => $event->get()]);
    }
    
    public function make(Request $request){
        $event = $request['event'];
        $authID = Auth::user()->id;

        return view('/meeting/main-make-able')->with(['event' => $event, 'authID' => $authID]);
    }
    
    public function delete(Event $event){
        return view('/meeting/main-delete')->with(['events' => $event->get()]);
    }
    
    public function checkDelete(Request $request, Event $event){
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
        $event->rest = $user->group_id;
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
    
    public function updateAble(Request $request, Event $event){
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
  
        $event->users()->detach();
        $event->clients()->detach();
        foreach ($input_start as $value){
            $event->users()->attach($input_authID, ['start' => $value, 'register' => null]);
        }
        $event->clients()->attach($input_clientID, ['start' => null, 'register' => $input_authID]);
        
        return redirect('/meeting');
    }
    
    public function decide(Event $event){
        
        $authID = Auth::user()->id;
        $hosts = $event->host($authID);
        $clients = $event->client($authID);
        $register = $event->registered($authID);
        
        return view('/meeting/main-decide')->with(['event' => $event, 'authID' => $authID, 'hosts' => $hosts, 'clients' => $clients, 'register' => $register]);
    }
    
    public function manualClient(Event $event, Client $client){
        $authID = Auth::user()->id;
        $register = $event->registered($authID);
        
        return view('/meeting/main-manual')->with(['event' => $event, 'register' => $register]);
    }
    
    public function manualAble(Event $event, Client $client, Request $request){
        $authID = Auth::user()->id;
        $hosts = $event->host($authID);
        $input = $request['clientID'];
        $client = $client -> where('id', '=', $input) -> first();
        
        return view('/meeting/main-manual-able')->with(['event' => $event, 'hosts' => $hosts, 'client' => $client]);
    }
    
    public function manualSave(Request $request, Event $event){
        $input_clientID = $request['clientID'];
        $input_start = $request['start'];
        
        foreach ($input_start as $value){
            $event->clients()->attach($input_clientID, ['start' => $value, 'register' => null]);
        }
        
        return redirect('/meeting');
    }
}
