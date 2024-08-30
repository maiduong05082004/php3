@extends('admin.layout.main')
@section('title', 'Edit Category')
@section('content')
<h2>Sửa danh mục: {{ $Categories->name }}</h2>
<form action="{{ route('admin.categories.update',['id'=> $Categories->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="name" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" value="{{ $Categories->name }}" required>
    </div>
    <div class="input-group  my-3">
        <label class="input-group-text" for="status">Trạng thái</label>
        <select class="form-select" id="inputGroupSelect01" name="status" required>
            <option value="1" {{ $Categories->status ? 'selected' : '' }}>Hoạt động</option>
            <option value="0" {{ !$Categories->status ? 'selected' : '' }}>Không hoạt động</option>
        </select>
    </div>
    @if($Categories->parent_id !== null)
            <input type="hidden" name="parent_id" value="{{ $Categories->parent_id }}">
            <div class="mb-3">
                <label class="form-label">Danh mục mẹ</label>
                <input type="text" class="form-control" value="{{ $parentCategory->name ?? 'Không có' }}" disabled>
            </div>
        @else
    <div class="input-group my-3">
        <label class="input-group-text" for="parent_id">Danh mục mẹ</label>
        <select class="form-select" id="parent_id" name="parent_id">
            <option value="">Danh mục mẹ</option>
            @foreach ($SubCategories as $sub)
                <option value="{{ $sub->id }}" {{ isset($Categories) && $Categories->parent_id == $sub->id ? 'selected' : '' }}>
                    {{ $sub->name }}
                </option>
            @endforeach
        </select>
    </div>
    @endif
    <button type="submit" class="btn btn-primary">Sửa danh mục</button>
    @if($Categories->parent_id !== null)
    <a href="{{ route('admin.categories.subcategories', $Categories->parent_id) }}" class="btn btn-primary">Quay lại</a>
@else
    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Quay lại</a>
@endif
</form>

@endsection