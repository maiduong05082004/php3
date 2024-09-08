<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'address',
        'city',
        'district',
        'ward',
        'payment_method',
        'total_amount',
        'order_code',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
