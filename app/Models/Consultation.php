<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_time', 'end_time', 'price', 'transfer_proof', 'is_eligible', 'user_id', 'ota_id', 'transfer_proof'
    ];

    public function ota()
    {
        return $this->belongsTo(User::class, 'ota_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
