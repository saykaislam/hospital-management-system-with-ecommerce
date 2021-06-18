@extends('backend.layouts.admin.master')
@section('title','Product Edit')
@push('css')
    <link rel="stylesheet" href="{{asset('backend/admin/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('backend/admin/css/spectrum.css')}}">
    <style>
        .select2-container--default .color-preview {
            height: 12px;
            width: 12px;
            display: inline-block;
            margin-right: 5px;
            margin-top: 2px;
        }
    </style>
@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Product</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <form role="form" id="choice_form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.products.update2',encrypt($product->id))}}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $product->id }}">
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
                                        <input type="text" id="name" name="name" class="form-control" value="{{$product->name}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Slug (SEO Url) <small class="text-danger">(required* and unique)</small></label>
                                        <input type="text" id="slug" name="slug" value="{{$product->slug}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Category Name <small class="text-danger">(required*)</small></label>
                                        <select name="category_id" id="category_id" class="form-control demo-select2" required>
                                            <option value="">Please select one</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
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
                                                <option value="{{$brand->id}}" {{$product->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ">
                                        <label for="name">Unit</label>
                                        <input type="text" class="form-control " name="unit" id="unit"
                                               placeholder="Unit (e.g. KG, Pc etc)" value="{{$product->unit}}" required>
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
                                            <div class="row" id="photos">
                                                @if(is_array(json_decode($product->photos)))
                                                    @foreach (json_decode($product->photos) as $key => $photo)
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <div class="img-upload-preview">
                                                                <img loading="lazy"  src="{{url($photo)}}" alt="" class="img-responsive">
                                                                <input type="hidden" name="previous_photos[]" value="{{$photo}}">
                                                                <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row" id="photos_alt"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label ml-3">Thumbnail Images <small class="text-danger">(Size: 290 *
                                                300px)</small></label>
                                        <div class="ml-3 mr-3">
                                            <div class="row" id="thumbnail_img">
                                                @if ($product->thumbnail_img != null)
                                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                                        <div class="img-upload-preview">
                                                            <img loading="lazy"  src="{{ url($product->thumbnail_img) }}" alt="" class="img-responsive">
                                                            <input type="hidden" name="previous_thumbnail_img" value="{{ $product->thumbnail_img }}">
                                                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
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
                                                    <input type="number" min="0" value="{{$product->unit_price}}" step="0.01" placeholder="Unit price" name="unit_price" class="form-control" required="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="purchase_price">Purchase price</label>
                                                    <input type="number" min="0" value="{{$product->purchase_price}}" step="0.01"
                                                           placeholder="Purchase price" name="purchase_price"
                                                           class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="current_stock">Stock</label>
                                                    <select name="current_stock" id="current_stock" class="form-control {{$product->current_stock == 0 ? 'bg-danger' : 'bg-success'}}">
                                                        <option value="1" {{$product->current_stock > 0 ? 'selected' : ''}} class="bg-success">Available</option>
                                                        <option value="0" {{$product->current_stock == 0 ? 'selected' : ''}} class="bg-danger">Not Available</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="discount">Discount</label>
                                                    <input type="number" min="0" value="{{$product->discount}}" step="0.01" placeholder="Discount"
                                                           name="discount" class="form-control" required="">
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="discount">Discount Type</label>
                                                    <select class="form-control " name="discount_type" tabindex="-1"
                                                            aria-hidden="true">
                                                        <option value="amount" {{$product->discount_type == 'amount' ? 'selected' : ''}}>Flat</option>
                                                        <option value="percent" {{$product->discount_type == 'percent' ? 'selected' : ''}}>Percent</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group col-md-10">
                                                    <label for="discount">Colors</label>
                                                    @php
                                                        $colors =  \App\Color::orderBy('name', 'asc')->get();
                                                          $pColors = json_decode($product->colors);
                                                          $pColorArr = [];
                                                          foreach ($pColors as $pColor){
                                                              $data = $pColor->code;
                                                              array_push($pColorArr, $data);
                                                          }
                                                    @endphp

                                                    <select class="form-control color-var-select" name="colors[]" id="colors" multiple disabled>
                                                        @foreach ($colors as $key => $color)
                                                            <option value="{{ $color->code }}" <?php if(in_array($color->code, $pColorArr)) echo 'selected'?> >{{ $color->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <div class="status-toggle" style="margin-top:40px;">
                                                        <input value="1" type="checkbox" id="status_2" class="check" name="colors_active" <?php if(count(json_decode($product->colors)) > 0) echo "checked";?> >
                                                        <label for="status_2" class="checktoggle">checkbox</label>
                                                    </div>
                                                </div>
{{--                                                <div class="form-group col-md-2">--}}
{{--                                                    <label class="switch" style="margin-top:40px;">--}}
{{--                                                        <input value="1" type="checkbox" name="colors_active" <?php if(count(json_decode($product->colors)) > 0) echo "checked";?> >--}}
{{--                                                        <span class="slider round"></span>--}}
{{--                                                    </label>--}}
{{--                                                </div>--}}
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label for="attribute">Attribute</label>
                                                    <select name="choice_attributes[]" id="choice_attributes"
                                                            class="form-control demo-select2" multiple
                                                            data-placeholder="Choose Attributes">
                                                        @foreach (\App\Attribute::all() as $key => $attribute)
                                                            <option value="{{ $attribute->id }}" @if($product->attributes != null && in_array($attribute->id, json_decode($product->attributes, true))) selected @endif>{{ $attribute->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="customer_choice_options" id="customer_choice_options">
                                                        @foreach (json_decode($product->choice_options) as $key => $choice_option)
                                                            <div class="form-group row">
                                                                <div class="col-lg-2">
                                                                    <input type="hidden" name="choice_no[]" value="{{ $choice_option->attribute_id }}">
                                                                    <input type="text" class="form-control" name="choice[]" value="{{ \App\Attribute::find($choice_option->attribute_id)->name }}" placeholder="Choice Title" disabled>
                                                                </div>
                                                                <div class="col-lg-9">
                                                                    <input type="text" class="form-control" name="choice_options_{{ $choice_option->attribute_id }}[]" placeholder="Enter choice values" value="{{ implode(',', $choice_option->values) }}" data-role="tagsinput" onchange="update_sku()">
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <button onclick="delete_row(this)" class="btn btn-danger btn-icon"><i class="fa fa-trash"></i></button>
                                                                </div>
                                                            </div>
                                                        @endforeach
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
                                                <textarea name="description" id="description"  class="form-control">{{$product->description}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="meta_description">Meta Title</label>
                                                <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{$product->meta_title}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_description">Meta Description</label>
                                                <textarea name="meta_description" id="meta_description" rows="5"  class="form-control">{{$product->meta_description}}</textarea>
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

        </div>
    </div>
    <!-- /Page Wrapper -->

    {{--    modal--}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SEO URL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Please Change it very carefully.</p>
                    <form action="{{route('admin.products.slug-change')}}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="form-gorup">
                            <label for="slug">Slug Eidt</label>
                            <input type="text" name="slug" class="form-control" value="{{$product->slug}}">
                        </div>
                        <br>
                        <button class="btn btn-success" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
@endsection
@push('js')
    <script src="{{asset('backend/admin/js/spartan-multi-image-picker-min.js')}}"></script>
    <script src="{{asset('backend/admin/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('backend/admin/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
{{--    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>--}}
    <script>
        function add_more_customer_choice_option(i, name) {
            $('#customer_choice_options').append('<div class="form-group row"><div class="col-lg-3 "><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + name + '" placeholder="{{ 'Choice Title' }}" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="{{'Enter choice values' }}" data-role="tagsinput" onchange="update_sku()"></div></div>');

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        $('input[name="colors_active"]').on('change', function() {
            if(!$('input[name="colors_active"]').is(':checked')){
                $('#colors').prop('disabled', true);
            }
            else{
                $('#colors').prop('disabled', false);
            }
            update_sku();
        });

        $('#colors').on('change', function() {
            update_sku();
        });
        function delete_row(em){
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
                url: '{{ route('admin.products.sku_combination_edit') }}',
                data:$('#choice_form').serialize(),
                success: function(data){
                    //console.log(data)
                    $('#sku_combination').html(data);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    }
                    else {
                        $('#quantity').show();
                    }
                }
            });
        }


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
                }
                $("#subcategory_id > option").each(function() {
                    if(this.value == '{{$product->subcategory_id}}'){
                        $("#subcategory_id").val(this.value).change();
                    }
                });
                $('.demo-select2').select2();
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
                $("#subsubcategory_id > option").each(function() {
                    if(this.value == '{{$product->subsubcategory_id}}'){
                        $("#subsubcategory_id").val(this.value).change();
                    }
                });
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

        $(document).ready(function () {
            update_sku();
            get_subcategories_by_category();
            //title to slug make
            $("#name").keyup(function () {
                var name = $("#name").val();
                console.log(name);
                $.ajax({
                    url: "{{URL('/admin/products/slug')}}/" + name,
                    method: "get",
                    success: function (data) {
                        //console.log(data.response)
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

            $(".color-var-select").select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                },
            });
            //CKEDITOR.replace( 'description' );
            {{--CKEDITOR.replace( 'description', {--}}
            {{--    filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",--}}
            {{--    filebrowserUploadMethod: 'form'--}}
            {{--});--}}
            $('.remove-files').on('click', function(){
                $(this).parents(".col-md-4").remove();
            });

        });

        $('input[name="unit_price"]').on('keyup', function () {
            update_sku();
        });

        $('input[name="name"]').on('keyup', function () {
            update_sku();
        });

        $('#choice_attributes').on('change', function() {
            //$('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function(j, attribute){
                flag = false;
                $('input[name="choice_no[]"]').each(function(i, choice_no) {
                    if($(attribute).val() == $(choice_no).val()){
                        flag = true;
                    }
                });
                if(!flag){
                    add_more_customer_choice_option($(attribute).val(), $(attribute).text());
                }
            });

            var str = @php echo $product->attributes @endphp;

            $.each(str, function(index, value){
                flag = false;
                $.each($("#choice_attributes option:selected"), function(j, attribute){
                    if(value == $(attribute).val()){
                        flag = true;
                    }
                });
                if(!flag){
                    //console.log();
                    $('input[name="choice_no[]"][value="'+value+'"]').parent().parent().remove();
                }
            });

            update_sku();
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
    </script>
@endpush
