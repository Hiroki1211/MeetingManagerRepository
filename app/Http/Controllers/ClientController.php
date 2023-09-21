<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\User;

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
}
