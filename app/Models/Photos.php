<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;

    protected $table = 'photos';  // Specify the table name

    protected $fillable = ['user_id', 'description', 'photo_paths'];

    // Cast the photo_paths column to an array
    protected $casts = [
        'photo_paths' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

