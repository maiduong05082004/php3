@extends('admin.layout.main')

@section('content')
    <h1>Product Variants for {{ $product->name }}</h1>
    <button type="button" class="btn btn-primary waves-effect waves-light my-3">
        <a class="text-white" href="{{ route('admin.products.product_variants.create', $product->id) }}">Thêm biến thể sản phẩm mới</a>
    </button>
    <table class="table table-success table-striped align-middle table-nowrap mb-0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Color</th>
                <th scope="col">Size</th>
                <th scope="col">Image</th>
                <th scope="col">Stock</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($variants as $variant)
                <tr>
                    <th scope="row">{{ $variant->id }}</th>
                    <td>{{ $variant->color->name }}</td>
                    <td>{{ $variant->size->name }}</td>
                    <td><img src="{{ $variant->imageLibrary ? $variant->imageLibrary->url : '' }}" alt="{{ $variant->imageLibrary ? $variant->imageLibrary->url : 'No Image' }}" width="50"></td>
                    <td>{{ $variant->stock }}</td>
                    <td>{{ $variant->price }}</td>
                    <td>
                        <div class="hstack gap-3 flex-wrap">
                            <a href="{{ route('admin.products.product_variants.edit', ['productId' => $product->id, 'id' => $variant->id]) }}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                            <form action="{{ route('admin.products.product_variants.destroy', ['productId' => $product->id, 'id' => $variant->id]) }}" method="POST" style="display: inline-block;">
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
