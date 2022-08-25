<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner',
        'date_party'
        ];

        public function djs()
    {
        return $this->belongsToMany(Dj::class);
    }

    public function dancers()
    {
        return $this->belongsToMany(Dancer::class);
    }

    public function clubs()
    {
        return $this->belongsToMany(Club::class);
    }

    public function pictures()
        {
        return $this->morphMany(Picture::class, 'pictureable');
        }
}
