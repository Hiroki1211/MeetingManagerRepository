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
        'group_id'
    ];
    
    public function getGroup(int $group_id){
        return $this->where('group_id', '=', $group_id)->get();
    }
    
    public function users(){
        return $this -> belongsToMany(User::class)->withPivot('start', 'register');
    }
    
    public function clients(){
        return $this -> belongsToMany(Client::class)->withPivot('start', 'register');
    }
    
    public function checked(int $user_id){
        return $this -> users() -> where('user_id', '=', $user_id)->get();
    }
    
    // ホストが登録できないようにした日程を取得
    public function host(){
        return $this -> users() -> where([
                ['start', '<>', NULL],
            ])
            ->get();
    }
    
    //クライアントが登録した日程を取得
    public function client(int $authID){
        return $this -> clients() -> where([
                ['start', '<>', NULL],
                ['register', '=', NULL],
            ])
            ->get();
    }
    
    //登録されているユーザを取得
    public function registered(int $authID){
        return $this -> clients() -> where([
                ['start', '=', NULL],
                ['register', '=', $authID],
            ])
            ->get();
    }
    
    //決定したユーザを取得
    public function decided(int $authID){
        return $this -> clients() -> where([
                ['start', '<>', NULL],
                ['register', '=', $authID],
            ])
            ->get();
    }
}