@extends('admin.layout.main')

@section('content')
    <a class="btn btn-primary my-3" href="{{ route('admin.banners.create') }}">Thêm banner mới</a>
    <table class="table table-success table-striped align-middle table-normal mb-0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Image</th>
                <th scope="col">Active</th>
                <th scope="col" style="width:100px">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <th scope="row">{{ $banner->id }}</th>
                    <td>{{ $banner->title }}</td>
                    <td>{{ $banner->description ?? 'Không có mô tả'}}</td>
                    <td>
                        <img src="{{ Storage::url($banner->url) }}" style="width: 100px; height: 100px;">
                    </td>
                    <td>{{ $banner->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <div class="hstack gap-3 flex-wrap">
                            <a href="{{ route('admin.banners.edit', $banner->id) }}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link link-danger fs-15 p-0 m-0" onclick="return confirm('Are you sure?')">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
