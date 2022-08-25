<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dj extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'style',
        'date_entrance',
        ];

        public function clubs()
    {
        return $this->belongsToMany(Club::class);
    }
}

        

