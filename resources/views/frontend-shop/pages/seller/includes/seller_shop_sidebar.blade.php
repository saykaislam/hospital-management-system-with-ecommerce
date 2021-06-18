<div class="d-none d-xl-block col-xl-3 col-wd-2gdot5">
    <div class="mb-8 border border-width-2 border-color-3 borders-radius-6 shop_div">
        @if($shop->logo)
        <img class="img-fluid" src="{{url($shop->logo)}}" alt="Image Brand">
        @else
        <img class="img-fluid" src="{{asset('frontend-shop/assets/img/190X150/img1.png')}}" alt="Image Brand">
        @endif

        <div class="mb-2">
            <a href="{{route('shop.details',$shop->slug)}}" class="">
                <h3>{{$shop->name}}</h3>
            </a>
            <div>

            </div>
        </div>

        <div class="mb-4 row">
            <div class="col-md-6 mb-2 mb-md-0">
                @php
                $shop_rating = shopRating($shop->id);
                $round_shop_rating = round($shop_rating);
                @endphp
                <h5>Rating: <strong>{{$shop_rating}}</strong> </h5>
                {!! shopRatingStar($round_shop_rating) !!}
            </div>
            @php
            $favorite_shop = \App\FavoriteShop::where('user_id',Auth::id())->where('shop_id',$shop->id)->first();
            @endphp
            @if(empty($favorite_shop))
            <div class="col-md-6">
                <button class="btn" style="background-color: #EE3F94"><a href="{{route('add.favorite-shop',$shop->id)}}">Follow</a></button>
            </div>
            @else
                <div class="col-md-6">
                    <button class="btn" style="background-color: #EE3F94"><a href="{{route('remove.favorite-shop',$shop->id)}}">Unfollow</a></button>
                </div>
            @endif
        </div>

        <div class="mb-4">
            <div class="row no-gutters">
                <div class="col-auto">
                    <i class="ec ec-support text-primary font-size-56"></i>
                </div>
                <div class="col pl-3">
                    <div class="font-size-13 font-weight-light">Got questions? Call us 24/7!</div>
                    <a href="tel:+8801404002233" class="font-size-20 text-gray-90">8801404002233 </a>
                </div>
            </div>
        </div>

        <p><strong>About: </strong>{{$shop->about}}</p>
        <hr/>
        <div class="mb-4">
                                        <h6 class="mb-1 font-weight-bold">Contact info</h6>
            <address class="">
                <strong>Address: </strong>{{$shop->address}}
            </address>
        </div>
        <div class="my-4 my-md-4">
            <address class="">
                <strong>Folow us on social: </strong>
            </address>
            <ul class="list-inline mb-0 opacity-7">
                <li class="list-inline-item mr-0">
                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{ $shop->facebook ? url($shop->facebook) : '#'}}">
                        <span class="fab fa-facebook-f btn-icon__inner"></span>
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{ $shop->google ? url($shop->google) : '#'}}">
                        <span class="fab fa-google btn-icon__inner"></span>
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{ $shop->twitter ? url($shop->twitter) : '#'}}">
                        <span class="fab fa-twitter btn-icon__inner"></span>
                    </a>
                </li>
                <li class="list-inline-item mr-0">
                    <a class="btn font-size-20 btn-icon btn-soft-dark btn-bg-transparent rounded-circle" href="{{ $shop->youtube ? url($shop->youtube) : '#'}}">
                        <span class="fab fa-youtube btn-icon__inner"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>
