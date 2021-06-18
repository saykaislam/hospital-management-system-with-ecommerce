@extends('frontend-shop.layouts.master')
@section('title','Best Sale Products')
@push('css')
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/css/style.css')}}">


    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/font-awesome/css/fontawesome-all.min.css')}}">
{{--    <link rel="stylesheet" href="../../assets/css/font-electro.css">--}}

    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/animate.css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/hs-megamenu/src/hs.megamenu.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/ion-rangeslider/css/ion.rangeSlider.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/fancybox/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/slick-carousel/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">

    <style>
        .shop_div {
            background-color: #f1f1f1;
            padding: 20px;
        }
    </style>
@endpush
@section('content')
    <!-- ========== MAIN CONTENT ========== -->
    @php
        $shop = shopInfo($slug);
        $user_id = $shop->user_id;
        $seller = sellerInfo($user_id);
        $user = shopSellerInfo($user_id);
    @endphp
    <main id="content" role="main">
        <!-- breadcrumb -->
        <!-- End breadcrumb -->

        <div class="container">
            <div class="row mb-8">

                <!-- Header Start -->
            {{--            @include('frontend-shop.pages.seller.includes.product_list_sidebar')--}}
            <!--Header End-->

                <div class="col-xl-12 col-wd-9gdot5">
                    <div id="content" class="site-content" tabindex="-1">
                        <div class="container">

                            <nav class="woocommerce-breadcrumb" ><a href="{{route('shop')}}">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>Best sale Product</nav>

                            <div id="primary" class="content-area">
                                <main id="main" class="site-main">
                                    <header class="page-header text-center" style="margin-top: -50px;">
                                        <h2 class="page-title">Best Sale Products</h2>
                                        {{--                                        <p class="woocommerce-result-count">Showing 1&ndash;15 of 20 results</p>--}}
                                    </header>

                                    {{--                                    <div class="shop-control-bar">--}}
                                    {{--                                        <ul class="shop-view-switcher nav nav-tabs" role="tablist">--}}
                                    {{--                                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" title="Grid View" href="#grid"><i class="fa fa-th"></i></a></li>--}}
                                    {{--                                            <li class="nav-item"><a class="nav-link " data-toggle="tab" title="Grid Extended View" href="#grid-extended"><i class="fa fa-align-justify"></i></a></li>--}}
                                    {{--                                            <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View" href="#list-view"><i class="fa fa-list"></i></a></li>--}}
                                    {{--                                            <li class="nav-item"><a class="nav-link " data-toggle="tab" title="List View Small" href="#list-view-small"><i class="fa fa-th-list"></i></a></li>--}}
                                    {{--                                        </ul>--}}
                                    {{--                                        <form class="woocommerce-ordering" method="get">--}}
                                    {{--                                            <select name="orderby" class="orderby">--}}
                                    {{--                                                <option value="menu_order"  selected='selected'>Default sorting</option>--}}
                                    {{--                                                <option value="popularity" >Sort by popularity</option>--}}
                                    {{--                                                <option value="rating" >Sort by average rating</option>--}}
                                    {{--                                                <option value="date" >Sort by newness</option>--}}
                                    {{--                                                <option value="price" >Sort by price: low to high</option>--}}
                                    {{--                                                <option value="price-desc" >Sort by price: high to low</option>--}}
                                    {{--                                            </select>--}}
                                    {{--                                        </form>--}}
                                    {{--                                        <form class="form-electro-wc-ppp"><select name="ppp" onchange="this.form.submit()" class="electro-wc-wppp-select c-select"><option value="15"  selected='selected'>Show 15</option><option value="-1" >Show All</option></select></form>--}}
                                    {{--                                        <nav class="electro-advanced-pagination">--}}
                                    {{--                                            <form method="post" class="form-adv-pagination"><input id="goto-page" size="2" min="1" max="2" step="1" type="number" class="form-control" value="1" /></form> of 2<a class="next page-numbers" href="#">&rarr;</a>         <script>--}}
                                    {{--                                                jQuery(document).ready(function($){--}}
                                    {{--                                                    $( '.form-adv-pagination' ).on( 'submit', function() {--}}
                                    {{--                                                        var link        = '#',--}}
                                    {{--                                                            goto_page   = $( '#goto-page' ).val(),--}}
                                    {{--                                                            new_link    = link.replace( '%#%', goto_page );--}}

                                    {{--                                                        window.location.href = new_link;--}}
                                    {{--                                                        return false;--}}
                                    {{--                                                    });--}}
                                    {{--                                                });--}}
                                    {{--                                            </script>--}}
                                    {{--                                        </nav>--}}
                                    {{--                                    </div>--}}

                                    <div class="tab-content">

                                        <div role="tabpanel" class="tab-pane active" id="grid" aria-expanded="true">

                                            <ul class="products columns-3 found_product">
                                                @php
                                                    $best_sales_products = bestSalesProducts($shop->user_id)
                                                @endphp
                                                @foreach($best_sales_products as $best_sales_product)
                                                    <li class="product">
                                                        <div class="product-outer">
                                                            <div class="product-inner">
                                                                <span class="loop-product-categories"><a href="" rel="tag">{{$best_sales_product->category->name}}</a></span>
                                                                <a href="{{route('product-details',$best_sales_product->slug)}}">
                                                                    <h3>{{$best_sales_product->name}}</h3>
                                                                    <div class="product-thumbnail">
                                                                        <img href="{{route('product-details',$best_sales_product->slug)}}" src="{{url($best_sales_product->thumbnail_img)}}" alt="">
                                                                    </div>
                                                                </a>

                                                                <div class="price-add-to-cart">
                                                                    @php
                                                                        $productPrice = productPrice($best_sales_product->id);
                                                                    @endphp
                                                                    <span class="price">
                                                            <span class="electro-price">
                                                                <ins><span class="amount"> ৳{{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}</span></ins>
                                                                @if($productPrice['discount_price'])
                                                                    <del><span class="amount">৳{{$productPrice['unit_price']}}</span></del>
                                                                @endif
                                                            </span>
                                                        </span>
                                                                    <a rel="nofollow" href="{{route('product-details',$best_sales_product->slug)}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                                                                </div><!-- /.price-add-to-cart -->

                                                                <div class="hover-area">
                                                                    <div class="action-buttons">
                                                                        <a href="{{route('add.wishlist',$best_sales_product->id)}}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                                                        {{--                                                                        <a href="#" class="add-to-compare-link">Compare</a>--}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.product-inner -->
                                                        </div><!-- /.product-outer -->
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-md-12 text-center" id="loader" style="display: none; margin-left: 400px; padding-bottom: 20px;">
                                            <img src="{{asset('frontend-shop/assets/img/loader/loding3.gif')}}" class="img-fluid " width="10%">
                                        </div>
                                    </div>
{{--                                    <div class="shop-control-bar-bottom">--}}
{{--                                        <form class="form-electro-wc-ppp">--}}
{{--                                            <select class="electro-wc-wppp-select c-select" onchange="this.form.submit()" name="ppp"><option selected="selected" value="15">Show 15</option><option value="-1">Show All</option></select>--}}
{{--                                        </form>--}}
{{--                                        <p class="woocommerce-result-count">Showing 1&ndash;15 of 20 results</p>--}}
{{--                                        <nav class="woocommerce-pagination">--}}
{{--                                            <ul class="page-numbers">--}}
{{--                                                <li><span class="page-numbers current">1</span></li>--}}
{{--                                                <li><a href="#" class="page-numbers">2</a></li>--}}
{{--                                                <li><a href="#" class="next page-numbers">→</a></li>--}}
{{--                                            </ul>--}}
{{--                                        </nav>--}}
{{--                                    </div>--}}

                                </main><!-- #main -->
                            </div><!-- #primary -->

                            @include('frontend-shop.pages.seller.includes.product_list_sidebar')

                        </div><!-- .container -->
                    </div><!-- #content -->

                </div>
            </div>

        </div>
    </main>
    <!-- ========== END MAIN CONTENT ========== -->
@endsection
@push('js')
    <script>
        function categoryFilter(category_id){
            // alert(category_id);
            $('.found_product').empty();
            $("#loader").show()
            $.get("{{url('/best-sale/category/products/')}}/"+category_id,
                function(data){

                    console.log(data)
                    $("#loader").hide()
                    $('.found_product').html(data);

                });
        }
        function brandFilter(brand_id){
            // alert(category_id);
            $('.found_product').empty();
            $("#loader").show()
            $.get("{{url('/best-sale/brand/products/')}}/"+brand_id,
                function(data){

                    console.log(data)
                    $("#loader").hide()
                    $('.found_product').html(data);

                });
        }

    </script>

    <!-- JS Global Compulsory -->
    <script src="{{asset('frontend-shop/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/bootstrap/bootstrap.min.js')}}"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{asset('frontend-shop/assets/vendor/appear.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/svg-injector/dist/svg-injector.min.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/typed.js/lib/typed.min.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/slick-carousel/slick/slick.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/appear.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

    <!-- JS Electro -->
    <script src="{{asset('frontend-shop/assets/js/hs.core.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.countdown.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.header.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.hamburgers.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.unfold.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.focus-state.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.malihu-scrollbar.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.validation.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.fancybox.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.onscroll-animation.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.slick-carousel.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.quantity-counter.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.range-slider.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.show-animation.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.svg-injector.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.scroll-nav.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.go-to.js')}}"></script>
    <script src="{{asset('frontend-shop/assets/js/components/hs.selectpicker.js')}}"></script>

    <!-- JS Plugins Init. -->
    <script>
        $(window).on('load', function () {
            // initialization of HSMegaMenu component
            $('.js-mega-menu').HSMegaMenu({
                event: 'hover',
                direction: 'horizontal',
                pageContainer: $('.container'),
                breakpoint: 767.98,
                hideTimeOut: 0
            });
        });

        $(document).on('ready', function () {
            // initialization of header
            $.HSCore.components.HSHeader.init($('#header'));

            // initialization of animation
            $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                afterOpen: function () {
                    $(this).find('input[type="search"]').focus();
                }
            });

            // initialization of HSScrollNav component
            $.HSCore.components.HSScrollNav.init($('.js-scroll-nav'), {
                duration: 700
            });

            // initialization of quantity counter
            $.HSCore.components.HSQantityCounter.init('.js-quantity');

            // initialization of popups
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of countdowns
            var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
                yearsElSelector: '.js-cd-years',
                monthsElSelector: '.js-cd-months',
                daysElSelector: '.js-cd-days',
                hoursElSelector: '.js-cd-hours',
                minutesElSelector: '.js-cd-minutes',
                secondsElSelector: '.js-cd-seconds'
            });

            // initialization of malihu scrollbar
            $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

            // initialization of forms
            $.HSCore.components.HSFocusState.init();

            // initialization of form validation
            $.HSCore.components.HSValidation.init('.js-validate', {
                rules: {
                    confirmPassword: {
                        equalTo: '#signupPassword'
                    }
                }
            });

            // initialization of forms
            $.HSCore.components.HSRangeSlider.init('.js-range-slider');

            // initialization of show animations
            $.HSCore.components.HSShowAnimation.init('.js-animation-link');

            // initialization of fancybox
            $.HSCore.components.HSFancyBox.init('.js-fancybox');

            // initialization of slick carousel
            $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

            // initialization of go to
            $.HSCore.components.HSGoTo.init('.js-go-to');

            // initialization of hamburgers
            $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
                beforeClose: function () {
                    $('#hamburgerTrigger').removeClass('is-active');
                },
                afterClose: function() {
                    $('#headerSidebarList .collapse.show').collapse('hide');
                }
            });

            $('#headerSidebarList [data-toggle="collapse"]').on('click', function (e) {
                e.preventDefault();

                var target = $(this).data('target');

                if($(this).attr('aria-expanded') === "true") {
                    $(target).collapse('hide');
                } else {
                    $(target).collapse('show');
                }
            });

            // initialization of unfold component
            $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

            // initialization of select picker
            $.HSCore.components.HSSelectPicker.init('.js-select');
        });
    </script>

    <script>


        var timeout = 0;
        $(".js-range-slider").ionRangeSlider({
            onStart: function (data) {

                // Called right after range slider instance initialised

                // console.log(data.input);        // jQuery-link to input
                // console.log(data.slider);       // jQuery-link to range sliders container
                // console.log(data.min);          // MIN value
                // console.log(data.max);          // MAX values
                // console.log(data.from);         // FROM value
                // console.log(data.from_percent); // FROM value in percent
                // console.log(data.from_value);   // FROM index in values array (if used)
                // console.log(data.to);           // TO value
                // console.log(data.to_percent);   // TO value in percent
                // console.log(data.to_value);     // TO index in values array (if used)
                // console.log(data.min_pretty);   // MIN prettified (if used)
                // console.log(data.max_pretty);   // MAX prettified (if used)
                // console.log(data.from_pretty);  // FROM prettified (if used)
                // console.log(data.to_pretty);    // TO prettified (if used)

                $('#rangeSliderExample3MinResult').html(data.from);
                $('#rangeSliderExample3MaxResult').html(data.to);

                var values = [
                    data.from,data.to
                ]
                console.log(values);

                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    $('.filterdata').empty();
                    $("#loader").show()
                    $.get("{{url('/best-selling/product/filter/')}}/"+values+'/shopId/'+{{$shop->id}},
                        function(data){

                            console.log(data)
                            $("#loader").hide()
                            $('.found_product').html(data);

                        });
                }, 1000);
            },

            onChange: function (data) {
                // Called every time handle position is changed

                // console.log(data.from);
            },

            onFinish: function (data) {
                // Called then action is done and mouse is released

                // console.log(data.to);

                $('#rangeSliderExample3MinResult').html(data.from);
                $('#rangeSliderExample3MaxResult').html(data.to);
                console.log(data.from);
                console.log(data.to);

                var values = [
                    data.from,data.to
                ]
                console.log(values);

                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    $('.filterdata').empty();
                    $("#loader").show()
                    $.get("{{url('/best-selling/product/filter/')}}/"+values+'/shopId/'+{{$shop->id}},
                        function(data){

                            console.log(data)
                            $("#loader").hide()
                            $('.found_product').html(data);

                        });
                }, 1000);
            },

            onUpdate: function (data) {
                // Called then slider is changed using Update public method

                // console.log(data.from_percent);
            }
        });

    </script>
@endpush
