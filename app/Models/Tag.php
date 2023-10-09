<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'color',
        'group_id'
    ];

    public $timestamps = false;
    
    public function getGroup(int $group_id){
        return $this->where('group_id', '=', $group_id)->get();
    }
    
    public function users(){
        return $this -> belongsToMany(User::class);
    }
    
    public function clients(){
        return $this -> belongsToMany(Client::class);
    }

}
