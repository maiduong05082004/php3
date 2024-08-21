<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>DFURNITURES</title>

    @include('client.layout.style')
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">

        <!-- ============================================== TOP MENU ============================================== -->
        <div class="top-bar animate-dropdown">
            <div class="container">
                <div class="header-top-inner">
                    <div class="cnt-account">
                        <ul class="list-unstyled">
                            @auth
                                <li><a href="#"><i class="icon fa fa-user"></i> {{ Auth::user()->name }}</a></li>
                                <li><a href="/my_wishlist"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                                <li><a href="/cart"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                                <li><a href="/checkout"><i class="icon fa fa-check"></i>Checkout</a></li>
                                <li><a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="icon fa fa-lock"></i>Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li><a href="/login"><i class="icon fa fa-lock"></i>Login</a></li>
                            @endauth
                        </ul>

                    </div>
                    <!-- /.cnt-account -->


                    <!-- /.cnt-cart -->
                    <div class="clearfix"></div>
                </div>
                <!-- /.header-top-inner -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.header-top -->
        <!-- ============================================== TOP MENU : END ============================================== -->
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                        <!-- ============================================================= LOGO ============================================================= -->
                        <div class="logo"> <a href="/"> <img src="{{ asset('images\logo.png') }}"
                                    alt="logo"> </a> 
                        </div>
                        <!-- /.logo -->
                        <!-- ============================================================= LOGO : END ============================================================= -->
                    </div>
                    <!-- /.logo-holder -->

                    <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                        <!-- /.contact-row -->
                        <!-- ============================================================= SEARCH AREA ============================================================= -->
                        <div class="search-area">
                            <form>
                                <div class="d-flex control-group" style="display: flex;">
                                    <input class="search-field w-100" placeholder="Search here...">
                                    <a class="search-button" href="#"></a>
                                </div>
                            </form>
                        </div>
                        <!-- /.search-area -->
                        <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                    </div>
                    <!-- /.top-search-holder -->

                    <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                        <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                        <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart"
                                data-toggle="dropdown">
                                <div class="items-cart-inner">
                                    <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                    <div class="basket-item-count"><span class="count">2</span></div>
                                    <div class="total-price-basket"> <span class="lbl">cart -</span> <span
                                            class="total-price"> <span class="sign">$</span><span
                                                class="value">600.00</span> </span> </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="cart-item product-summary">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="image"> <a href="product_detail"><img src="images\cart.jpg"
                                                            alt=""></a> </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <h3 class="name"><a href="index.php?page-detail">Simple Product</a>
                                                </h3>
                                                <div class="price">$600.00</div>
                                            </div>
                                            <div class="col-xs-1 action"> <a href="#"><i
                                                        class="fa fa-trash"></i></a> </div>
                                        </div>
                                    </div>
                                    <!-- /.cart-item -->
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="clearfix cart-total">
                                        <div class="pull-right"> <span class="text">Sub Total :</span><span
                                                class='price'>$600.00</span> </div>
                                        <div class="clearfix"></div>
                                        <a href="/checkout"
                                            class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                                    </div>
                                    <!-- /.cart-total-->

                                </li>
                            </ul>
                            <!-- /.dropdown-menu-->
                        </div>
                        <!-- /.dropdown-cart -->

                        <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                    </div>
                    <!-- /.top-cart-row -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->

        </div>
        <!-- /.main-header -->

        <!-- ============================================== NAVBAR ============================================== -->
        <div class="header-nav animate-dropdown">
            <div class="container">
                <div class="yamm navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                            class="navbar-toggle collapsed" type="button">
                            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                                class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    </div>
                    <div class="nav-bg-class">
                        <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                            <div class="nav-outer">
                                <ul class="nav navbar-nav">
                                    <li class="active dropdown yamm-fw">
                                        <a href="/" data-hover="dropdown" class="dropdown-toggle"
                                            data-toggle="dropdown">Home</a>
                                    </li>
                                    {{-- @foreach ($categories as $category)
                                        <li class="dropdown yamm mega-menu">
                                            <a href="#" data-hover="dropdown" class="dropdown-toggle"
                                                data-toggle="dropdown">
                                                {{ $category->name }}
                                            </a>
                                            @if ($category->children->count() > 0)
                                                <!-- Kiểm tra nếu có danh mục con -->
                                                <ul class="dropdown-menu">
                                                    @foreach ($category->children as $child)
                                                        <li class="dropdown yamm mega-menu">
                                                            <a class="dropdown-toggle" href="#">{{ $child->name }}</a>
                                                            @if ($child->children->count() > 0)
                                                                <!-- Kiểm tra danh mục con của danh mục con -->
                                                                <ul class="dropdown-menu">
                                                                    @foreach ($child->children as $subChild)
                                                                        <li><a href="#">{{ $subChild->name }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach --}}
                                    {{-- <ul class="nav navbar-nav">
                                        @foreach($categories as $category)
                                            @include('client.partials.category_children', ['category' => $category])
                                        @endforeach
                                    </ul> --}}
                                    @foreach($categories as $category)
                                    <li class="dropdown yamm mega-menu">
                                        <a href="/" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $category->name }}</a>
                                        
                                        @if($category->children->count() > 0) <!-- Kiểm tra xem có danh mục con không -->
                                            <ul class="dropdown-menu container">
                                                <li>
                                                    <div class="yamm-content ">
                                                        <div class="row">
                                                            @foreach($category->children as $sub_category) <!-- Lặp qua các danh mục con -->
                                                                <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                                    <h2 class="title">{{ $sub_category->name }}</h2>
                                                                    
                                                                    @if($sub_category->children->count() > 0) <!-- Kiểm tra xem có danh mục con của danh mục con không -->
                                                                        <ul class="links">
                                                                            @foreach($sub_category->children as $sub_item) <!-- Lặp qua các danh mục con của danh mục con -->
                                                                                <li><a href="#">{{ $sub_item->name }}</a></li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                                
                                    <li class="dropdown"> <a href="/blog">Blog</a> </li>
                                    <li class="dropdown"> <a href="/my_wishlist">Wishlist</a> </li>
                                    <li><a href="/terms_conditions">Terms and Condition</a></li>
                                    <li><a href="/faq">FAQ</a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-hover="dropdown"
                                            data-toggle="dropdown">Pages</a>
                                        <ul class="dropdown-menu pages">
                                            <li>
                                                <div class="yamm-content">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-menu">
                                                            <ul class="links">
                                                                <li><a href="/">Home</a></li>
                                                                <li><a href="category.html">Category</a></li>
                                                                <li><a href="product_detail">Detail</a></li>
                                                                <li><a href="shopping-cart.html">Shopping Cart
                                                                        Summary</a></li>
                                                                <li><a href="/checkout">Checkout</a></li>
                                                                <li><a href="blog.html">Blog</a></li>
                                                                <li><a href="blog-details.html">Blog Detail</a></li>
                                                                <li><a href="/category">Contact</a></li>
                                                                <li><a href="sign-in.html">Sign In</a></li>
                                                                <li><a href="my-wishlist.html">Wishlist</a></li>
                                                                <li><a href="/terms_conditions">Terms and Condition</a>
                                                                </li>
                                                                <li><a href="track-orders.html">Track Orders</a></li>
                                                                <li><a
                                                                        href="product-comparison.html">Product-Comparison</a>
                                                                </li>
                                                                <li><a href="faq.html">FAQ</a></li>
                                                                <li><a href="404.html">404</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown  navbar-right special-menu">
                                        <a href="#">Todays offer</a>
                                    </li>
                                </ul>

                                <!-- /.navbar-nav -->
                                <div class="clearfix"></div>
                            </div>
                            <!-- /.nav-outer -->
                        </div>
                        <!-- /.navbar-collapse -->

                    </div>
                    <!-- /.nav-bg-class -->
                </div>
                <!-- /.navbar-default -->
            </div>
            <!-- /.container-class -->

        </div>
        <!-- /.header-nav -->
        <!-- ============================================== NAVBAR : END ============================================== -->

    </header>

    <!-- ============================================== HEADER : END ============================================== -->
    @yield('content')
    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="module-heading">
                            <h4 class="module-title">Contact Us</h4>
                        </div>
                        <!-- /.module-heading -->

                        <div class="module-body">
                            <ul class="toggle-footer" style="">
                                <li class="media">
                                    <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i
                                                class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span> </div>
                                    <div class="media-body">
                                        <p>Ngõ 5 Văn Tiến Dũng, Bắc Từ Liêm, Hà Nội</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i
                                                class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                                    <div class="media-body">
                                        <p>+(888) 123-4567<br>
                                            +(888) 456-7890</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i
                                                class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                                    <div class="media-body"> <span><a
                                                href="#">flipmart@themesground.com</a></span> </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.module-body -->
                    </div>
                    <!-- /.col -->

                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="module-heading">
                            <h4 class="module-title">Customer Service</h4>
                        </div>
                        <!-- /.module-heading -->

                        <div class="module-body">
                            <ul class='list-unstyled'>
                                <li class="first"><a href="#" title="Contact us">My Account</a></li>
                                <li><a href="#" title="About us">Order History</a></li>
                                <li><a href="#" title="faq">FAQ</a></li>
                                <li><a href="#" title="Popular Searches">Specials</a></li>
                                <li class="last"><a href="#" title="Where is my order?">Help Center</a></li>
                            </ul>
                        </div>
                        <!-- /.module-body -->
                    </div>
                    <!-- /.col -->

                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="module-heading">
                            <h4 class="module-title">Corporation</h4>
                        </div>
                        <!-- /.module-heading -->

                        <div class="module-body">
                            <ul class='list-unstyled'>
                                <li class="first"><a title="Your Account" href="#">About us</a></li>
                                <li><a title="Information" href="#">Customer Service</a></li>
                                <li><a title="Addresses" href="#">Company</a></li>
                                <li><a title="Addresses" href="#">Investor Relations</a></li>
                                <li class="last"><a title="Orders History" href="#">Advanced Search</a></li>
                            </ul>
                        </div>
                        <!-- /.module-body -->
                    </div>
                    <!-- /.col -->

                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="module-heading">
                            <h4 class="module-title">Why Choose Us</h4>
                        </div>
                        <!-- /.module-heading -->

                        <div class="module-body">
                            <ul class='list-unstyled'>
                                <li class="first"><a href="#" title="About us">Shopping Guide</a></li>
                                <li><a href="#" title="Blog">Blog</a></li>
                                <li><a href="#" title="Company">Company</a></li>
                                <li><a href="#" title="Investor Relations">Investor Relations</a></li>
                                <li class=" last"><a href="contact-us.html" title="Suppliers">Contact Us</a></li>
                            </ul>
                        </div>
                        <!-- /.module-body -->
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-bar">
            <div class="container">
                <div class="col-xs-12 col-sm-6 no-padding social">
                    <ul class="link">
                        <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#"
                                title="Facebook"></a></li>
                        <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#"
                                title="Twitter"></a></li>
                        <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#"
                                title="GooglePlus"></a></li>
                        <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#"
                                title="RSS"></a></li>
                        <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#"
                                title="PInterest"></a></li>
                        <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#"
                                title="Linkedin"></a></li>
                        <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#"
                                title="Youtube"></a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-6 no-padding">
                    <div class="clearfix payment-methods">
                        <ul>
                            <li><img src="images\payments\1.png" alt=""></li>
                            <li><img src="images\payments\2.png" alt=""></li>
                            <li><img src="images\payments\3.png" alt=""></li>
                            <li><img src="images\payments\4.png" alt=""></li>
                            <li><img src="images\payments\5.png" alt=""></li>
                        </ul>
                    </div>
                    <!-- /.payment-methods -->
                </div>
            </div>
        </div>
    </footer>
    @include('client.layout.script')
</body>

</html>
