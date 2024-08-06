@extends('admin.layout.main')

@section('content')
    <a class="text-white" href="{{ route('admin.users.create') }}">
        <button type="button" class="btn btn-primary waves-effect waves-light my-3">
            Thêm người dùng mới
        </button>
    </a>
    <a class="text-white" href="{{ route('admin.users.trash') }}">
        <button type="button" class="btn btn-danger waves-effect waves-light my-3 float-end">
            Xem thùng rác
        </button>
    </a>
    <table class="table table-success table-striped align-middle table-normal mb-0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Tên người dùng</th>
                <th scope="col">Email</th>
                <th scope="col">Địa chỉ</th>
                <th scope="col">Trạng thái</th>
                <th scope="col" style="width:100px">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <div class="hstack gap-3 flex-wrap">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                            <form action="{{ route('admin.users.soft_destroy', $user->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('PUT')
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
