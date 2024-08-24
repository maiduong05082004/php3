@extends('client.layout.main')
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>{{ $categories->where('id', request()->route('id'))->first()->name ?? 'Category' }}
                    </li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.breadcrumb -->
    <div class="body-content outer-top-xs">
        <div class='container'>
            <!-- /.sidebar -->
            <div class="clearfix filters-container m-t-10">
                <div class="row">
                    <div class="col col-sm-6 col-md-2">
                        <div class="filter-tabs">
                            <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                            class="icon fa fa-th-large"></i>Grid</a> </li>
                                <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.filter-tabs -->
                    </div>
                    <!-- /.col -->
                    <div class="col col-sm-12 col-md-6">
                        <div class="col col-sm-3 col-md-6 no-padding">
                            <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                <div class="fld inline">
                                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                        <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                            Position <span class="caret"></span> </button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li role="presentation"><a href="#">position</a></li>
                                            <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                            <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                            <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.fld -->
                            </div>
                            <!-- /.lbl-cnt -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-3 col-md-6 no-padding">
                            <div class="lbl-cnt"> <span class="lbl">Show</span>
                                <div class="fld inline">
                                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                        <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1
                                            <span class="caret"></span> </button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li role="presentation"><a href="#">1</a></li>
                                            <li role="presentation"><a href="#">2</a></li>
                                            <li role="presentation"><a href="#">3</a></li>
                                            <li role="presentation"><a href="#">4</a></li>
                                            <li role="presentation"><a href="#">5</a></li>
                                            <li role="presentation"><a href="#">6</a></li>
                                            <li role="presentation"><a href="#">7</a></li>
                                            <li role="presentation"><a href="#">8</a></li>
                                            <li role="presentation"><a href="#">9</a></li>
                                            <li role="presentation"><a href="#">10</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.fld -->
                            </div>
                            <!-- /.lbl-cnt -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.col -->
                    <div class="col col-sm-6 col-md-4 text-right">
                        <div class="pagination-container">
                            <ul class="list-inline list-unstyled">
                              {{-- Nút Previous --}}
                              @if ($products->onFirstPage())
                                  <li class="prev disabled"><span><i class="fa fa-angle-left"></i></span></li>
                              @else
                                  <li class="prev"><a href="{{ $products->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
                              @endif
          
                              {{-- Hiển thị các số trang --}}
                              @for ($i = 1; $i <= $products->lastPage(); $i++)
                                  @if ($i == $products->currentPage())
                                      <li class="active"><span>{{ $i }}</span></li>
                                  @else
                                      <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                  @endif
                              @endfor
          
                              {{-- Nút Next --}}
                              @if ($products->hasMorePages())
                                  <li class="next"><a href="{{ $products->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
                              @else
                                  <li class="next disabled"><span><i class="fa fa-angle-right"></i></span></li>
                              @endif
                          </ul>
                            <!-- /.list-inline -->
                        </div>
                        <!-- /.pagination-container -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <div class="search-result-container ">
                <div id="myTabContent" class="tab-content category-list">
                    <div class="tab-pane active " id="grid-container">
                        <div class="category-product">
                          @foreach ($products->chunk(3) as $chunk)
                            <div class="row">
                                @foreach ($chunk as $product)
                                    <!-- Lặp qua các sản phẩm -->
                                    <div class="col-md-4 wow fadeInUp">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image"> <a href="{{ route('product_detail', $product->id) }}"><img
                                                                src="{{ asset('storage/' . $product->image) }}"
                                                                alt="" width="346px" height="259px"></a>
                                                    </div>
                                                    <!-- /.image -->
                                                </div>
                                                <!-- /.product-image -->
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="{{ route('product_detail', $product->id) }}">{{ $product->name }}</a></h3>
                                                    <div class="product-price"> <span class="price">
                                                            {{ $product->price }} </span> <span
                                                            class="price-before-discount">{{ $product->price_before_discount }}</span>
                                                    </div>
                                                </div>
                                                <!-- /.product-info -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix filters-container">
                <div class="text-right">
                    <div class="pagination-container">
                      <ul class="list-inline list-unstyled">
                        {{-- Nút Previous --}}
                        @if ($products->onFirstPage())
                            <li class="prev disabled"><span><i class="fa fa-angle-left"></i></span></li>
                        @else
                            <li class="prev"><a href="{{ $products->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a></li>
                        @endif
    
                        {{-- Hiển thị các số trang --}}
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            @if ($i == $products->currentPage())
                                <li class="active"><span>{{ $i }}</span></li>
                            @else
                                <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endfor
    
                        {{-- Nút Next --}}
                        @if ($products->hasMorePages())
                            <li class="next"><a href="{{ $products->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a></li>
                        @else
                            <li class="next disabled"><span><i class="fa fa-angle-right"></i></span></li>
                        @endif
                    </ul>
                        <!-- /.list-inline -->
                    </div>
                    <!-- /.pagination-container -->
                </div>
                <!-- /.text-right -->

            </div>
            <!-- /.filters-container -->

        </div>
        <!-- /.search-result-container -->

        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- ============================================== BRANDS CAROUSEL ============================================== -->
    <div id="brands-carousel" class="logo-slider wow fadeInUp">
        <div class="logo-slider-inner">
            <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
                <div class="item m-t-15"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand1.png" src="images\blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item m-t-10"> <a href="#" class="image"> <img
                            data-echo="assets/images/brands/brand2.png" src="images\blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand3.png"
                            src="images\blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png"
                            src="images\blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png"
                            src="images\blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand6.png"
                            src="images\blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand2.png"
                            src="images\blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand4.png"
                            src="images\blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand1.png"
                            src="images\blank.gif" alt="">
                    </a> </div>
                <!--/.item-->

                <div class="item"> <a href="#" class="image"> <img data-echo="assets/images/brands/brand5.png"
                            src="images\blank.gif" alt="">
                    </a> </div>
                <!--/.item-->
            </div>
            <!-- /.owl-carousel #logo-slider -->
        </div>
        <!-- /.logo-slider-inner -->

    </div>
    <!-- /.logo-slider -->
    <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->

    </div>
    <!-- /.body-content -->
@endsection
