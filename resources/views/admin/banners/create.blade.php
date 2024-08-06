@extends('admin.layout.main')

@section('content')
    <h1>Thêm banner mới</h1>
    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">Image</label>
            <input type="file" class="form-control" id="url" name="url" required>
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Active</label>
            <input type="checkbox" id="is_active" name="is_active" value="1" checked>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection
