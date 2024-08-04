@extends('admin.layout.main')

@section('content')
    <a class="text-white" href="{{ route('admin.products.create') }}">
        <button type="button" class="btn btn-primary waves-effect waves-light my-3">
            Thêm sản phẩm mới
        </button>
    </a>
    <table class="table table-success table-striped align-middle table-normal mb-0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col" style="width:150px">Danh mục</th>
                <th scope="col">Giá</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Mô tả</th>
                <th scope="col" style="width:150px">Biến thể</th>
                <th scope="col" style="width:100px">Hoạt động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'Không có danh mục' }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        @if (!isset($product->image))
                            Không có hình ảnh
                        @else
                            <img src="{{ Storage::url($product->image) }}" style="width:250px; height:250px;">
                        @endif
                    </td>
                    <td>{{ $product->description }}</td>
                    <td><a href="{{ route('admin.products.product_variants.index', $product->id) }}">Quản lý biến thể</a>
                    </td>
                    <td>
                        <div class="hstack gap-3 flex-wrap">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="link-success fs-15"><i
                                    class="ri-edit-2-line"></i></a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
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
@endsection
