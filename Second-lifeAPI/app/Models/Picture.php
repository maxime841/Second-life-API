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
     * Get the parent affichable model (land or pictureland or house or picturehouse or other).
     */
    public function affichable()
    {
        return $this->morphTo();
    }
}
 
class Land extends Model
{
    /**
     * Get all of the post's comments.
     */
    public function affiche()
    {
        return $this->morphMany(Picture::class, 'affichable');
    }
}
 
class Pictureland extends Model
{
    /**
     * Get all of the video's comments.
     */
    public function affiche()
    {
        return $this->morphMany(Picture::class, 'affichable');
    }
}

class House extends Model
{
    /**
     * Get all of the video's comments.
     */
    public function affiche()
    {
        return $this->morphMany(Picture::class, 'affichable');
    }
}

class Picturehouse extends Model
{
    /**
     * Get all of the video's comments.
     */
    public function affiche()
    {
        return $this->morphMany(Picture::class, 'affichable');
    }
}

class Dj extends Model
{
    /**
     * Get all of the video's comments.
     */
    public function affiche()
    {
        return $this->morphMany(Picture::class, 'affichable');
    }
}

class Picturedj extends Model
{
    /**
     * Get all of the video's comments.
     */
    public function affiche()
    {
        return $this->morphMany(Picture::class, 'affichable');
    }
}

class Dancer extends Model
{
    /**
     * Get all of the video's comments.
     */
    public function affiche()
    {
        return $this->morphMany(Picture::class, 'affichable');
    }
}

class Picturedancer extends Model
{
    /**
     * Get all of the video's comments.
     */
    public function affiche()
    {
        return $this->morphMany(Picture::class, 'affichable');
    }
}

class Party extends Model
{
    /**
     * Get all of the video's comments.
     */
    public function affiche()
    {
        return $this->morphMany(Picture::class, 'affichable');
    }
}

class Club extends Model
{
    /**
     * Get all of the video's comments.
     */
    public function affiche()
    {
        return $this->morphMany(Picture::class, 'affichable');
    }
}
