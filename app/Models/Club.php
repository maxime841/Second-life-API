<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner',
        'party_id',
        'dj_id',
        'dancer_id',
        ];

        public function djs()
        {
            return $this->belongsToMany(Dj::class);
        }

}
