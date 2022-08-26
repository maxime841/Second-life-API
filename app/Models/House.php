<?php

namespace App\Models;

use App\Models\Picture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'picture_favoris',
    ];

    public function pictures()
    {
        return $this->morphMany(Picture::class, 'pictureable');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function land()
    {
        return $this->belongsTo(Land::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_start_rent' => 'datetime',
        'date_end_rent' => 'datetime',
    ];
}
