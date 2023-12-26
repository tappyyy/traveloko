<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'total_payment', 'user_id', 'payment_type',
        'is_success', 'transfer_proof', 'rating',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checkout()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
