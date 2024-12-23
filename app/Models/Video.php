<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['destination_id', 'title', 'url', 'description', 'user_id', 'isReviewed'];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
