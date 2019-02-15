<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'city_id', 'birth_year'
    ];

    public function getAgeAttribute()
    {
        return date("Y") - $this->birth_year;
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
