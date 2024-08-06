@extends('admin.layout.main')

@section('content')
    <h1>Chỉnh sửa banner</h1>
    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $banner->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description">{{ $banner->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">Image</label>
            <input type="file" class="form-control" id="url" name="url">
            @if ($banner->url)
                <img src="{{ Storage::url($banner->url) }}" style="width: 100px; height: 100px;">
            @endif
        </div>
        <div class="mb-3">
            <label for="is_active" class="form-label">Active</label>
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ $banner->is_active ? 'checked' : '' }}>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
@endsection
