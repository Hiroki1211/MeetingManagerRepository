<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database_Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ClientResetPassword as ResetPasswordNotification;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'group_id',
        'email',
        'password',
        'name_last',
        'name_first',
        'name_last_read',
        'name_first_read'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // public function events(){
    //     return $this->belongsToMany(Event::class);
    // }
    
    // public function tags(){
    //     return $this->belongsToMany(Tag::class);
    // }
    
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    
    public function tags(){
        return $this->belongsToMany(Tag::class);
    } 
    
    public function events(){
        return $this->belongsToMany(Event::class)->withPivot('start');
    }
    
    public function getFromNameLast(string $name_last){
        return $this->where('name_last', '=', $name_last)->first();
    }
    
    public function getFromID(int $id){
        return $this->where('id', '=', $id) -> first();
    }
    
    public function registeredEvent(){
        return $this -> events() -> where([
                ['start', '=', NULL],
            ])
            ->get();
    }
}
