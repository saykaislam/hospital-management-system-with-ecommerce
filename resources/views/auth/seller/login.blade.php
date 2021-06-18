@extends('frontend-shop.layouts.master')
@section('title','Seller Login')
@section('content')
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('shop')}}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

        <div class="container" style="margin-top: -20px;">
            <div class="mb-4">
                <h2 class="text-center">Login</h2>
            </div>
            <div class="my-4 my-xl-8">
                <div class="row">

                    <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-6" style="padding-left: 2%; margin-top: -20px;">

                        <form class="js-validate" action="{{route('login')}}" method="POST">
                        @csrf
                            <div class="js-form-message form-group">
                                <label class="form-label" for="signinSrEmailExample3">Phone
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control" name="phone" id="phone" minlength="11" placeholder="Enter Your Phone Number" required>
                            </div>
                            <div class="js-form-message form-group">
                                <label class="form-label" for="signinSrEmailExample3">Password
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" class="form-control" name="password" minlength="6" placeholder="Enter Your Password" required>
                            </div>
                            <!-- Button -->
                            <div class="mb-1 text-center">
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary-dark-w px-5">Login</button>
                                </div>
                                <div class="mb-2">
                                    <a class="text-blue forget" href="">Forgot password?</a>
                                </div>
                                <div class="mb-2">
                                    <a class="text-blue" href="/register">Create Account?</a>
                                </div>
                            </div>
                            <!-- End Button -->
                        </form>
                    </div>
                    <div class="col-md-3">&nbsp;</div>

                </div>
            </div>
        </div>
    </main>

    !! Toastr::message() !!}

    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Password Reset Panel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="no_user text-center">
                        <h5 class="no_user_maseg text-danger"></h5>
                    </div>
                    <div class="user">
                        <form class="dc-formtheme dc-formregister" method="POST" action="/reset-password/send">
                            @csrf
                            <input type = "hidden" name="phone" id ="modal_phone" value="">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Verification Code" name="code" value="" required>
                                <small id="emailHelp" class="form-text text-muted">Dont share your code with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter Your New Password" name="newPassword" value="" required>
                                <small id="emailHelp" class="form-text text-muted">minimum 6 character</small>
                            </div>
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script !src = "">
        @if($errors->any())
        @foreach($errors->all() as $error )
        toastr.error('{{$error}}','Error',{
            closeButton:true,
            progressBar:true
        });
        @endforeach
        @endif

        jQuery(document).ready(function($) {
            $(".forget").click(function(e){
                e.preventDefault();
                // console.log($('#phone').val().substring(1));
                if( $('#phone').val().length==11) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('input[name="_token"]').val()
                        }
                    });
                    jQuery.ajax({
                        url: "{{ route('reset.pass.mobile') }}",
                        method: 'post',
                        data: {
                            phone:$('#phone').val(),
                        },
                        beforeSend: function(){
                            $('.forget').html('Verifying Your Existing Account');
                        },
                        success: function(result){
                            console.log(result.status);
                            if(result.type=="Not_found"){
                                $(".no_user_maseg").html(result.status);
                                $("#resetModal").modal('show');
                                $(".no_user").show();
                                $(".user").hide();
                            }else{
                                $(".no_user").hide();
                                $(".user").show();
                                $('#modal_phone').val(result.status.phone);
                                $("#resetModal").modal('show');
                            }
                        },
                        complete:function(){
                            $('.forget').html('Forget Password?');
                        }
                    });
                }else{
                    alert('Please Give Valid Phone Number');
                }
            });
        });
    </script>
@endpush
