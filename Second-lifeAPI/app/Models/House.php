<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    public function picturehouse()
    {
        return $this->belongsTo(picturehouse::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenants::class);
    }
}
