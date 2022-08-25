<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner',
        'presentation',
        'prims',
        'remaining_house_prims',
        'date_start_rent',
        'date_end_rent',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
