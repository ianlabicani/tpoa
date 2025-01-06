<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Define the table associated with the model (if different from the plural form of the model)
    protected $table = 'events';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'image',
    ];

    // If you want to define relationships with other models, you can do it here. For example, if each event has many feedbacks:
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);  // Assuming you have a Feedback model
    }

    // If an event is linked to a user (assuming a user can create multiple events), you can define a relationship like:
    public function user()
    {
        return $this->belongsTo(User::class);  // Assuming the Event model has a 'user_id' column
    }

   // In Event Model
public function feedback()
{
    return $this->hasMany(Feedback::class);
}

public function videos()
{
    return $this->hasMany(Video::class);
}

}
