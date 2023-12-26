<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'category_id', 'photo', 'city', 'address',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function cheaperRoom()
    {
        return $this->hasOne(Room::class, 'accomodation_id')->orderBy('price', 'asc')->oldest()->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function rating(){
        return $this->hasMany(Rating::class, 'accomodation_id');
    }
}
