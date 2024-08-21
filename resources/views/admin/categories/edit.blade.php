@extends('admin.layout.main')
@section('title', 'Edit Category')
@section('content')
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
    
    <button type="submit" class="btn btn-primary">Sửa danh mục</button>
</form>
@endsection