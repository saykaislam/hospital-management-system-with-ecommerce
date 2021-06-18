@extends('frontend.layouts.master')
@section('title', 'Home')
@push('css')
    {{--custom css--}}
@endpush
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
@section('content')

    <!-- Page Content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <!-- Register Content -->
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center" style="background-color: #fff;">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{asset('frontend/img/login-banner.png')}}" class="img-fluid" alt="Doccure Register">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right text-center">
                                <div class="login-header">
                                    <h3>Signup <span>PreventCare</span></h3>
                                </div>

                                <!-- Register Form -->
                                <form method="POST" action="{{route('user.registration.store')}}">
                                    @csrf
                                    <div class="form-group form-focus">
                                        <div class="col-md-3">
                                            <label class="focus-label">Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="name" class="form-control floating" required>
                                        </div>
                                    </div>
                                    {{--                                    <div class="form-group form-focus">--}}
                                    {{--                                        <input type="email" name="email" class="form-control floating">--}}
                                    {{--                                        <label class="focus-label">Email</label>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="form-group form-focus col-md-12">--}}
                                    {{--                                        <div class="row">--}}
                                    {{--                                            <div class="col-md-4">--}}
                                    {{--                                                <select id="countryCode" name="countyCodePrefix" style="max-width: 80px" class="custom-select form-control bg-white border-md h-100 font-weight-bold text-muted">--}}
                                    {{--                                                    <option value="">+880</option>--}}
                                    {{--                                                </select>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="col-md-8">--}}
                                    {{--                                                <input type="number" name="phone" class="form-control floating">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="form-group form-focus">
                                        <div class="col-md-3">
                                            <label class="focus-label">Phone</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" name="phone" class="form-control floating" required>
                                        </div>
                                    </div>
                                    <div class="form-group form-focus">
                                        {{--                                        <input type="password" name="password" class="form-control floating">--}}
                                        {{--                                        <label class="focus-label">Password</label>--}}
                                        <div class="col-md-3">
                                            <label class="focus-label">Password</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="password" name="password" id="pwd" class="form-control input-lg" placeholder="Enter Password" required/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-eye-close" style="cursor:pointer;float:left;padding-top:15px;padding-left: 0px;margin-left: -7px;"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    <div class="form-group form-focus">--}}
                                    {{--                                        <input type="password" name="passwordConfirmation" class="form-control floating">--}}
                                    {{--                                        <label class="focus-label">Confirm Password</label>--}}
                                    {{--                                    </div>--}}
                                    <div class="form-group form-focus">
                                        <div class="col-md-3">
                                            <label class="focus-label">Role</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="role_id" name="role_id" class="custom-select form-control bg-white border-md h-100 " required>
                                                <option value="">Who are you?</option>
                                                {{--                                            @php--}}
                                                {{--                                                $roles = \App\Role::all();--}}
                                                {{--                                            @endphp--}}
                                                {{--                                            @foreach($roles as $role)--}}
                                                {{--                                                <option value="{{$role->id}}">{{$role->name}}</option>--}}
                                                {{--                                            @endforeach--}}
                                                <option value="4">I am Service Provider</option>
                                                <option value="5">I am User</option>
                                                {{--                                                <option value="3">Clinic</option>--}}
                                                <option value="2">I am Doctor</option>
{{--                                                <option value="6">I am Vendor</option>--}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <a class="forgot-link" href="{{ route('login') }}">Already have an account?</a>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="focus-label"></label>
                                    </div>
                                    <div class="col-md-9">
                                        <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Signup</button>
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
                                    </div>
                                </form>
                                <!-- /Register Form -->

                            </div>
                        </div>
                    </div>
                    <!-- /Register Content -->

                </div>
            </div>

        </div>

    </div>
    <!-- /Page Content -->

@stop

@push('js')
    <script>
        $(document).ready(function() {
            $(".glyphicon").bind("click", function() {
                if ($('#pwd').attr('type') =='password'){
                    $('#pwd').attr('type','text');
                    $('.glyphicon').removeClass('glyphicon-eye-open');
                    $('.glyphicon').addClass('glyphicon-eye-close');
                }else if($('#pwd').attr('type') =='text'){
                    $('#pwd').attr('type','password');
                    $('.glyphicon').removeClass('glyphicon-eye-close');
                    $('.glyphicon').addClass('glyphicon-eye-open');
                }
            })
        });
    </script>
@endpush
