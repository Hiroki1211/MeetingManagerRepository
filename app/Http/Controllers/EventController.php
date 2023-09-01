<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\User;

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
    
    public function member(Request $request, Event $event, User $user){
        $input_start = $request['start'];
        $input_authID = $request['authID'];
        $input_event = $request['event'];
        
        return view('/meeting/main-make-able-member')->with(['start' => $input_start, 'authID' => $input_authID, 'event'=>$input_event, 'users' => $user->get()]);
    }
    
    public function saveEvent(Request $request, Event $event , User $user){
        $input_start = $request['start'];
        $input_authID = $request['authID'];
        $input_event = $request['event'];
        $input_userID = $request['userID'];

        $event->fill($input_event);
        $event->save();
        foreach ($input_start as $value){
            $event->users()->attach($input_authID, ['start' => $value, 'register' => null]);
        }
        $event->users()->attach($input_userID, ['start' => null, 'register' => $input_authID]);
        
        return redirect('/meeting');
    }
}
