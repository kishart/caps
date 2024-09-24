<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'email', 'phone', 'date', 'time', 'details', 'feedback_requested', 'feedback_given', 'status', 'user_id', 'appointment_id', 'message'];

    // Define the relationship with Feedback
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

 

public function message()
{
    return $this->hasOne(Message::class);
}

}




