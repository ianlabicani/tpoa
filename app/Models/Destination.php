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

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function reactions()
    {
        return $this->hasMany(FeedbackReaction::class, 'feedback_id');
    }

}
