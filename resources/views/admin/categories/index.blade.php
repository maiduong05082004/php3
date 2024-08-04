@extends('admin.layout.main')
@section('content')
    <a class="text-white" href="{{ route('admin.categories.create') }}">
        <button type="button" class="btn btn-primary waves-effect waves-light my-3">Thêm danh mục mới
        </button>
    </a>
    <a class="text-white" href="{{ route('admin.categories.trash') }}">
        <button type="button" class="btn btn-danger waves-effect waves-light my-3 float-end">
            Xem thùng rác
        </button>
    </a>
    <table class="table table-success table-striped align-middle table-nowrap mb-0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">trạng thái</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->status == 1 ? 'Active' : 'In active' }}</td>
                    <td>
                        <div class="hstack gap-3 flex-wrap">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="link-success fs-15"><i
                                    class="ri-edit-2-line"></i></a>
                            <form action="{{ route('admin.categories.soft_destroy', $category->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-link link-danger fs-15 p-0 m-0"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div class="mt-4">
        {{ $categories->links() }}
    </div> --}}
@endsection
