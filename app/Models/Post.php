<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', // The category of the post
        // Add other columns that you need to store in the `posts` table
    ];

    // Each post can have many photos (or files)
    public function photos()
    {
        return $this->hasMany(File::class);  // Ensure the relationship is with the `File` model
    }

}
