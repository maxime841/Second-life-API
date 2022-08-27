<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubDj extends Model
{
    
public function dj()
{
    return $this->belongsTo(Dj::class);
}
 
public function club()
{
    return $this->belongsTo(Club::class);
}

}
