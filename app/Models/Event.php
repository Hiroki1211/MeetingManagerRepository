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
        return $this -> belongsToMany(User::class);
    }
    
}