@extends('backend.layouts.admin.master')
@section('title', 'Health Tips edit')
@push('css')
    {{--custom css--}}
@endpush
@section('content')
    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Health Tips edit</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('admin.health-tips-list.index')}}">Health Tips List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Health Tips edit</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.health-tips-list.update',$healthTips->id)}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Health Tips Category<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select  name="health_tips_category_id" id="health_tips_category_id" class="form-control ">
                                                <option>-- Select --</option>
                                                @foreach($healthCat as $cat)
                                                    <option value="{{$cat->id}}"{{$cat->id == $healthTips->health_tips_category_id ? 'selected' : ''}}>{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Doctors<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <select  name="doctor_id" id="doctor_id" class="form-control">
                                                <option>-- Select --</option>
                                                @foreach($doctor as $cat)
                                                    <option value="{{$cat->id}}" {{$cat->id == $healthTips->doctor_id ? 'selected' : ''}}>{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Health Tips Title  <span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="title" value="{{$healthTips->title}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Health Tips Title in Bangla<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="title-bangla" value="{{$healthTips->title_bangla}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Health Tips Content</label>
                                        <div class="col-lg-10">
                                            <textarea id="editor1" class="form-control" name="contents"> {!! $healthTips->contents !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Health Tips Content</label>
                                        <div class="col-lg-10">
                                            <textarea id="editor1" class="form-control" name="content_bangla"> {!! $healthTips->content_bangla !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <img src="{{asset('uploads/health-tips/'.$healthTips->image)}}" alt="" width="100px;">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="image">Image <small class="text-danger">(requried*)</small></label>
                                            <input type="file" id="image" name="image" class="form-control-file">
                                        </div>
{{--                                        <div class="form-group col-md-2">--}}
{{--                                            <img src="{{asset('uploads/health-tips/'.$healthTips->image)}}" alt="" width="100px;">--}}
{{--                                        </div>--}}
{{--                                        <div class="form-group col-md-4">--}}
{{--                                            <label for="image"> Image</label>--}}
{{--                                            <div class="col-md-10">--}}
{{--                                                <input type="file" name="image" class="form-control-file">--}}
{{--                                                --}}{{--                                            <span>Width: 300px and Height: 300px (jpg)</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="form-group col-md-4">
                                            <label for="image_alt">Image Alt</label>
                                            <input type="text" id="image_alt" name="image_alt" class="form-control" value="{{ $healthTips->image_alt}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Meta Title<span class="text-danger">*</span></label>
                                        <div class="col-md-10">
                                            <input type="text" name="meta_title" value="{{$healthTips->meta_title}}"  class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Meta Description</label>
                                        <div class="col-lg-10">
                                            <textarea class="form-control" name="meta_description">{!! $healthTips->meta_description !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2"></label>
                                        <div class="col-lg-10">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
{{--    <script>--}}
{{--        $('#service_category_id').change(function(){--}}
{{--            var service_category_id = $(this).val();--}}
{{--            $.ajax({--}}
{{--                url : "{{URL('service-sub-category-list')}}",--}}
{{--                method : "get",--}}
{{--                data : {--}}
{{--                    service_category_id : service_category_id--}}
{{--                },--}}
{{--                success : function (res){--}}
{{--                    console.log(res)--}}
{{--                    $('#service_sub_category_id').html(res.data)--}}
{{--                },--}}
{{--                error : function (err){--}}
{{--                    console.log(err)--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
    <script>
        $(document).ready(function(){
            $("#health_tips_category_id").change(function () {
                var id = $("#health_tips_category_id").val();
                $.ajax({
                    url: "{{URL('/admin/services/ajax/')}}/"+id,
                    method: "get",
                    success: function(result){
                        console.log(result.response);
                        var option = "";
                        data = (result.response);
                        data.forEach(function (element) {
                            option += "<option value='"+element.id+"'>"+element.name+"</option>";
                        });
                        $("#service_subcategory_id").html(option);
                    }
                });
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
        });


        CKEDITOR.replace( 'contents' );
        CKEDITOR.replace( 'content_bangla' );
        CKEDITOR.replace( 'meta_description' );
    </script>
@endpush
