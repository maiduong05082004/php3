@extends('admin.layout.main')

@section('content')
    <a class="btn btn-primary my-3" href="{{ route('admin.products.index') }}">Quay lại Sản Phẩm</a>
    <table class="table table-success table-striped align-middle table-normal mb-0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col" style="width:150px">Danh mục</th>
                <th scope="col">Giá</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Mô tả</th>
                <th scope="col" style="width:250px">Hành Động</th>
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
                    </td>
                    <td>
                        <form action="{{ route('admin.products.restore',$product->id ) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">Khôi Phục</button>
                        </form>
                        <form action="{{ route('admin.products.forceDelete', $product->id) }}" method="POST" style="display:inline;">
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
