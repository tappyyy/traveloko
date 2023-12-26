<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;
    protected $fillable = [
        'accomodation_id',
        'ota_id',
        'comment',
    ];

    public function ota()
    {
        return $this->belongsTo('App\Models\User', 'ota_id');
    }

    public function accomodation()
    {
        return $this->belongsTo('App\Models\Accomodation', 'accomodation_id');
    }
}
