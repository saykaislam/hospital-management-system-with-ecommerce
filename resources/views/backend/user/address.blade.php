@extends('backend.layouts.user.master')
@section('title', 'Profile')
@push('css')
    {{--custom css--}}
    <!-- barikoi -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin="" />
    <!-- barikoi -->
@endpush
@section('content')



    <!-- Basic Information -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Address</h4>
                <div class="row form-row">
                    @if(!empty($addresses))
                        @foreach($addresses as $address)
                            <div class="col-md-6 col-12" style="padding-bottom: 15px;">
                                <div class="card">
                                    <div class="text-right dropdown">
                                        <button class="btn bg-black" type="button" id="dropdownMenuButton" data-toggle="dropdown" style="background: #f1f1f1;">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="font-size: 14px;">
                                            @if($address->set_default == 0)
                                                <form action="{{route('user.update.status',$address->id)}}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-lg"> <a class="dropdown-item">Make Default</a></button>
                                                </form>
                                            @endif
                                            <form action="{{route('user.address.destroy',$address->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-lg"><a class="dropdown-item"> Delete </a></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-text">Address: <strong>{{$address->address}}</strong></div>
                                        <div class="card-text">Postal Code: <strong>{{$address->postal_code}}</strong></div>
                                        <div class="card-text">City: <strong>{{$address->city}}</strong></div>
                                        <div class="card-text">Country: <strong>{{$address->country}}</strong></div>
                                        <div class="card-text">Phone: <strong>{{$address->phone}}</strong></div>
                                        <div class="card-text">Type: <strong>{{$address->type}}</strong>
                                            @if($address->set_default == 1)
                                                <a href="#" class="btn btn-primary" style="margin-left: 180px;">Default</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-6 col-12" style="padding-bottom: 15px;">
                            <div class="card" style="width: 40rem; height: 12rem;">
                                <div class="card-body">
                                    <h3 class="text-center">
                                        <a data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-plus"></i></a>
                                        <p>Add new Address</p>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6 col-12">
                            <div class="card" style="width: 40rem; height: 12rem;">
                                <div class="card-body">
                                    <h3 class="text-center">
                                        <a data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-plus"></i></a>
                                        <p>Add new Address</p>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- /Basic Information -->
{{--        <div class="submit-section submit-btn-bottom">--}}
{{--            <button type="submit" class="btn btn-primary submit-btn">Save Changes</button>--}}
{{--        </div>--}}

    <!-- /Page Content -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Your Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form class="ps-form--account-setting" id="bk_address" action="{{route('user.address.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="ps-form__content" >
                            <div class="form-group" style="margin-bottom: 0;">
                                <label for="bksearch" class="">Address</label>
{{--                                <input type="text" onkeyup="getAddress()" name="address" class="form-control form-control-sm address" autocomplete="off">--}}
{{--                                <input type="text" onkeyup="getAddress()" class="form-control {{ $errors->has('bksearch') ? ' is-invalid' : '' }} address" value="" placeholder="Enter Your Shop Address" name="bksearch" required>--}}
                                <input type="text" onkeyup="getAddress()" name="address" class="form-control form-control-sm address" autocomplete="off">
                            </div>
                        </div>
                        <ul class="list-group addList" style="padding: 0;">

                        </ul>
{{--                        <div class="bklist"></div>--}}
                        <div class="form-group">
                            <input type="hidden" name="address">
                            <input type="hidden" name="city">
                            <input type="hidden" name="area">
                            <input type="hidden" name="latitude">
                            <input type="hidden" name="longitude">
                        </div>
                        <div class="form-group ">
                            <label for="country" class="">Country</label>
                            <input type="text" class="form-control form-control-sm" name="country" placeholder="Bangladesh" readonly>
                        </div>

                        <div class="form-group">
                            <label for="postal_code" class="">Postal Code</label>
                            <input type="text" class="form-control form-control-sm" name="postal_code" placeholder="Your Postal Code" readonly>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="">Phone</label>
                            <input type="text" class="form-control form-control-sm" name="phone" placeholder="Your phone">
                        </div>
                        <div class="form-group ">
                            <label for="phone" class="">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="Home">Home</option>
                                <option value="Office">Office</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group submit text-center">
                        <button class="ps-btn">Save</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@stop
@push('js')
    <!-- Select2 JS -->
    <script src="{{asset('backend/user/select2/js/select2.min.js')}}"></script>

    <!-- Dropzone JS -->
    <script src="{{asset('backend/user/dropzone/dropzone.min.js')}}"></script>

    <!-- Bootstrap Tagsinput JS -->
    <script src="{{asset('backend/user/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>

    <!-- Profile Settings JS -->
    <script src="{{asset('backend/user/js/profile-settings.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.js?key:MTg3NzpCRE5DQ01JSkgw"></script>

    <script>

        function getAddress() {

            let places=[];
            let location=null;
            let add=$('.address').val();
            $('.addList').empty();
            fetch("https://barikoi.xyz/v1/api/search/autocomplete/MTg5ODpJUTVHV0RWVFZP/place?q="+add)
                .then(response => response.json())
                .catch(error => console.error('Error:', error))
                .then(response => {
                    response.places.forEach(result)
                })
        }
        function result(item, index){
            var $li = $("<li class='list-group-item'><a href='#' class='list-group-item bg-light'>" + item.address + "</a></li>");
            $(".addList").append($li);
            $li.on('click', getPlacesDetails.bind(this, item));
        }
        function getPlacesDetails(mapData)
        {
            $(".addList").empty();
            $( "input[name='address']" ).val(mapData.address)
            $( "input[name='city']" ).val(mapData.city)
            $( "input[name='area']" ).val(mapData.area)
            $( "input[name='latitude']" ).val(mapData.latitude)
            $( "input[name='longitude']" ).val(mapData.longitude)
            $( "input[name='postal_code']" ).val(mapData.postCode)
            //console.log(mapData)
        }
    </script>
@endpush
