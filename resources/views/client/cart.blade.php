@extends('client.layout.main')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Shopping Cart</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row ">
                <div class="shopping-cart">
                    <!-- Form cập nhật số lượng -->
                    <form action="{{ route('cart.update') }}" method="POST" id="cart-update-form">
                        @csrf
                        <div class="shopping-cart-table ">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-romove item">Remove</th>
                                            <th class="cart-description item">Image</th>
                                            <th class="cart-product-name item">Product Name</th>
                                            <th class="cart-qty item">Quantity</th>
                                            <th class="cart-sub-total item">Price</th>
                                            <th class="cart-total last-item">Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <div class="shopping-cart-btn">
                                                    <span class="">
                                                        <a href="/"
                                                            class="btn btn-upper btn-primary outer-left-xs">Continue
                                                            Shopping</a>
                                                        <button type="submit"
                                                            class="btn btn-upper btn-primary pull-right outer-right-xs">Update
                                                            shopping cart</button>
                                                    </span>
                                                </div><!-- /.shopping-cart-btn -->
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($cart as $item)
                                            <tr data-id="{{ $item->id }}" id="cart-item-{{ $item->id }}">
                                                <td class="romove-item">
                                                    <button type="button" class="btn-remove" title="cancel"
                                                        onclick="removeCartItem({{ $item->id }})"><i
                                                            class="fa fa-trash-o"></i></button>
                                                </td>
                                                <td class="cart-image">
                                                    <a class="entry-thumbnail" href="#">
                                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                                            alt="{{ $item->product->name }}">
                                                    </a>
                                                </td>
                                                <td class="cart-product-name-info">
                                                    <h4 class='cart-product-description'><a
                                                            href="#">{{ $item->product->name }}</a></h4>
                                                    <div class="cart-product-info">
                                                        <span class="product-color">COLOR: <span
                                                                style="font-size: 1.2em;">{{ $item->variant->color->name }}</span></span><br>
                                                        <span class="product-size">SIZE: <span
                                                                style="font-size: 1.2em;">{{ $item->variant->size->name }}</span></span>
                                                    </div>
                                                </td>
                                                <td class="cart-product-quantity">
                                                    <div class="quant-input">
                                                        <div class="arrows">
                                                            <div class="arrow plus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-asc"></i></span></div>
                                                            <div class="arrow minus gradient"><span class="ir"><i
                                                                        class="icon fa fa-sort-desc"></i></span></div>
                                                        </div>
                                                        <input type="text" name="quantities[{{ $item->id }}]"
                                                            value="{{ $item['quantity'] }}" class="quantity-input">
                                                    </div>
                                                </td>
                                                <td class="cart-product-sub-total"><span
                                                        class="cart-sub-total-price">{{ $item->price }}$</span></td>
                                                <td class="cart-product-grand-total"><span
                                                        class="cart-grand-total-price">{{ $item->price * $item->quantity }}$</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-4 col-sm-12 estimate-ship-tax">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Ước tính phí vận chuyển và thuế</span>
                                        <p>Nhập điểm đến của bạn để nhận phí vận chuyển và thuế.</p>
                                    </th>
                                </tr>
                            </thead><!-- /thead -->
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="info-title control-label">Tỉnh/Thành phố <span>*</span></label>
                                            <select id="city-select" class="form-control unicase-form-control selectpicker">
                                                <option>--Chọn tùy chọn--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title control-label">Quận/Huyện <span>*</span></label>
                                            <select id="district-select"
                                                class="form-control unicase-form-control selectpicker">
                                                <option>--Chọn tùy chọn--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title control-label">Phường/Xã <span>*</span></label>
                                            <select id="ward-select" class="form-control unicase-form-control selectpicker">
                                                <option>--Chọn tùy chọn--</option>
                                            </select>
                                        </div>
                                        <div class="pull-right">
                                            <button type="button" id="calculate-shipping" class="btn-upper btn btn-primary">NHẬN BÁO GIÁ</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- /.estimate-ship-tax -->

                    <div class="col-md-4 col-sm-12 estimate-ship-tax">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Discount Code</span>
                                        <p>Enter your coupon code if you have one..</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                placeholder="You Coupon..">
                                        </div>
                                        <div class="clearfix pull-right">
                                            <button type="button" id="apply-coupon" class="btn-upper btn btn-primary">APPLY COUPON</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div><!-- /.estimate-ship-tax -->

                    <!-- Tính toán tổng tiền, phí giao dịch, và Grand Total -->
                    <div class="col-md-4 col-sm-12 cart-shopping-total">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="cart-sub-total">
                                            Total amount<span class="inner-left-md"
                                                id="total-amount">{{ number_format($totalAmount, 2) }}$</span>
                                        </div>
                                        <div class="cart-sub-total">
                                            Fee<span class="inner-left-md"
                                                id="fee">{{ number_format($fee, 2) }}$</span>
                                        </div>
                                        <div class="cart-grand-total">
                                            Grand Total<span class="inner-left-md"
                                                id="grand-total">{{ number_format($grandTotal, 2) }}$</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead><!-- /thead -->
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            <a href="/checkout">
                                                <button type="button" class="btn btn-primary checkout-btn">PROCEED TO
                                                    CHECKOUT
                                                </button>
                                            </a>
                                            <span class="">Checkout with multiple addresses!</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div><!-- /.cart-shopping-total -->
                </div><!-- /.shopping-cart -->
            </div> <!-- /.row -->
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

            // Tính toán phí vận chuyển khi nhấn nút "NHẬN BÁO GIÁ"
            $('#calculate-shipping').on('click', function(event) {
                event.preventDefault(); // Ngăn chặn gửi form để xử lý logic tính phí

                let cityName = $('#city-select option:selected').text().trim();
                let totalAmount = parseFloat($('#total-amount').text().replace('$', ''));
                let fee = 12; // Mặc định là $12

                if (cityName === 'Thành phố Hồ Chí Minh' || cityName === 'Thành phố Hà Nội') {
                    fee = 6;
                }

                if (totalAmount > 1000) {
                    fee = 0; // Miễn phí nếu tổng số tiền lớn hơn $1000
                }

                // Cập nhật lại giao diện
                $('#fee').text(fee.toFixed(2) + '$');
                $('#grand-total').text((totalAmount + fee).toFixed(2) + '$');
            });

            // Xử lý sự kiện nhấn vào nút tăng/giảm số lượng
            document.querySelectorAll('.quant-input .arrow').forEach(function(arrow) {
                arrow.addEventListener('click', function() {
                    const input = this.closest('.quant-input').querySelector('.quantity-input');
                    let quantity = parseInt(input.value);
                    if (this.classList.contains('plus')) {
                        quantity++;
                    } else if (this.classList.contains('minus') && quantity > 1) {
                        quantity--;
                    }
                    input.value = quantity;

                    // Cập nhật Grandtotal
                    const row = this.closest('tr');
                    const price = parseFloat(row.querySelector('.cart-sub-total-price').textContent.replace('$', ''));
                    const grandTotalElement = row.querySelector('.cart-grand-total-price');
                    grandTotalElement.textContent = `$${(price * quantity).toFixed(2)}`;
                });
            });

            // Xử lý sự kiện thay đổi trực tiếp số lượng
            document.querySelectorAll('.quantity-input').forEach(function(input) {
                input.addEventListener('change', function() {
                    let quantity = parseInt(this.value);
                    if (isNaN(quantity) || quantity < 1) {
                        quantity = 1;
                        this.value = quantity;
                    }

                    // Cập nhật Grandtotal
                    const row = this.closest('tr');
                    const price = parseFloat(row.querySelector('.cart-sub-total-price').textContent.replace('$', ''));
                    const grandTotalElement = row.querySelector('.cart-grand-total-price');
                    grandTotalElement.textContent = `$${(price * quantity).toFixed(2)}`;
                });
            });

            // Xử lý sự kiện xóa sản phẩm
            window.removeCartItem = function(cartId) {
                if (confirm('Are you sure you want to remove this item?')) {
                    fetch(`/cart/remove/${cartId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`cart-item-${cartId}`).remove();
                            updateCartTotals();
                        } else {
                            alert('Failed to remove item.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to remove item.');
                    });
                }
            };

            // Hàm cập nhật lại tổng tiền, phí và Grand Total
            function updateCartTotals() {
                let totalAmount = 0;
                document.querySelectorAll('.cart-grand-total-price').forEach(function(element) {
                    totalAmount += parseFloat(element.textContent.replace('$', ''));
                });

                let fee = totalAmount > 1000 ? 0 : 12;
                let grandTotal = totalAmount + fee;

                document.getElementById('total-amount').textContent = totalAmount.toFixed(2) + '$';
                document.getElementById('fee').textContent = fee.toFixed(2) + '$';
                document.getElementById('grand-total').textContent = grandTotal.toFixed(2) + '$';
            }

            // Xử lý sự kiện nhấn vào nút "Update shopping cart"
            document.querySelector('form#cart-update-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Ngăn chặn gửi form để xử lý logic cập nhật

                // Cập nhật lại Grandtotal cho từng sản phẩm
                document.querySelectorAll('.quantity-input').forEach(function(input) {
                    const row = input.closest('tr');
                    const price = parseFloat(row.querySelector('.cart-sub-total-price').textContent.replace('$', ''));
                    const grandTotalElement = row.querySelector('.cart-grand-total-price');
                    const quantity = parseInt(input.value);
                    grandTotalElement.textContent = `$${(price * quantity).toFixed(2)}`;
                });

                // Cập nhật lại tổng tiền, phí và Grand Total
                updateCartTotals();

                // Gửi form sau khi đã cập nhật
                this.submit();
            });
        });
    </script>
@endsection