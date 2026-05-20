<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{   
    use HasFactory;

    protected $fillable = [
        'bio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function avatar()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
