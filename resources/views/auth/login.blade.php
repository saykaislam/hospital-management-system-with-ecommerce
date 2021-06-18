@extends('frontend.layouts.master')
@section('title', 'Home')
@push('css')
    <style>
        .form-control::placeholder {
            color: #fffbfb;
            font-size: 17px;
            font-weight: bold;
        }
    </style>
@endpush
@section('content')

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Login Tab Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center" style="background-color: #fff;">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{asset('frontend/img/login-banner.png')}}" class="img-fluid" alt="Doccure Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right text-center">
                                <div class="login-header">
                                    <h1 class="font-weight-bold" style="color: #ED4095">User Login</h1>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input style="background-color: #ED4095;color: #fffbfb;
            font-size: 17px;font-weight: bold;border-radius: 29px" placeholder="Phone" type="number" name="phone" id="phone" class="form-control floating" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{--                                        <div class="col-md-2">--}}
                                        {{--                                            <label class="focus-label">Password</label>--}}
                                        {{--                                        </div>--}}
                                        <div class="col-md-12">
                                            <input style="background-color: #ED4095;color: #fffbfb;
            font-size: 17px;font-weight: bold;border-radius: 29px" placeholder="Password" type="password" name="password"  class="form-control floating" required>
                                        </div>
                                    </div>


                                    <div class="col-md-12 text-center">
                                        <button class="btn btn-primary btn-block login-btn"  type="submit" style="border-radius: 20px">Login</button>
                                    </div>
                                    <div class="text-center">
                                        <a class="forgot-link forget font-weight-bold" href="" style="color: #ED4095">Forgot Password ?</a>
                                    </div>


                                    {{--                                    <div class="login-or">--}}
                                    {{--                                        <span class="or-line"></span>--}}
                                    {{--                                        <span class="span-or">or</span>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="row form-row social-login">--}}
                                    {{--                                        <div class="col-6">--}}
                                    {{--                                            <a href="#" class="btn btn-facebook btn-block"><i class="fab fa-facebook-f mr-1"></i> Login</a>--}}
                                    {{--                                        </div>--}}
                                    {{--                                        <div class="col-6">--}}
                                    {{--                                            <a href="#" class="btn btn-google btn-block"><i class="fab fa-google mr-1"></i> Login</a>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="text-center dont-have"><a href="{{route('register')}}" style="color: #ED4095;font-weight: bold;font-size: 17px">Create Account</a></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Login Tab Content -->

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->



    {!! Toastr::message() !!}

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

@stop

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
                            //console.log(result.status);
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
