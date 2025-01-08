<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //    
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'price_per_night',
        'description',
        'cover',
        'social_media',
        'services',
        'latitude',
        'longitude',
        'availability', 
    ];

    public function images()
    {
        return $this->hasMany(HotelImage::class);
    }


}
