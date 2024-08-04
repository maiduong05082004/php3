@extends('admin.layout.main')

@section('title', 'Thêm Sản Phẩm')

@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mt-2">
        <label for="name" class="form-label">Tên sản phẩm: </label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" required>
    </div>
    <div class="mt-2">
        <label for="price" class="form-label">Giá: </label>
        <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm" required>
    </div>
    {{-- <div class="mt-2">
        <label for="quantity" class="form-label">Số lượng: </label>
        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Nhập số lượng sản phẩm" required>
    </div> --}}
    <div class="input-group my-3">
        <label class="input-group-text" for="status">Trạng thái: </label>
        <select class="form-select" id="inputGroupSelect01" name="status" required>
            <option value="1">Hoạt động</option>
            <option value="0">Không hoạt động</option>
        </select>
    </div>
    <div class="input-group my-3">
        <label class="input-group-text" for="category_id">Danh mục: </label>
        <select class="form-select" id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mt-2">
        <label for="image" class="form-label">Ảnh sản phẩm: </label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <div class="mt-2">
        <label for="description" class="form-label">Mô tả: </label>
        <textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả sản phẩm" required></textarea>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
    <a class="btn btn-primary" href="{{ route('admin.products.index') }}">Quay lại sản phẩm</a>
    </div>
</form>
@endsection
