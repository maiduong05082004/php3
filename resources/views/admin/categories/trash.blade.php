@extends('admin.layout.main')
@section('title', 'Thùng Rác Danh Mục')

@section('content')
    <a class="btn btn-primary waves-effect waves-light my-3" href="{{ route('admin.categories.index') }}">Quay lại Danh Mục</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tên</th>
            <th scope="col">Trạng Thái</th>
            <th scope="col" scope="col" style="width:200px" >Quản lý danh mục con</th>
            <th scope="col">Hành Động</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->status ? 'Active' : 'In active' }}</td>
                <td><a href="{{ route('admin.categories.subcategories', $category->id) }}" class="">Danh mục con</a></td>
                <td>
                    <form action="{{ route('admin.categories.restore', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
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
