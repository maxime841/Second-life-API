<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'owner',
        'presentation',
        'description',
        'group',
        'prims',
        'remaining_prims',
        'date_buy',
        'picture',
    ]; 
    
    public function pictures()
    {
        return $this->morphMany(Picture::class, 'picturable');
    }
}
  

