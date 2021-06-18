@extends('backend.layouts.admin.master')
@section('title','Product Create')
@push('css')
    <link rel="stylesheet" href="{{asset('backend/admin/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/admin/css/spectrum.css')}}">
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">Add Product</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{route('admin.products.index')}}">
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
            <!-- Add Medicine -->
            <form role="form" id="choice_form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.products.store')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="role_id" value="1">
                <fieldset>
                    <div class="row">
                        <div class="col-md-6 d-flex">

                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h4 class="card-title">Product Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Product Name <small class="text-danger">(required*)</small></label>
                                        <input type="text" id="name" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug (SEO Url) <small class="text-danger">(required* and unique)</small></label>
                                        <input type="text" id="slug" name="slug" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Category Name <small class="text-danger">(required*)</small></label>
                                        <select name="category_id" id="category_id" class="form-control demo-select2" required>
                                            <option value="">Please select one</option>
                                            @foreach($categories as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="subcategory_id">SubCategory Name <small class="text-danger">(required*)</small></label>
                                        <select name="subcategory_id" id="subcategory_id" class="form-control demo-select2" required>
                                            <option value="">Please select one</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="subsubcategory_id">Sub SubCategory Name <small class="text-danger">(required*)</small></label>
                                        <select name="subsubcategory_id" id="subsubcategory_id" class="form-control demo-select2">
                                            <option value="">Please select one</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_id">Brand Name <small class="text-danger">(required*)</small></label>
                                        <select name="brand_id" id="brand" class="form-control demo-select2" required>
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="name">Unit</label>
                                        <input type="text" class="form-control " name="unit" id="unit"
                                               placeholder="Unit (e.g. KG, Pc etc)" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h4 class="card-title">Product Image Gallery</h4>
                                </div>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="control-label ml-3">Gallery Images</label>
                                        <div class="ml-3 mr-3">
                                            <div class="row" id="photos"></div>
                                            <div class="row" id="photos_alt"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label ml-3">Thumbnail Images <small class="text-danger">(Size: 290 *
                                                300px)</small></label>
                                        <div class="ml-3 mr-3">
                                            <div class="row" id="thumbnail_img"></div>
                                            <div class="row" id="thumbnail_img_alt"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product Inventory And Variation</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="unit_price">Unit price</label>
                                                    <input type="number" min="0" value="0" step="0.01" placeholder="Unit price" name="unit_price" class="form-control" required="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="purchase_price">Purchase price</label>
                                                    <input type="number" min="0" value="0" step="0.01"
                                                           placeholder="Purchase price" name="purchase_price"
                                                           class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="current_stock">Stock</label>
                                                    <select name="current_stock" id="current_stock" class="form-control">
                                                        <option value="1" class="bg-success">Available</option>
                                                        <option value="0" class="bg-danger">Not Available</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="discount">Discount</label>
                                                    <input type="number" min="0" value="0" step="0.01" placeholder="Discount"
                                                           name="discount" class="form-control" required="">
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="discount">Discount Type</label>
                                                    <select class="form-control " name="discount_type" tabindex="-1"
                                                            aria-hidden="true">
                                                        <option value="amount">Flat</option>
                                                        <option value="percent">Percent</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-md-10">
                                                    <label for="discount">Colors</label>
                                                    <select class="form-control color-var-select" name="colors[]" id="colors"
                                                            multiple disabled>
                                                        @foreach (\App\Color::orderBy('name', 'asc')->get() as $key => $color)
                                                            <option value="{{ $color->code }}">{{ $color->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <div class="status-toggle" style="margin-top:40px;">
                                                        <input value="1" type="checkbox" id="status_2" class="check" name="colors_active">
                                                        <label for="status_2" class="checktoggle">checkbox</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="attribute">Attribute</label>
                                                    <select name="choice_attributes[]" id="choice_attributes"
                                                            class="form-control demo-select2" multiple
                                                            data-placeholder="Choose Attributes">
                                                        @foreach (\App\Attribute::all() as $key => $attribute)
                                                            <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="customer_choice_options" id="customer_choice_options">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="sku_combination" id="sku_combination">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product & SEO Descriptions</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                            <div class="form-group">
                                                <label for="description">Product Description</label>
                                                <textarea name="description" id="description"  class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="meta_description">Meta Title</label>
                                                <input type="text" class="form-control" name="meta_title" placeholder="Meta Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_description">Meta Description</label>
                                                <textarea name="meta_description" id="meta_description" rows="5"  class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="sku_combination" id="sku_combination">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group dc-btnarea text-center">
                        <input type="submit" class="btn btn-secondary" value="Save">
                    </div>
                </fieldset>
            </form>
            <!-- /Add Medicine -->
        </div>
    </div>
    <!-- /Page Wrapper -->
    <script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
    <script>
        // CKEDITOR.config.toolbar_MA=[ ['NumberedList','BulletedList'] ];
        // CKEDITOR.replace('description',
        //     {   toolbar:'MA'    });
        CKEDITOR.replace('description');
    </script>
@endsection
@push('js')
    <script src="{{asset('backend/admin/js/spartan-multi-image-picker-min.js')}}"></script>
    <script src="{{asset('backend/admin/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        function add_more_customer_choice_option(i, name) {
            $('#customer_choice_options').append('<div class="form-group row"><div class="col-lg-3 "><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + name + '" placeholder="{{ 'Choice Title' }}" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="{{'Enter choice values' }}" data-role="tagsinput" onchange="update_sku()"></div></div>');

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }
        $(document).ready(function(){
            {{--$("#category_id").change(function () {--}}
            {{--    var id = $("#category_id").val();--}}
            {{--    $.ajax({--}}
            {{--        url: "{{URL('/admin/products/ajax/')}}/"+id,--}}
            {{--        method: "get",--}}
            {{--        success: function(result){--}}
            {{--            console.log(result.response);--}}
            {{--            var option = "";--}}
            {{--            data = (result.response);--}}
            {{--            data.forEach(function (element) {--}}
            {{--                option += "<option value='"+element.id+"'>"+element.name+"</option>";--}}
            {{--            });--}}
            {{--            $("#subcategory_id").html(option);--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}

            function get_subcategories_by_category() {
                var category_id = $('#category_id').val();
                //console.log(category_id)
                $.post('{{ route('admin.products.get_subcategories_by_category') }}', {
                    _token: '{{ csrf_token() }}',
                    category_id: category_id
                }, function (data) {
                    $('#subcategory_id').html(null);
                    //console.log(data)
                    for (var i = 0; i < data.length; i++) {
                        $('#subcategory_id').append($('<option>', {
                            value: data[i].id,
                            text: data[i].name
                        }));
                        $('.demo-select2').select2();
                    }
                    get_subsubcategories_by_subcategory();
                });
            }
            function get_subsubcategories_by_subcategory() {
                var subcategory_id = $('#subcategory_id').val();
                console.log(subcategory_id)
                $.post('{{ route('admin.products.get_subsubcategories_by_subcategory') }}', {
                    _token: '{{ csrf_token() }}',
                    subcategory_id: subcategory_id
                }, function (data) {
                    //console.log(data)
                    $('#subsubcategory_id').html(null);
                    $('#subsubcategory_id').append($('<option>', {
                        value: null,
                        text: null
                    }));
                    for (var i = 0; i < data.length; i++) {
                        $('#subsubcategory_id').append($('<option>', {
                            value: data[i].id,
                            text: data[i].name
                        }));
                    }
                    $('.demo-select2').select2();
                    $('.color-var-select').select2();

                });
            }
            $('#category_id').on('change', function () {
                get_subcategories_by_category();
            });
            $('#subcategory_id').on('change', function () {
                get_subsubcategories_by_subcategory();
            });

            //title to slug make
            $("#name").keyup(function () {
                var name = $("#name").val();
                console.log(name);
                $.ajax({
                    url: "{{URL('/admin/products/slug')}}/"+name,
                    method: "get",
                    success: function(data){
                        console.log(data.response)
                        $('#slug').val(data.response);
                    }
                });
            })

            $("#photos").spartanMultiImagePicker({
                fieldName: 'photos[]',
                maxCount: 10,
                rowHeight: '200px',
                groupClassName: 'col-md-4 col-sm-4 col-xs-6',
                maxFileSize: '150000',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('Image size too big. Please upload below 150kb');
                },
                onAddRow:function(index){
                    var altData = '<input type="text" placeholder="Image Alt" name="photos_alt[]" class="form-control" required=""></div>'
                    //var index = index + 1;
                    //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                    //$('#photos_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
                },
                onRemoveRow : function(index){
                    var index = index + 1;
                    $(`#abc_${index}`).remove()
                },
            });

            $("#thumbnail_img").spartanMultiImagePicker({
                fieldName: 'thumbnail_img',
                maxCount: 1,
                rowHeight: '200px',
                groupClassName: 'col-md-4 col-sm-4 col-xs-6',
                maxFileSize: '100000',
                dropFileLabel: "Drop Here",
                onExtensionErr: function (index, file) {
                    console.log(index, file, 'extension err');
                    alert('Please only input png or jpg type file')
                },
                onSizeErr: function (index, file) {
                    console.log(index, file, 'file size too big');
                    alert('Image size too big. Please upload below 100kb');
                },
                onAddRow:function(index){
                    var altData = '<input type="text" placeholder="Thumbnails Alt" name="thumbnail_img_alt[]" class="form-control" required=""></div>'
                    //var index = index + 1;
                    //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
                    //$('#thumbnail_img_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
                },
                onRemoveRow : function(index){
                    var index = index + 1;
                    $(`#abc_${index}`).remove()
                },
            });

            $('.demo-select2').select2();

            $(".color-var-select").select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                },
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return (
                    "<span class='color-preview' style='background-color:" +
                    colorCode +
                    ";'></span>" +
                    state.text
                );
            }
        });
        //colors
        $('input[name="colors_active"]').on('change', function () {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors').prop('disabled', true);
            } else {
                $('#colors').prop('disabled', false);
            }
            update_sku();
        });

        $('#colors').on('change', function () {
            update_sku();
        });
        $('input[name="unit_price"]').on('keyup', function () {
            update_sku();
        });

        $('input[name="name"]').on('keyup', function () {
            update_sku();
        });

        function delete_row(em) {
            $(em).closest('.form-group').remove();
            update_sku();
        }

        function update_sku() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ route('admin.products.sku_combination') }}',
                data: $('#choice_form').serialize(),
                success: function (data) {
                    $('#sku_combination').html(data);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

        //attribute choose
        $('#choice_attributes').on('change', function () {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function () {
                console.log($(this).val());
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
            update_sku();
        });
    </script>

@endpush
