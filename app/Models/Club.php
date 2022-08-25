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
        'picture',
        ];

        public function djs()
        {
            return $this->belongsToMany(Dj::class);
        }

        public function dancers()
        {
            return $this->belongsToMany(Dancer::class);
        }

        public function parties()
        {
            return $this->belongsToMany(Party::class);
        }

        public function pictures()
        {
        return $this->morphMany(Picture::class, 'pictureable');
        }

}
