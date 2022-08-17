<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pictureland extends Model
{
    use HasFactory;

    public function lands()
    {
        return $this->hasMany(Lands::class);
    }
}
