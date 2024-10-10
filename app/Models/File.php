<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // Define inverse relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each file (photo) can have many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Define the relationship with Post
    public function post()
    {
        return $this->belongsTo(Post::class);  // Each file belongs to a post
    }

}