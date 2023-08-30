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
        'color'
    ];

    public $timestamps = false;
    
    public function users(){
        return $this -> belongsToMany(User::class);
    }

}
