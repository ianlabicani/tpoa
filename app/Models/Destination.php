<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    /** @use HasFactory<\Database\Factories\DestinationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'contact',
        'email',
        'entrance_fee',
        'availability',
        'social_media',
        'share_count',
    ];

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
