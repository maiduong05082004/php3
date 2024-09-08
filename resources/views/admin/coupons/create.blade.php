@extends('admin.layout.main')

@section('content')
    <h1>{{ isset($coupon) ? 'Chỉnh sửa khuyến mại' : 'Thêm khuyến mại mới' }}</h1>
    <form action="{{ isset($coupon) ? route('admin.coupons.update', $coupon->id) : route('admin.coupons.store') }}" method="POST">
        @csrf
        @if(isset($coupon))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $coupon->code ?? old('code') }}" required>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ $coupon->discount ?? old('discount') }}" required>
        </div>
        <div class="mb-3">
            <label for="discount_type" class="form-label">Discount Type</label>
            <select class="form-control" id="discount_type" name="discount_type" required>
                <option value="fixed" {{ (isset($coupon) && $coupon->discount_type == 'fixed') ? 'selected' : '' }}>Fixed</option>
                <option value="percent" {{ (isset($coupon) && $coupon->discount_type == 'percent') ? 'selected' : '' }}>Percent</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="valid_from" class="form-label">Valid From</label>
            <input type="date" class="form-control" id="valid_from" name="valid_from" value="{{ $coupon->valid_from ?? old('valid_from') }}">
        </div>
        <div class="mb-3">
            <label for="valid_until" class="form-label">Valid Until</label>
            <input type="date" class="form-control" id="valid_until" name="valid_until" value="{{ $coupon->valid_until ?? old('valid_until') }}">
        </div>
        <div class="mb-3">
            <label for="usage_limit" class="form-label">Usage Limit</label>
            <input type="number" class="form-control" id="usage_limit" name="usage_limit" value="{{ $coupon->usage_limit ?? old('usage_limit') }}">
        </div>
        <div class="mb-3">
            <label for="min_order_value" class="form-label">Minimum Order Value</label>
            <input type="number" class="form-control" id="min_order_value" name="min_order_value" value="{{ $coupon->min_order_value ?? old('min_order_value') }}">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="active" {{ (isset($coupon) && $coupon->status == 'active') ? 'selected' : '' }}>Active</option>
                <option value="expired" {{ (isset($coupon) && $coupon->status == 'expired') ? 'selected' : '' }}>Expired</option>
                <option value="used" {{ (isset($coupon) && $coupon->status == 'used') ? 'selected' : '' }}>Used</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection
