<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    /**
     * Get the user .
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * the attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'libelle',
    ];
}
