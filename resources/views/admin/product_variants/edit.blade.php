@extends('admin.layout.main')

@section('title', 'Sửa Biến Thể Sản Phẩm')

@section('content')
<form action="{{ route('admin.products.product_variants.update', ['productId' => $product->id, 'id' => $variant->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="input-group my-3">
        <label class="input-group-text" for="colors_id">Color</label>
        <select class="form-select" id="colors_id" name="colors_id" required>
            @foreach($colors as $color)
                <option value="{{ $color->id }}" {{ $variant->colors_id == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group my-3">
        <label class="input-group-text" for="sizes_id">Size</label>
        <select class="form-select" id="sizes_id" name="sizes_id" required>
            @foreach($sizes as $size)
                <option value="{{ $size->id }}" {{ $variant->sizes_id == $size->id ? 'selected' : '' }}>{{ $size->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group my-3">
        <label class="input-group-text" for="image_library_id">Image</label>
        <select class="form-select" id="image_library_id" name="image_library_id">
            <option value="">No Image</option>
            @foreach($images as $image)
                <option value="{{ $image->id }}" {{ $variant->image_library_id == $image->id ? 'selected' : '' }}>{{ $image->url }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock" value="{{ $variant->stock }}" placeholder="Nhập số lượng" required>
    </div>
    <div>
        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ $variant->price }}" placeholder="Nhập giá" required>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endsection
