<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount',
        'discount_type',
        'valid_from',
        'valid_until',
        'status',
        'usage_limit',
        'used_count',
        'min_order_value',
    ];

    // Các trường ngày tháng nên được tự động chuyển đổi thành các đối tượng Carbon
    protected $dates = [
        'valid_from',
        'valid_until',
    ];

    // Tạo các accessor hoặc mutator nếu cần
    public function getIsValidAttribute()
    {
        return $this->status === 'active' && 
               ($this->valid_from ? $this->valid_from->isPast() : true) &&
               ($this->valid_until ? $this->valid_until->isFuture() : true) &&
               ($this->usage_limit ? $this->used_count < $this->usage_limit : true);
    }

}
