@extends('admin.layout.main')

@section('title', 'Thêm Biến Thể Sản Phẩm')

@section('content')
<h2>Thêm biến thể mới</h2>
<form action="{{ route('admin.products.product_variants.store', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-group my-3">
        <label class="input-group-text" for="color_id">Màu</label>
        <select class="form-select" id="color_id" name="color_id" required>
            @foreach($colors as $color)
                <option value="{{ $color->id }}">{{ $color->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group my-3">
        <label class="input-group-text" for="size_id">Kích thước</label>
        <select class="form-select" id="size_id" name="size_id" required>
            @foreach($sizes as $size)
                <option value="{{ $size->id }}">{{ $size->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group my-3">
        <label class="input-group-text" for="images">Ảnh</label>
        <input type="file" class="form-control" id="images" name="images[]" multiple>
    </div>
    <div>
        <label for="stock" class="form-label">Số lượng</label>
        <input type="number" class="form-control" id="stock" name="stock" placeholder="Nhập số lượng" required>
    </div>
    <div class="mt-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá" required>
    </div>
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <button type="submit" class="btn btn-primary mt-3">Lưu biến thể</button>
</form>
@endsection
