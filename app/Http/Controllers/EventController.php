<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function make(Request $request, Event $event){
        $input = $request['event'];
        $event->fill($input);
        // $event->save();
        return view('/meeting/main-make-able')->with(['event' => $event]);
    }
    
    public function member(Request $request, Event $event){
        $input = $request['event'];
        
        return redirect('/meeting/main/make/able/member');
    }
}
