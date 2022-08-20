<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'picture_url',
        'favori',
    ]; 
    
    /**
     * Get the parent picturable model (land or pictureland or house or picturehouse or other).
     */
    public function picturable()
    {
        return $this->morphTo();
    }
}

