@extends('admin.layout.main')

@section('content')
    <a class="btn btn-primary my-3" href="{{ route('admin.coupons.create') }}">Thêm khuyến mại mới</a>
    <table class="table table-success table-striped align-middle table-normal mb-0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Code</th>
                <th scope="col">Discount</th>
                <th scope="col">Valid From</th>
                <th scope="col">Valid Until</th>
                <th scope="col" style="width:100px">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($coupons as $coupon)
                <tr>
                    <th scope="row">{{ $coupon->id }}</th>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->discount }}</td>
                    <td>{{ $coupon->valid_from }}</td>
                    <td>{{ $coupon->valid_until }}</td>
                    <td>
                        <div class="hstack gap-3 flex-wrap">
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" style="display: inline-block;">
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
