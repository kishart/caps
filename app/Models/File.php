<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // If you want to define the inverse relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
