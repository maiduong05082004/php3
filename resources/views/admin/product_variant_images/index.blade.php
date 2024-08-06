@extends('admin.layout.main')

@section('content')
    <h1>Images for Product Variant {{ $variant->product->name }}</h1>
    <a class="text-white" href="{{ route('admin.products.product_variants.product_variant_images.create', ['productId' => $variant->product_id, 'variantId' => $variant->id]) }}">
        <button type="button" class="btn btn-primary waves-effect waves-light my-3">
            Thêm ảnh mới
        </button>
    </a>
    <table class="table table-success table-striped align-middle table-nowrap mb-0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
                <tr>
                    <th scope="row">{{ $image->id }}</th>
                    <td><img src="{{ asset('storage/' . $image->url) }}" alt="Image" width="140" height="100"></td>
                    <td>
                        <div class="hstack gap-3 flex-wrap">
                            <form action="{{ route('admin.products.product_variants.product_variant_images.destroy', ['productId' => $variant->product_id, 'variantId' => $variant->id, 'imageId' => $image->id]) }}" method="POST" style="display: inline-block;">
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
