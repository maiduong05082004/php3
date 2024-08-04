@extends('admin.layout.main')
@section('title', 'Thùng Rác Danh Mục')

@section('content')
    <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}">Quay lại Danh Mục</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Trạng Thái</th>
            <th>Hành Động</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->status ? 'Active' : 'Inactive' }}</td>
                <td>
                    <form action="{{ route('admin.categories.restore', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Khôi Phục</button>
                    </form>
                    <form action="{{ route('admin.categories.forceDelete', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn danh mục này?')">Xóa Vĩnh Viễn</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
