@extends('admin.layout.main')

@section('content')
    <h1>Chỉnh sửa khuyến mại</h1>
    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ $coupon->code }}" required>
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="number" class="form-control" id="discount" name="discount" value="{{ $coupon->discount }}" required>
        </div>
        <div class="mb-3">
            <label for="valid_from" class="form-label">Valid From</label>
            <input type="date" class="form-control" id="valid_from" name="valid_from" value="{{ $coupon->valid_from }}">
        </div>
        <div class="mb-3">
            <label for="valid_until" class="form-label">Valid Until</label>
            <input type="date" class="form-control" id="valid_until" name="valid_until" value="{{ $coupon->valid_until }}">
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection
