<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default
    protected $table = 'payments';

    // Define fillable fields to protect against mass assignment
    protected $fillable = [
        'user_id',
        'payment_method',
        'gcash_image',
        'payment_details',
        'amount',
        'payment_status',
        'transaction_id',
        'proof_image',
        'payment_date',
        'payment_time',
    ];

    // Define relationships if necessary
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
