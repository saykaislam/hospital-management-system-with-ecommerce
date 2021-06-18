@extends('backend.layouts.clinic.master')
@section('title', 'Update Ambulance')
@push('css')
@endpush
@section('content')
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Ambulance Update</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('clinic.dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="{{route('clinic.ambulance.index')}}">Ambulance</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Ambulance Update</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('clinic.ambulance.update',$amb_edt->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Number<span class="text-danger">*</span></label>
                                        <div class="col-md-8">
                                            <input type="text" name="number" class="form-control" value="{{$amb_edt->number}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-2">Details</label>
                                        <div class="col-lg-10">
                                            <textarea id="editor1" class="form-control" name="details">{!! $amb_edt->details !!}</textarea>
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
    <script>
        $(document).ready(function(){
            $("#id").change(function () {
                var id = $("#id").val();
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

        CKEDITOR.replace( 'details' );
    </script>
@endpush

