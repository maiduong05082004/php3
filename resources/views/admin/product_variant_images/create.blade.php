@extends('admin.layout.main')

@section('title', 'Thêm Ảnh Cho Biến Thể Sản Phẩm')

@section('content')
<h2>Thêm Ảnh Cho Sản Phẩm</h2>
<form action="{{ route('admin.products.product_variants.product_variant_images.store', ['productId' => $variant->product_id, 'variantId' => $variant->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-group my-3">
        <label class="input-group-text" for="images">Ảnh</label>
        <input type="file" class="form-control" id="images" name="images[]" multiple required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Lưu ảnh</button>
</form>
@endsection
