@extends('frontend.layouts.master')
@section('title', 'Lab')
@push('css')

@endpush
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="row align-items-center pb-3">
                        <div class="col-md-4 col-12 d-md-block d-none custom-short-by">
                            <h3 class="title pharmacy-title">Available Lab</h3>
                            <h4 class="title pharmacy-title ">for {{$test->name}}</h4>
                            <h6 class="doc-location mb-2 text-ellipse pharmacy-location"><i class="fa fa-credit-card mr-1"></i> TK{{$test->price}} </h6>
{{--                            <span class="price-strike">TK{{$test->regular_price}}</span>--}}
                        </div>

                    </div>

                    <div class="row">
                        @foreach($labs as $lab )
                            <div class="col-6 col-md-3 col-lg-3 col-xl-3 product-custom">
                                <div class="profile-widget">
                                    <div class="doc-img">
                                        <img class="img-fluid" alt="lab image" src="{{asset('uploads/test/'.$lab->lab->image)}}">
                                    </div>
                                    <div class="pro-content">
                                        <h3 class="title">
                                            {{$lab->lab->name}}
                                        </h3>
                                        <p class="doc-location mb-2 text-ellipse pharmacy-location"><i class="fas fa-map-marker-alt mr-1"></i> {{$lab->lab->clinic->clinicContact->address }} </p>
                                        <div class="row align-items-center">
                                            <div class="col-lg-7">
                                                <span class="price">TK{{$lab->lab_test_price}}</span>
                                                <span class="price-strike">TK{{$lab->lab_test_regular_price}}</span>
                                            </div>
                                            <div class="col-lg-5 text-right">
                                                <button data-toggle="modal" data-target="#modal_{{$lab->id}}" class="cart-icon " ><i class="fas fa-shopping-cart"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal_{{$lab->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">How you want to collect test?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input delivery_{{$lab->id}}" type="radio" name="delivery_{{$lab->id}}" id="exampleRadios1" value="from_lab" checked>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            I will collect it from lab
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input delivery_{{$lab->id}}" type="radio" name="delivery_{{$lab->id}}" id="exampleRadios2" value="from_home">
                                                        <label class="form-check-label" for="exampleRadios2">
                                                            Deliver test to my home
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{--                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                                                    <button type="button" class="btn btn-secondary addToCart" id="{{$lab->id}}" data-dismiss="modal" aria-label="Close">Add To Cart</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @stop
        @push('js')
            <script>
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                    } else {
                        x.innerHTML = "Geolocation is not supported by this browser.";
                    }

                function showPosition(position) {
                    // x.innerHTML = "Latitude: " + position.coords.latitude +
                    //     "<br>Longitude: " + position.coords.longitude;
                    console.log(position.coords.latitude);
                }

                $(".addToCart").click(function (e) {
                    var nam='delivery_'+this.id;
                    var del = $("."+nam+":checked").val();
                    console.log(del);
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('test.cart.add')}}",
                        method: "post",
                        data:{
                            lab_test:this.id,
                            delivery:del
                        },
                        success: function(data){
                            //console.log(data.response['countCart'])
                            toastr.success('Lab Test added in your cart <span style="font-size: 25px;">&#10084;&#65039;</span>');
                            //$('#number-cart').html('<div>'+data.response['countCart']+'</div>');
                            $('#number-cart').html(data.response['countCart']);
                            // $('.addToCart').prop("disabled",true);
                        }
                    });
                })
            </script>
    @endpush
