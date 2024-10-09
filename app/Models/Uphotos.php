<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uphotos extends Model
{
    use HasFactory;
    protected $fillable = ['filename','description', 'category', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
