<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Title -->
    <title>@yield('title') | Prevent Care</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/font-awesome/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/css/font-electro.css')}}">

    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/animate.css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/hs-megamenu/src/hs.megamenu.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/fancybox/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/slick-carousel/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="{{asset('frontend-shop/assets/css/theme.css')}}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @stack('css')
</head>

<body>

<!-- ========== HEADER ========== -->
@include('frontend-shop.includes.header')
<!-- ========== END HEADER ========== -->

<!-- ========== MAIN CONTENT ========== -->
@yield('content')
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== FOOTER ========== -->
@include('frontend-shop.includes.footer')
<!-- ========== END FOOTER ========== -->

<!-- ========== SECONDARY CONTENTS ========== -->
<!-- Account Sidebar Navigation -->
<!-- End Account Sidebar Navigation -->
<!-- ========== END SECONDARY CONTENTS ========== -->

<!-- Go to Top -->
<a class="js-go-to u-go-to" href="#"
   data-position='{"bottom": 15, "right": 15 }'
   data-type="fixed"
   data-offset-top="400"
   data-compensation="#header"
   data-show-effect="slideInUp"
   data-hide-effect="slideOutDown">
    <span class="fas fa-arrow-up u-go-to__inner"></span>
</a>
<!-- End Go to Top -->

<!-- JS Global Compulsory -->
<script src="{{asset('frontend-shop/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/bootstrap/bootstrap.min.js')}}"></script>

<!-- JS Implementing Plugins -->
<script src="{{asset('frontend-shop/assets/vendor/appear.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/jquery.countdown.min.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/svg-injector/dist/svg-injector.min.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/typed.js/lib/typed.min.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/slick-carousel/slick/slick.js')}}"></script>
<script src="{{asset('frontend-shop/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

<!-- JS Electro -->
<script src="{{asset('frontend-shop/assets/js/hs.core.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.countdown.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.header.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.hamburgers.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.unfold.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.focus-state.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.malihu-scrollbar.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.validation.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.fancybox.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.onscroll-animation.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.slick-carousel.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.show-animation.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.svg-injector.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.go-to.js')}}"></script>
<script src="{{asset('frontend-shop/assets/js/components/hs.selectpicker.js')}}"></script>

<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

<!-- JS Plugins Init. -->
<script>
    $(window).on('load', function () {
        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
            event: 'hover',
            direction: 'horizontal',
            pageContainer: $('.container'),
            breakpoint: 767.98,
            hideTimeOut: 0
        });

        // initialization of svg injector module
        $.HSCore.components.HSSVGIngector.init('.js-svg-injector');
    });

    $(document).on('ready', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#header'));

        // initialization of animation
        $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
            afterOpen: function () {
                $(this).find('input[type="search"]').focus();
            }
        });

        // initialization of popups
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of countdowns
        var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
            yearsElSelector: '.js-cd-years',
            monthsElSelector: '.js-cd-months',
            daysElSelector: '.js-cd-days',
            hoursElSelector: '.js-cd-hours',
            minutesElSelector: '.js-cd-minutes',
            secondsElSelector: '.js-cd-seconds'
        });

        // initialization of malihu scrollbar
        $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

        // initialization of forms
        $.HSCore.components.HSFocusState.init();

        // initialization of form validation
        $.HSCore.components.HSValidation.init('.js-validate', {
            rules: {
                confirmPassword: {
                    equalTo: '#signupPassword'
                }
            }
        });

        // initialization of show animations
        $.HSCore.components.HSShowAnimation.init('.js-animation-link');

        // initialization of fancybox
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of slick carousel
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');

        // initialization of hamburgers
        $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
            beforeClose: function () {
                $('#hamburgerTrigger').removeClass('is-active');
            },
            afterClose: function() {
                $('#headerSidebarList .collapse.show').collapse('hide');
            }
        });

        $('#headerSidebarList [data-toggle="collapse"]').on('click', function (e) {
            e.preventDefault();

            var target = $(this).data('target');

            if($(this).attr('aria-expanded') === "true") {
                $(target).collapse('hide');
            } else {
                $(target).collapse('show');
            }
        });

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

        // initialization of select picker
        $.HSCore.components.HSSelectPicker.init('.js-select');
    });
</script>

{!! Toastr::message() !!}
<script>
    @if($errors->any())
    @foreach($errors->all() as $error )
    toastr.error('{{$error}}','Error',{
        closeButton:true,
        progressBar:true
    });
    @endforeach
    @endif
</script>
@stack('js')
</body>
</html>
