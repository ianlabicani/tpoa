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
        'events',
        'service_offer',
        'social_media',
        'service_offer',
        'share_count',
        'how_to_get_there',
        'day_images',
        'night_images',
        'latitude',
        'longitude'
    ];

  

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

  

   // Define the feedbacks relationship (1-to-many)
    // Define the feedbacks relationship
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Define the relationship with FeedbackReaction through Feedback
    public function reactions()
    {
        return $this->hasManyThrough(FeedbackReaction::class, Feedback::class);
    }


    // Define the inverse of the relationship (many-to-one)
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
