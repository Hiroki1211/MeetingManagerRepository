<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'edit_limit',
        'day_start',
        'day_end',
        'frame',
        'time_start',
        'time_end',
        'locate',
        'comment',
        'rest'
    ];
    
    public function users(){
        return $this -> belongsToMany(User::class)->withPivot('start');
    }
    
    public function clients(){
        return $this -> belongsToMany(Client::class)->withPivot('start');
    }
    
    public function checked(int $user_id){
        return $this -> users() -> where('user_id', '=', $user_id)->get();
    }
    
    public function host(int $authID){
        return $this -> users() -> where([
                ['start', '<>', NULL],
                ['user_id', '=', $authID],
            ])
            ->get();
    }
    
    public function client(int $authID){
        return $this -> users() -> where([
                ['start', '<>', NULL],
                ['user_id', '<>', $authID],
            ])
            ->get();
    }
    
    public function registered(int $authID){
        return $this -> users() -> where([
                ['start', '=', NULL],
                ['register', '=', $authID],
            ])
            ->get();
    }
}