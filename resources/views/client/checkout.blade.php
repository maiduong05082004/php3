@extends('client.layout.main')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Checkout</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content">
        <div class="container">
            <div class="checkout-box ">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Checkout Form -->
                        <form action="{{ route('checkout.submit') }}" method="POST">
                            @csrf

                            <!-- Billing Information -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Thông tin thanh toán</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Họ và tên: <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name') }}" required>
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Số điện thoại: <span
                                                        class="text-danger">*</span></label>
                                                <input type="tel" class="form-control" id="phone" name="phone"
                                                    value="{{ old('phone') }}" required>
                                                @if ($errors->has('phone'))
                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email: <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">Tỉnh/Thành phố <span
                                                        class="text-danger">*</span></label>
                                                <select id="city-select"
                                                    class="form-control unicase-form-control selectpicker" name="city"
                                                    required>
                                                    <option value="">--Chọn tùy chọn--</option>
                                                </select>
                                                @if ($errors->has('city'))
                                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district">Quận/Huyện <span class="text-danger">*</span></label>
                                                <select id="district-select"
                                                    class="form-control unicase-form-control selectpicker" name="district"
                                                    required>
                                                    <option value="">--Chọn tùy chọn--</option>
                                                </select>
                                                @if ($errors->has('district'))
                                                    <span class="text-danger">{{ $errors->first('district') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="ward">Phường/Xã <span class="text-danger">*</span></label>
                                                <select id="ward-select"
                                                    class="form-control unicase-form-control selectpicker" name="ward"
                                                    required>
                                                    <option value="">--Chọn tùy chọn--</option>
                                                </select>
                                                @if ($errors->has('ward'))
                                                    <span class="text-danger">{{ $errors->first('ward') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Đỉa chỉ chi tiết: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ old('address') }}" required>
                                        @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div><!-- /.Billing Information -->

                            <!-- Payment Method -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Payment Method</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="payment_method">Select Payment Method</label>
                                        <select class="form-control" id="payment_method" name="payment_method" required>
                                            <option value="">Select a payment method</option>
                                            <option value="Credit card">VNPAY</option>
                                            <option value="Paypal">PayPal</option>
                                            <option value="Bank transfer">MOMO</option>
                                        </select>
                                        @if ($errors->has('payment_method'))
                                            <span class="text-danger">{{ $errors->first('payment_method') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div><!-- /.Payment Method -->

                            <!-- Order Review -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Order Now</h4>
                                </div>
                                <div class="panel-body">
                                    <p>Please review your order before submitting.</p>
                                    <!-- Add order summary here if needed -->
                                    <button type="submit" class="btn btn-primary">Place Order</button>
                                </div>
                            </div><!-- /.Order Review -->
                            <input type="hidden" name="grand_total" value="0">
                        </form><!-- /.Checkout Form -->
                    </div>

                    <div class="col-md-4">
                        <!-- checkout-progress-sidebar -->
                        <div class="checkout-progress-sidebar">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Your Cart</h4>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            @foreach ($cart as $item)
                                                <li>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="product-thumbnail mb-2">
                                                            <img src="{{ asset('storage/' . $item->product->image) }}"
                                                                alt="{{ $item->product->name }}"
                                                                style="width: 60px; height: 60px;">
                                                        </div>
                                                        <div>
                                                            <div>
                                                                <strong>{{ $item->product->name }}</strong>
                                                                <span class="quantity">x{{ $item->quantity }}</span>
                                                                <span
                                                                    class="price">{{ number_format($item->price * $item->quantity, 2) }}$</span>
                                                            </div>
                                                            <div class="product-info">
                                                                <small>{{ $item->variant->color->name ?? '' }} /
                                                                    {{ $item->variant->size->name ?? '' }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <hr>
                                        <div class="cart-sub-total d-flex justify-content-between">
                                            <span>Total amount:</span>
                                            <span class="inner-left-md">{{ number_format($totalAmount, 2) }} $</span>
                                        </div>
                                        <div class="cart-sub-total d-flex justify-content-between">
                                            <span>Shipping Fee:</span>
                                            <span class="inner-left-md" id="shipping-fee">0.00$</span>
                                        </div>
                                        <div class="cart-grand-total d-flex justify-content-between">
                                            <span>Grand Total:</span>
                                            <span class="inner-left-md"
                                                id="grand-total">{{ number_format($totalAmount, 2) }} $</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- checkout-progress-sidebar -->
                    </div>
                </div><!-- /.row -->
            </div><!-- /.checkout-box -->
        </div><!-- /.container -->
    </div><!-- /.body-content -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hàm load danh sách tỉnh/thành phố
            function loadCities() {
                $.ajax({
                    url: 'https://provinces.open-api.vn/api/p/',
                    method: 'GET',
                    success: function(data) {
                        const citySelect = $('#city-select');
                        citySelect.empty().append('<option>--Chọn tùy chọn--</option>');
                        data.forEach(city => {
                            citySelect.append(
                                `<option value="${city.code}">${city.name}</option>`);
                        });
                    }
                });
            }

            // Hàm load danh sách quận/huyện theo tỉnh/thành phố
            function loadDistricts(cityCode) {
                $.ajax({
                    url: `https://provinces.open-api.vn/api/p/${cityCode}?depth=2`,
                    method: 'GET',
                    success: function(data) {
                        const districtSelect = $('#district-select');
                        districtSelect.empty().append('<option>--Chọn tùy chọn--</option>');
                        if (data && data.districts && data.districts.length > 0) {
                            data.districts.forEach(district => {
                                districtSelect.append(
                                    `<option value="${district.code}">${district.name}</option>`
                                );
                            });
                        }
                        // Refresh lại selectpicker để hiển thị dữ liệu mới
                        districtSelect.selectpicker('refresh');
                    },
                    error: function(error) {
                        console.error('Error loading districts:', error);
                    }
                });
            }

            // Hàm load danh sách phường/xã theo quận/huyện
            function loadWards(districtCode) {
                $.ajax({
                    url: `https://provinces.open-api.vn/api/d/${districtCode}?depth=2`,
                    method: 'GET',
                    success: function(data) {
                        const wardSelect = $('#ward-select');
                        wardSelect.empty().append('<option>--Chọn tùy chọn--</option>');
                        if (data && data.wards && data.wards.length > 0) {
                            data.wards.forEach(ward => {
                                wardSelect.append(
                                    `<option value="${ward.code}">${ward.name}</option>`);
                            });
                        }
                        // Refresh lại selectpicker để hiển thị dữ liệu mới
                        wardSelect.selectpicker('refresh');
                    },
                    error: function(error) {
                        console.error('Error loading wards:', error);
                    }
                });
            }

            // Khi trang đã load, load danh sách tỉnh/thành phố
            loadCities();

            // Xử lý sự kiện chọn tỉnh/thành phố
            $('#city-select').on('change', function() {
                const cityCode = $(this).val();
                if (cityCode) {
                    loadDistricts(cityCode);
                } else {
                    $('#district-select').empty().append('<option>--Chọn tùy chọn--</option>');
                    $('#ward-select').empty().append('<option>--Chọn tùy chọn--</option>');
                    $('#district-select').selectpicker('refresh');
                    $('#ward-select').selectpicker('refresh');
                }
            });

            // Xử lý sự kiện chọn quận/huyện
            $('#district-select').on('change', function() {
                const districtCode = $(this).val();
                if (districtCode) {
                    loadWards(districtCode);
                } else {
                    $('#ward-select').empty().append('<option>--Chọn tùy chọn--</option>');
                    $('#ward-select').selectpicker('refresh');
                }
            });

            // Cập nhật phí ship và tổng tiền khi chọn địa chỉ
            $('#ward-select').on('change', function() {
                const cityName = $('#city-select option:selected').text().trim();
                const totalAmount = parseFloat('{{ $totalAmount }}');
                let shippingFee = 12; // Mặc định là $12

                if (cityName === 'Thành phố Hồ Chí Minh' || cityName === 'Thành phố Hà Nội') {
                    shippingFee = 6;
                }

                if (totalAmount > 1000) {
                    shippingFee = 0; // Miễn phí nếu tổng số tiền lớn hơn $1000
                }

                const grandTotal = totalAmount + shippingFee;

                // Cập nhật lại giao diện
                $('#shipping-fee').text(shippingFee.toFixed(2) + '$');
                $('#grand-total').text(grandTotal.toFixed(2) + '$');

                $('input[name="grand_total"]').val(grandTotal.toFixed(2)); // Cập nhật giá trị grand_total
            });
        });
        $('form').on('submit', function() {
            const grandTotal = $('input[name="grand_total"]').val();
            if (grandTotal === '0') {
                alert('Grand Total is required. Please select your address.');
                return false; // Ngăn không cho form được gửi
            }
        });
    </script>
@endsection
