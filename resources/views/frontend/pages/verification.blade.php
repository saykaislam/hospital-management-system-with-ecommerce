@extends('frontend.layouts.master')
@section('title','Phone Verification')
@push('css')
    <link href="{{asset('frontend/css/user_auth_login.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 login-form-1">
                <h3>Phone Verification</h3>
                <form method="POST" action="{{route('get-verification-code.store')}}">
                    @csrf
                    <input type="hidden" name="phone" value="{{$verCode->phone}}">
                    <div class="form-group">
                        {{--                            <input type="text" class="form-control" placeholder="Your Email *" value="" />--}}
                        <input  type="number" placeholder="code" id="code" class="form-control input100 @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Send" />
                    </div>
                    <div class="form-group">

                        <p>Didn't Receive the Code? <a href="" class="ForgetPwd" value="Login">Resend Code</a></p>
                    </div>
                </form>
            </div>
            <div class="col-md-6 login-form-2">
                {{--                    <h3>Login for Form 2</h3>--}}
                {{--                    <form>--}}
                {{--                        <div class="form-group">--}}
                {{--                            <input type="text" class="form-control" placeholder="Your Email *" value="" />--}}
                {{--                        </div>--}}
                {{--                        <div class="form-group">--}}
                {{--                            <input type="password" class="form-control" placeholder="Your Password *" value="" />--}}
                {{--                        </div>--}}
                {{--                        <div class="form-group">--}}
                {{--                            <input type="submit" class="btnSubmit" value="Login" />--}}
                {{--                        </div>--}}
                {{--                        <div class="form-group">--}}

                {{--                            <a href="#" class="ForgetPwd" value="Login">Forget Password?</a>--}}
                {{--                        </div>--}}
                {{--                    </form>--}}
            </div>
        </div>
    </div>
    {!! Toastr::message() !!}
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
        $(document).ready(function(){
            // $(".owl").owlCarousel();
        });

        $('#code').blur(function(){
            var code = $(this).val();
            //alert(parent_id);

            $.ajax({
                url : "{{ URL('check-verification-code') }}",
                method : 'get',
                data : {
                    code : code
                },
                success : function(data){
                    console.log(data)
                    if(data != 'found'){
                        toastr.warning('Your Entered Verification code is not valid, please enter valid code.')
                        //alert('Your referal code is not valid, please contact administrator.')
                        $('#code').val('');
                    }
                },
                error : function(err){
                    console.log(err)
                }
            })
        })
    </script>
@endpush
