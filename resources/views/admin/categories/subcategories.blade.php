@extends('admin.layout.main')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh mục con của {{ $category->name }}</h3>
    </div>
    <a class="text-white" href="{{ route('admin.categories.create', ['parent_id' => $category->id]) }}">
        <button type="button" class="btn btn-primary waves-effect waves-light my-3">Thêm danh mục con</button>
    </a>
    <table class="table table-success table-striped align-middle table-nowrap mb-0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Tên danh mục</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Danh mục con</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subcategories as $subcategory)
                <tr>
                    <th scope="row">{{ $subcategory->id }}</th>
                    <td>{{ $subcategory->name }}</td>
                    <td>{{ $subcategory->status == 1 ? 'Active' : 'In active' }}</td>
                    <td>
                        <a href="{{ route('admin.categories.subcategories', $subcategory->id) }}">
                            Danh mục con
                        </a>
                    </td>
                    <td>
                        <div class="hstack gap-3 flex-wrap">
                            <a href="{{ route('admin.categories.edit', $subcategory->id) }}" class="link-success fs-15"><i
                                    class="ri-edit-2-line"></i></a>
                            <form action="{{ route('admin.categories.soft_destroy', $subcategory->id) }}" method="POST"
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
    @if ($parent)
        <a href="{{ route('admin.categories.subcategories', $parent->id) }}" class="btn btn-primary mt-3">Quay lại</a>
    @else
        <a href="{{ route('admin.categories.index') }}" class="btn btn-primary mt-3">Quay lại</a>
    @endif
@endsection
