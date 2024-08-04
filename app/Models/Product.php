<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'category_id',
        'status'
    ];

    // Định nghĩa quan hệ belongsTo với Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Định nghĩa quan hệ hasMany với ProductVariant
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
