@extends('client.layout.main')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Clothing</a></li>
                    <li class='active'>{{ $product->name }}</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row single-product'>
                <div class=''>
                    <div class="detail-block">
                        <div class="row  wow fadeInUp">
                            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                                <div class="product-item-holder size-big single-product-gallery small-gallery">
                                    <!-- /.single-product-gallery -->
                                    <div id="owl-single-product">
                                        <div class="single-product-gallery-item" id="slide1">
                                            <a data-lightbox="image-1" data-title="Gallery">
                                                <img class="img-responsive" alt="{{ $product->name }}"
                                                    src="{{ asset('storage/' . $product->image) }}">
                                            </a>
                                        </div>
                                    </div>
                                    <!-- /.end-single-product-gallery -->
                                    <!-- /.gallery-holder -->
                                    <div class="single-product-gallery-thumbs gallery-thumbs">
                                        <div id="owl-single-product-thumbnails">
                                            @foreach ($product->variants as $variant)
                                                @foreach ($variant->images as $image)
                                                    <div class="item">
                                                        <a class="horizontal-thumb" data-target="#owl-single-product"
                                                            data-slide="{{ $loop->parent->index + 1 }}"
                                                            href="#slide{{ $loop->parent->index + 1 }}"
                                                            onclick="changeMainImage('{{ asset('storage/' . $image->url) }}')">
                                                            <img class="img-responsive" width="85"
                                                                alt="{{ $product->name }}"
                                                                src="{{ asset('storage/' . $image->url) }}">
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                    <!-- /.end-gallery-holder -->
                                </div>
                            </div>
                            <div class='col-sm-6 col-md-7 product-info-block'>
                                <div class="product-info">
                                    <h1 class="name">{{ $product->name }}</h1>
                                    <div class="rating-reviews m-t-20">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="reviews">
                                                    <a href="#" class="lnk">(13 Reviews)</a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.rating-reviews -->

                                    <div class="stock-container info-container m-t-10">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="stock-box">
                                                    <span class="label">Availability: <span class="stock"></span></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="stock-box">
                                                    <span class="value">In Stock</span>
                                                    <!-- Chỗ này sẽ được cập nhật qua JavaScript -->
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.stock-container -->

                                    <div class="description-container m-t-20">
                                        {!! $product->description !!}
                                    </div><!-- /.description-container -->

                                    <div class="price-container info-container m-t-20">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="price-box">
                                                    @if ($minPrice === $maxPrice)
                                                        <span class="price">${{ $minPrice }}</span>
                                                    @else
                                                        <span class="price">${{ $minPrice }} -
                                                            ${{ $maxPrice }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="favorite-button m-t-10">
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                        title="Wishlist" href="#">
                                                        <i class="fa fa-heart"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                        title="Add to Compare" href="#">
                                                        <i class="fa fa-signal"></i>
                                                    </a>
                                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right"
                                                        title="E-mail" href="#">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div><!-- /.row -->
                                    </div><!-- /.price-container -->
                                    <div class="quantity-container info-container">
                                        <div class="row">
                                            <!-- /biến thể -->
                                            <!-- Chọn màu sắc -->
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="variant_id" id="variant_id" value="">
                                
                                                <div class="form-group">
                                                    <label>Chọn màu sắc:</label>
                                                    <div id="color-buttons" class="color-buttons">
                                                        @foreach ($product->variants->unique('color_id') as $variant)
                                                            <div class="div-btn-color">
                                                                <button type="button" class="btn btn-color p-4 m-4"
                                                                    data-color="{{ $variant->color->id }}"
                                                                    style="background-color: {{ $variant->color->code }}; border-radius: 26px; height: 40px; width: 40px; border: none; outline: none;">
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                
                                                <div class="form-group">
                                                    <label>Chọn kích thước:</label>
                                                    <div id="size-buttons">
                                                        @foreach ($product->variants->unique('size_id') as $variant)
                                                            <button type="button" class="btn btn-size"
                                                                data-size="{{ $variant->size->id }}"
                                                                data-variant="{{ $variant->id }}">
                                                                {{ $variant->size->name }}
                                                            </button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                
                                                <div class="col-sm-2">
                                                    <span class="label">Số lượng :</span>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="cart-quantity">
                                                        <div class="quant-input">
                                                            <input type="number" name="quantity" value="1" id="quantity" style=" width: 185px; ">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-primary" id="add-to-cart-btn"><i
                                                            class="fa fa-shopping-cart inner-right-vs"></i> Add to cart
                                                    </button>
                                                </div>
                                            </form>
                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->
                                </div><!-- /.product-info -->
                            </div><!-- /.col-sm-7 -->
                        </div><!-- /.row -->
                    </div>
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.body-content -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const variants = JSON.parse('@json($product->variants)');
            let selectedColorId = null;
            let selectedSizeId = null;
    
            function changeMainImage(imageUrl) {
                const mainImage = document.querySelector('.single-product-gallery-item img');
                mainImage.src = imageUrl;
            }
    
            function updateStock(stock) {
                const stockBox = document.querySelector('.stock-box .stock');
                stockBox.textContent = stock;
            }
    
            function updatePrice(price) {
                const priceBox = document.querySelector('.price-box .price');
                priceBox.textContent = price;
            }
    
            // Khi chọn màu sắc
            document.querySelectorAll('.btn-color').forEach(button => {
                button.addEventListener('click', function() {
                    selectedColorId = this.getAttribute('data-color');
    
                    // Xóa class 'active' khỏi tất cả các div-btn-color và btn-color
                    document.querySelectorAll('.div-btn-color').forEach(div => {
                        div.classList.remove('active');
                    });
                    document.querySelectorAll('.btn-color').forEach(btn => {
                        btn.classList.remove('active');
                    });
    
                    // Thêm class 'active' vào div-btn-color và btn-color hiện tại
                    this.closest('.div-btn-color').classList.add('active');
                    this.classList.add('active');
    
                    // Hiển thị kích thước phù hợp với màu sắc đã chọn
                    document.querySelectorAll('.btn-size').forEach(sizeButton => {
                        const sizeId = sizeButton.getAttribute('data-size');
                        const matchingVariant = variants.find(variant => variant.color_id == selectedColorId && variant.size_id == sizeId);
    
                        if (matchingVariant) {
                            sizeButton.style.display = 'inline-block';
                            sizeButton.setAttribute('data-price', matchingVariant.priceSale ?? matchingVariant.price);
                            sizeButton.setAttribute('data-stock', matchingVariant.stock);
                        } else {
                            sizeButton.style.display = 'none';
                        }
                    });
    
                    // Cập nhật ảnh chính và giá tương ứng với màu sắc
                    const firstVariant = variants.find(variant => variant.color_id == selectedColorId);
                    if (firstVariant) {
                        changeMainImage(`/storage/${firstVariant.images[0]?.url}`);
                        updatePrice(firstVariant.priceSale ?? firstVariant.price);
                    }
                });
            });
    
            // Khi chọn kích thước
            document.querySelectorAll('.btn-size').forEach(button => {
                button.addEventListener('click', function() {
                    selectedSizeId = this.getAttribute('data-size');
    
                    if (selectedColorId) {
                        const matchingVariant = variants.find(variant => variant.color_id == selectedColorId && variant.size_id == selectedSizeId);
    
                        if (matchingVariant) {
                            updatePrice(matchingVariant.priceSale ?? matchingVariant.price);
                            updateStock(matchingVariant.stock);
                            document.getElementById('variant_id').value = matchingVariant.id; // Cập nhật giá trị variant_id
                        }
                    }
    
                    // Xóa class 'active' khỏi tất cả các btn-size
                    document.querySelectorAll('.btn-size').forEach(btn => {
                        btn.classList.remove('active');
                    });
    
                    // Thêm class 'active' vào btn-size hiện tại
                    this.classList.add('active');
                });
            });
    
        });
        function changeMainImage(imageUrl) {
            // Tìm phần tử hình ảnh chính và thay đổi thuộc tính `src`
            const mainImage = document.querySelector('.single-product-gallery-item img');
            mainImage.src = imageUrl;
        }
        
    </script>
    
@endsection
