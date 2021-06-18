@extends('frontend.layouts.master')
@section('title','Reset Password')
@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet"
          media="screen">
    {{--this section for custom css only for this page--}}
    <link rel="stylesheet" href="{{asset('frontend/css/doctor-reg.css')}}">
    <style>
        #partitioned {
            padding-left: 15px;
            letter-spacing: 35px;
            border: 0;
            background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
            background-position: bottom;
            background-size: 50px 1px;
            background-repeat: repeat-x;
            background-position-x: 35px;
            width: 100%;
            min-width: 220px;
        }

        #divInner{
            left: 0;
            position: sticky;
            width: 100%;
        }

        #divOuter{
            width: 190px;
            overflow: hidden;
        }

        .dc-registerformhold {
            background: #fff;
        }

        textarea, select, .dc-select select, .form-control, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
            color: #373737;
            outline: none;
            height: 40px;
            background: #fff;
            font-size: 14px;
            -webkit-box-shadow: none;
            box-shadow: none;
            line-height: 18px;
            padding: 10px 20px;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
            border: 2px solid #9b8cc2;
            text-transform: inherit;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            font-family: 'Alatsi', sans-serif;
        }

        textarea, select, .dc-select select, .form-control, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
            color: #373737;
            outline: none;
            height: 40px;
            background: #fff;
            font-size: 14px;
            -webkit-box-shadow: none;
            box-shadow: none;
            line-height: 18px;
            padding: 10px 20px;
            border-radius: 4px;
            display: inline-block;
            vertical-align: middle;
            border: 2px solid #9b8cc2;
            text-transform: inherit;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            font-family: 'Alatsi', sans-serif;
        }

        .dc-formregister .dc-registerformgroup .form-group {
            margin: 0;
            padding: 11px;
        }
        /* .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #495057;
            background-color: #fff;
             border-color: #fff #fff #fff #fff;
        } */
        .nav-tabs .nav-item.show .nav-link, .nav-tabs  {
            color: #9b8cc2;
            background-color: #fff;
            border-color: #fff #fff #fff #fff;
            font-size: 18px;
            font-weight: bold;
            font-family: 'Alatsi', sans-serif;
            color:#ea1947;
        }
        .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
            border: 2px solid;
            border-color: #fff #fff #ea1947 #fff;
        }

        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #9b8cc2;
            background-color: #fff;
            border: 2px solid;
            border-color: #fff #fff #9b8cc2 #fff;

        }
        a, p a, p a:hover, a:hover, a:focus, a:active {
            color:#ea1947;
        }
        .dc-btn {
            min-width: 120px;
            padding: 0 10px;
            font: 400 16px/27px 'Alatsi', sans-serif;
            border-color:#9b8cc2;
        }
        .dc-joinforms {
            padding: 10px 74px;
        }
    </style>
@endpush
@section('content')
    <!--Main Start-->
    <main id="dc-main" class="dc-main dc-haslayout dc-innerbgcolor">
        <!--Register Form Start-->
        <div class="dc-haslayout dc-main-section">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 push-lg-2">
                        <div class="dc-registerformhold">
                            <div class="dc-registerformmain">
                                <div class="dc-registerhead">
                                    <div class="dc-title">
                                        <h4>Please enter your Verification Code again</h4>
                                    </div>
                                    {{--                                    <div class="dc-description">--}}
                                    {{--                                        <p>Your Verification code is: {{$verCode->code}}</p>--}}
                                    {{--                                    </div>--}}
                                    <div class="dc-description">
                                        <p>previous code was incorrect</p>
                                    </div>
                                </div>
                                <div class="dc-joinforms">
                                    <form class="dc-formtheme dc-formregister" method="POST" action="/reset-password/send">
                                        @csrf
                                        <input type = "hidden" name="phone" id ="modal_phone" value="{{$phone}}">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Verification Code" name="code" value="">
                                            <small id="emailHelp" class="form-text text-muted">Dont share your code with anyone else.</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter New Password" name="pass" value="{{$pass}}" required>
                                            <small id="emailHelp" class="form-text text-muted">minimum 6 character</small>
                                        </div>
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </form>
                                </div>
                            </div>
                            {{--                            <div class="dc-registerformfooter">--}}
                            {{--                                <span>Again send? <a href="">Resend!</a></span>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Register Form End-->
    </main>
    <!--Main End-->
@stop
@push('js')

    {{--this section for custom js, only for this page--}}
    <script>

    </script>
@endpush


