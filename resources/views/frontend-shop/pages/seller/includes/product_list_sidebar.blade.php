@push('css')

@endpush

<div id="sidebar" class="sidebar" role="complementary">
    <aside class="widget woocommerce widget_product_categories electro_widget_product_categories">
        <ul class="product-categories category-single">
            <li class="product_cat">
                <ul class="show-all-cat">

                    <li class="product_cat"><span class="show-all-cat-dropdown"><strong>Show All Categories</strong></span>
                        <ul>
                            @php
                                $shopCats = shopCategory($shop->id)
                            @endphp
                            @foreach($shopCats as $shopCat)
                            <li class="cat-item"><a href="#" onclick="categoryFilter('{{$shopCat->id}}')">{{$shopCat->category->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>

                </ul>
{{--                <ul>--}}
{{--                    <li class="cat-item current-cat"><a href="product-category.html">Laptops &amp; Computers</a> <span class="count">(13)</span>--}}
{{--                        <ul class='children'>--}}
{{--                            <li class="cat-item"><a href="product-category.html">Laptops</a> <span class="count">(6)</span></li>--}}
{{--                            <li class="cat-item"><a href="product-category.html">Ultrabooks</a> <span class="count">(1)</span></li>--}}
{{--                            <li class="cat-item"><a href="product-category.html">Computers</a> <span class="count">(0)</span></li>--}}
{{--                            <li class="cat-item"><a href="product-category.html">Mac Computers</a> <span class="count">(1)</span></li>--}}
{{--                            <li class="cat-item"><a href="product-category.html">All in One</a> <span class="count">(1)</span></li>--}}
{{--                            <li class="cat-item"><a href="product-category.html">Servers</a> <span class="count">(1)</span></li>--}}
{{--                            <li class="cat-item"><a href="product-category.html">Peripherals</a> <span class="count">(1)</span></li>--}}
{{--                            <li class="cat-item"><a href="product-category.html">Gaming</a> <span class="count">(1)</span></li>--}}
{{--                            <li class="cat-item"><a href="product-category.html">Accessories</a> <span class="count">(2)</span></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                </ul>--}}
            </li>

        </ul>
    </aside>
    <aside class="widget widget_electro_products_filter">
        <h3 class="widget-title">Filters</h3>
        <aside class="widget woocommerce widget_layered_nav">
            <h3 class="widget-title">Brands</h3>
            @php
            $shopBrands = \App\ShopBrand::where('shop_id',$shop->id)->latest()->get();
            @endphp
            <ul>
                @foreach($shopBrands as $shopBrand)
                <li style=""><a href="#" onclick="brandFilter('{{$shopBrand->id}}')">{{$shopBrand->brand->name}}</a></li>
                @endforeach
            </ul>
        </aside>

        <aside class="widget woocommerce widget_price_filter">
{{--            <h3 class="widget-title">Price</h3>--}}
{{--            <form action="#">--}}
{{--                <div class="price_slider_wrapper">--}}
{{--                    <div style="" class="price_slider ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">--}}
{{--                        <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>--}}
{{--                        <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;"></span>--}}
{{--                        <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></span>--}}
{{--                    </div>--}}
{{--                    <div class="price_slider_amount">--}}
{{--                        <a href="#" class="button">Filter</a>--}}
{{--                        <div style="" class="price_label">Price: <span class="from">$428</span> &mdash; <span class="to">$3485</span></div>--}}
{{--                        <div class="clear"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
            <div class="range-slider">
                <h4 class="font-size-14 mb-3 font-weight-bold">Price</h4>
                <!-- Range Slider -->
                <input class="js-range-slider" type="text"
                       data-extra-classes="u-range-slider u-range-slider-indicator u-range-slider-grid"
                       data-type="double"
                       data-grid="false"
                       data-hide-from-to="true"
                       data-prefix="৳"
                       data-min="0"
                       data-max="10000"
                       data-from="0"
                       data-to="10000"
                       data-result-min="#rangeSliderExample3MinResult"
                       data-result-max="#rangeSliderExample3MaxResult">
                <!-- End Range Slider -->
                <div class="mt-1 text-gray-111 d-flex mb-4">
                    <span class="mr-0dot5">Price: </span>
                    <span>৳</span>
                    <span id="rangeSliderExample3MinResult" class=""></span>
                    <span class="mx-0dot5"> — </span>
                    <span>৳</span>
                    <span id="rangeSliderExample3MaxResult" class=""></span>
                </div>
{{--                <button type="submit" class="btn px-4 btn-primary-dark-w py-2 rounded-lg">Filter</button>--}}
            </div>
        </aside>
    </aside>
{{--    <aside class="widget widget_text">--}}
{{--        <div class="textwidget">--}}
{{--            <a href="#"><img src="assets/images/banner/ad-banner-sidebar.jpg" alt="Banner"></a>--}}
{{--        </div>--}}
{{--    </aside>--}}
</div>

@push('js')

@endpush

