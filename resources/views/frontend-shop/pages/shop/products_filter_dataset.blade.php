@forelse($products as $product)
    <li class="product">
        <div class="product-outer">
            <div class="product-inner">
                <span class="loop-product-categories"><a href="" rel="tag">{{$product->category->name}}</a></span>
                <a href="{{route('product-details',$product->slug)}}">
                    <h3>{{$product->name}}</h3>
                    <div class="product-thumbnail">
                        <img href="{{route('product-details',$product->slug)}}" src="{{url($product->thumbnail_img)}}" alt="">
                    </div>
                </a>

                <div class="price-add-to-cart">
                    @php
                        $productPrice = productPrice($product->id);
                    @endphp
                    <span class="price">
                        <span class="electro-price">
                            <ins><span class="amount"> ৳{{$productPrice['discount_price'] ? $productPrice['discount_price'] : $productPrice['unit_price']}}</span></ins>
                            @if($productPrice['discount_price'])
                                <del><span class="amount">৳{{$productPrice['unit_price']}}</span></del>
                            @endif
                        </span>
                    </span>
                    <a rel="nofollow" href="{{route('product-details',$product->slug)}}" class="btn-add-cart btn-primary transition-3d-hover"><i class="ec ec-add-to-cart"></i></a>
                </div><!-- /.price-add-to-cart -->

                <div class="hover-area">
                    <div class="action-buttons">
                        <a href="{{route('add.wishlist',$product->id)}}" class="text-gray-6 font-size-13"><i class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                        {{--                                                                        <a href="#" class="add-to-compare-link">Compare</a>--}}
                    </div>
                </div>
            </div>
            <!-- /.product-inner -->
        </div><!-- /.product-outer -->
    </li>
@empty
    <div class="col-md-12 text-center" >
        <h2 class="p-0 m-0">Data Not found!!</h2>
        <img src="{{asset('frontend/img/loader/nodata.png')}}"  class="img-fluid p-0 m-0" width="50%">
    </div>
@endforelse
