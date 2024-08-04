<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageLibrary extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
    ];
    public function productVariants()
    {
        return $this->belongsToMany(ProductVariant::class, 'product_variant_image_library');
    }
}
