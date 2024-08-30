@extends('admin.layout.main')
@section('content')
<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf
    <div>
        <label for="name" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" required>
    </div>
    <div class="input-group  my-3">
        <label class="input-group-text" for="status">Trạng thái</label>
        <select class="form-select" id="inputGroupSelect01" name="status" required>
            <option value="1">Hoạt động</option>
            <option value="0">Không hoạt động</option>
        </select>
    </div>
    @if(request()->has('parent_id'))
        <input type="hidden" name="parent_id" value="{{ request('parent_id') }}">
    @else
        <div class="input-group my-3">
            <label class="input-group-text" for="parent_id">Danh mục mẹ</label>
            <select class="form-select" id="parent_id" name="parent_id">
                <option value="">Danh mục mẹ</option>
                @foreach ($categories as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
    
    <button type="submit" class="btn btn-primary">Lưu danh mục</button>
</form>
@endsection