@extends('backend.layouts.admin.master')
@section("title","Edit Flash Deals Products")
@push('css')
    <link rel="stylesheet" href="{{asset('backend/seller/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/seller/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/seller/plugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/seller/dist/css/spectrum.css')}}">
    <style>
        .input-group-addon {
            padding: 6px 2px;
            font-size: 20px;
            font-weight: 400;
            line-height: 1;
            color: #555;
            text-align: center;
            background-color: #eee;
            border: 1px solid #ccc;
        }
        .input-daterange .input-group-addon {
            width: auto;
            min-width: 21px;
            padding: 4px 19px;
            line-height: 1.42857143;
            border-width: 1px 0;
            margin-left: -5px;
            margin-right: -5px;
        }
    </style>
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">Edit Flash Deal</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Flash Deal</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{route('admin.flash_deals.index')}}">
                                <button class="btn btn-success">
                                    <i class="fa fa-backward"> </i>
                                    Back
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body custom-edit-service">
                            <!-- Add Medicine -->
                            <form role="form" id="choice_form" action="{{route('admin.flash_deals.shop.wise.products.update')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <section class="content">
                                    <div class="row m-2">
                                        <div class="col-md-12">
                                            <!-- general form elements -->
                                            <div class="card card-info card-outline">
                                                <p class="pl-2 pb-0 mb-0 bg-info">Edit Products For This Flash Deals</p>
                                                <div class="card-body">
                                                    <input type="hidden" name="flash_deal_id" value="{{$flashDeal->id}}">
                                                    <div class="row">
                                                        <div class="form-group mb-3 col-sm-12">
                                                            <label class="control-label" for="shop">Shop</label>
                                                            <div class="">
                                                                <select name="shop" id="shop" class="form-control demo-select2"  data-placeholder="Shop">
                                                                    <option >Please select one shop</option>
                                                                    @foreach(\App\Shop::get() as $shop)
                                                                        <option value="{{$shop->user_id}}">{{$shop->name}} ({{$shop->user->name}})</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-3 col-sm-12">
                                                            <label class="control-label" for="products">Products</label>
                                                            <select name="products[]" id="products" class="form-control demo-select2 products" multiple required data-placeholder="Choose Products">

                                                            </select>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div class="form-group" id="discount_table">

                                                    </div>
                                                    <div>
                                                        <button class="btn btn-success float-right">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </form>
                            <!-- /Add Medicine -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->

@endsection
@push('js')
    <script src="{{asset('backend/seller/dist/js/spartan-multi-image-picker-min.js')}}"></script>
    <script src="{{asset('backend/seller/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/seller/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('backend/seller/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{asset('backend/seller/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        $('#shop').on('change', function() {
            /* $('#productsDiv').find('ul').remove();
             $('#productsDiv').html(`<select name="products[]" id="products" class="form-control demo-select2 products" multiple required data-placeholder="Choose Products"></select>`)*/
            //alert( this.value );
            if(this.value > 0){
                $.get("{{url('admin/flash_deals/shop/products/edit')}}/"+this.value+'/{{$flashDeal->id}}',
                    function(data){
                        console.log(data)
                        $('#products').html(data);
                        $('.demo-select2').select2();
                        get_flash_deal_discount()
                    });
            }
            else{
                alert('else')
                //$('#discount_table').html(null);
            }


            /*$.ajax({
                url: "{{url('admin/flash_deals/shop/products')}}/"+this.value,
                type: 'GET',
                success: function(data) {
                    $('.demo-select2').select2();
                    //console.log(data.response);
                    $('#discount_table').html(null);
                    data.response.map((product) => $('.products').append(`<option value="${product.id}">${product.name}</option>`))
                    productListGet()

                }
            });*/
        });
        $('.demo-select2').select2();
        $("#demo-dp-range .input-daterange").datepicker({
            startDate: "-0d",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
        });
        $(document).ready(function(){

        });
        $('#products').on('change', function(){
            get_flash_deal_discount();
        });


        function get_flash_deal_discount(){
            var product_ids = $('#products').val();
            if(product_ids.length > 0){
                $.post('{{ route('admin.flash_deals.product_discount_edit') }}', {_token:'{{ csrf_token() }}', product_ids:product_ids, flash_deal_id:{{ $flashDeal->id }}}, function(data){
                    $('#discount_table').html(data);
                    $('.demo-select2').select2();
                });
            }
            else{
                $('#discount_table').html(null);
            }
        }



    </script>
@endpush
