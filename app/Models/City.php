<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'name'];

    public function getTitleAttribute()
    {
        return title_case($this->name);
    }
}
