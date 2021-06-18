@extends('backend.layouts.admin.master')
@section('title','Brand Create')
@push('css')

@endpush
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title">Brand Edit</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Brand Edit</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right">
                            <a href="{{route('admin.brands.index')}}">
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
                            <form role="form" class="dc-formtheme dc-userform" method="post" action="{{route('admin.brands.update',$brand->id)}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <fieldset>
                                    <div class="form-group">
                                        <label for="category">Brand Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Category Name" value="{{$brand->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title" value="{{$brand->meta_title}}" id="phone" placeholder="Enter meta title">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_desc">Meta Description</label>
                                        <textarea name="meta_description" id="meta_desc" class="form-control"  rows="3">{{$brand->meta_description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label ml-3">Logo <small class="text-danger">(Size: 120 *
                                                120px)</small></label>
                                        <div class="ml-3 mr-3">
                                            <div class="row" id="logo">
                                                @if ($brand->logo != null)
                                                    <div class="col-md-4 col-sm-4 col-xs-6">
                                                        <div class="img-upload-preview" style="width: 160px; height: 200px">
                                                            <img loading="lazy"  src="{{ url($brand->logo) }}" alt="" class="img-responsive" width="150">
                                                            <input type="hidden" name="previous_logo" value="{{ $brand->logo }}">
                                                            <button type="button" class="btn btn-danger close-btn remove-files"><i class="fa fa-times"></i></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group dc-btnarea">
                                        <input type="submit" class="dc-btn" value="Update">
                                    </div>
                                </fieldset>
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
    <script src="//cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script src="{{asset('backend/seller/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/gh/barikoi/barikoi-js@b6f6295467c19177a7d8b73ad4db136905e7cad6/dist/barikoi.min.js?key:MTg3NzpCRE5DQ01JSkgw"></script>
    <script>
        function add_more_customer_choice_option(i, name) {
            $('#customer_choice_options').append('<div class="form-group row"><div class="col-lg-2 "><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + name + '" placeholder="{{ 'Choice Title' }}" readonly></div><div class="col-lg-7"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="{{'Enter choice values' }}" data-role="tagsinput" onchange="update_sku()"></div></div>');

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        $("#name").keyup(function () {
            var name = $("#name").val();
            console.log(name);
            $.ajax({
                url: "{{URL('/seller/products/slug')}}/" + name,
                method: "get",
                success: function (data) {
                    //console.log(data.response)
                    $('#slug').val(data.response);
                }
            });
        })

        $("#sliders").spartanMultiImagePicker({
            fieldName: 'sliders[]',
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
                alert('File size too big');
            },
            // onAddRow:function(index){
            //     var altData = '<input type="text" placeholder="Image Alt" name="photos_alt[]" class="form-control" required=""></div>'
            //     //var index = index + 1;
            //     //$('#photos_alt').append('<h4 id="abc_'+index+'">'+index+'</h4>')
            //     //$('#photos_alt').append('<div class="col-md-4 col-sm-4 col-xs-6" id="abc_'+index+'">'+altData+'</div>')
            // },
            onRemoveRow : function(index){
                var index = index + 1;
                $(`#abc_${index}`).remove()
            },

        });
        $("#logo").spartanMultiImagePicker({
            fieldName: 'logo',
            maxCount: 1,
            rowHeight: '200px',
            groupClassName: 'col-md-4 col-sm-4 col-xs-6',
            maxFileSize: '1000000',
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

        Bkoi.onSelect(function () {
            // get selected data from dropdown list
            let selectedPlace = Bkoi.getSelectedData()
            console.log(selectedPlace)
            // center of the map
            document.getElementsByName("address")[0].value = selectedPlace.address;
            document.getElementsByName("city")[0].value = selectedPlace.city;
            document.getElementsByName("area")[0].value = selectedPlace.area;
            document.getElementsByName("latitude")[0].value = selectedPlace.latitude;
            document.getElementsByName("longitude")[0].value = selectedPlace.longitude;

        })
        $('.remove-files').on('click', function(){
            $(this).parents(".col-md-4").remove();
        });
    </script>
@endpush
