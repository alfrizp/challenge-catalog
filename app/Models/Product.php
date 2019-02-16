<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'price', 'is_active', 'supplier_id', 'image_file'
    ];

    public function getFormatPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 2, ",", ".");
    }

    public function getStatusLabelAttribute()
    {
        if ($this->is_active) {
            return '<span class="badge badge-md badge-success">' . __('product.active') . '</span>';
        }

        return '<span class="badge badge-md badge-danger">' . __('product.in_active') . '</span>';
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_file);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
