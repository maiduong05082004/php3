@extends('client.layout.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="order-success">
                    <h1 class="text-center">Cảm ơn bạn đã đặt hàng!</h1>
                    <p class="text-center">Đơn hàng của bạn đã được đặt thành công.</p>
                    <hr>
                    <h2>Thông tin đơn hàng</h2>
                    <div class="order-details">
                        <p><strong>Mã đơn hàng:</strong> {{ $order->order_code }}</p>
                        <p><strong>Tên:</strong> {{ $order->name }}</p>
                        <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->address }}, {{ $order->ward }}, {{ $order->district }}, {{ $order->city }}</p>
                        <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method }}</p>
                        <p><strong>Tổng số tiền:</strong> {{ number_format($order->total_amount, 2) }} $ <span>(Phí vận chuyển: {{$feeShip}} $)</span></p>
                    </div>
                    <hr>
                    <h2>Chi tiết sản phẩm</h2>
                    <ul class="list-unstyled">
                        @foreach ($order->items as $item)
                            <li>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-thumbnail mb-2">
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" style="width: 60px; height: 60px;">
                                    </div>
                                    <div>
                                        <div>
                                            <strong>{{ $item->product->name }}</strong>
                                            <span class="quantity">x{{ $item->quantity }}</span>
                                            <span class="price">{{ number_format($item->price * $item->quantity, 2) }} $</span>
                                        </div>
                                        <div class="product-info">
                                            <small>{{ $item->variant->color->name ?? '' }} / {{ $item->variant->size->name ?? '' }}</small>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <hr>
                    <p class="text-center">Chúng tôi sẽ gửi email xác nhận đến bạn trong thời gian sớm nhất.</p>
                    <p class="text-center"><a href="/" class="btn btn-primary">Quay lại trang chủ</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection