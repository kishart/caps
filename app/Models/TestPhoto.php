<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestPhoto extends Model
{
    use HasFactory;

    protected $table = 'testphotos';  // Specify the table name

    protected $fillable = ['user_id', 'photo_paths'];

    // Cast the photo_paths column to an array
    protected $casts = [
        'photo_paths' => 'array',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class); // 'Photo' is the model for the photos
    }

    
}
