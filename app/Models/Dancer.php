<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dancer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_entrance',
        ];

        public function clubs()
        {
            return $this->belongsToMany(Club::class);
        }

        public function parties()
        {
            return $this->belongsToMany(Party::class);
        }

            /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_entrance' => 'datetime',
        
    ];
}
