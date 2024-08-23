<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'feedback'];

    // Define the relationship with Appointment
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
