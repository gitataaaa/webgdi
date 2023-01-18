<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <!-- favicons Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('website/assets/images/custom/logo_gdi.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('website/assets/images/custom/logo_gdi.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('website/assets/images/custom/logo_gdi.png') }}" />
    <!--<link rel="manifest" href="{{ asset('website/assets/images/favicons/site.webmanifest') }}" />-->
    <meta name="description" content="Website Yayasan Graha Dhuafa Indonesia" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('website/assets/vendors/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/animate/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/animate/custom-animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/jarallax/jarallax.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/nouislider/nouislider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/nouislider/nouislider.pips.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/odometer/odometer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/swiper/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/qrowd-icons/style.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/tiny-slider/tiny-slider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/reey-font/stylesheet.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/owl-carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/owl-carousel/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/bxslider/jquery.bxslider.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/bootstrap-select/css/bootstrap-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/vegas/vegas.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/jquery-ui/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/vendors/timepicker/timePicker.css') }}" />

    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('website/assets/css/qrowd.css') }}" />
    <link rel="stylesheet" href="{{ asset('website/assets/css/qrowd-responsive.css') }}" />

    @yield('style')
</head>

<body class="custom-cursor">

    <div class="custom-cursor__cursor"></div>
    <div class="custom-cursor__cursor-two"></div>





    <div class="preloader">
        <div class="preloader__image"></div>
    </div>
    <!-- /.preloader -->


    <div class="page-wrapper">
        <header class="main-header">
            <div class="main-header__top">
                <div class="main-header__top-inner">
                    <div class="main-header__top-left">
                        @php
                            $contact = App\Helper::displayContact();
                        @endphp
                        <ul class="list-unstyled main-header__contact-list">
                            @if($contact['inst_addr'])
                            <li>
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="text">
                                    <p>{{$contact['inst_addr']}}</p>
                                </div>
                            </li>
                            @endif

                            @if($contact['inst_email'])
                            <li>
                                <div class="icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="text">
                                    <p><a href="mailto:{{ $contact['inst_email'] }}">{{ $contact['inst_email'] }}</a></p>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="main-header__top-right">
                        @php
                            $socialMedia = App\Helper::displaySocialMedia();
                        @endphp

                        @if($socialMedia)
                        <div class="main-header__social">
                            @foreach($socialMedia as $sm)
                                <a href="{{ $sm->url }}"><i class="{{ $sm->classname }}"></i></a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <nav class="main-menu">
                <div class="main-menu__wrapper">
                    <div class="main-menu__wrapper-inner clearfix">
                        <div class="main-menu__left">
                            <div class="main-menu__logo">
                                <a href="/"><img src="{{ asset('website/assets/images/custom/logo_gdi_ext.png') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="main-menu__main-menu-box">
                            @include('layout.layout-menu', @$active)
                        </div>
                        <div class="main-menu__right">
                            <!--
                            <div class="main-menu-two__search-btn-box">
                                <div class="main-menu-two__search-box">
                                    <a href="#" class="main-menu-two__search search-toggler icon-magnifying-glass"></a>
                                </div>
                                <div class="main-menu-two__btn-box">
                                    <a href="project-details.html" class="thm-btn main-menu-two__btn"><i
                                            class="icon-plus-symbol"></i>Add a Project</a>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        <!--Page Header Start-->
        <section class="page-header">
            <div class="page-header-bg" style="background-image: url({{ asset('website/assets/images/backgrounds/page-header-bg.jpg') }})">
            </div>
            <div class="page-header-shape-1 float-bob-x">
                <img src="{{ asset('website/assets/images/shapes/page-header-shape-1.png') }}" alt="">
            </div>
            <div class="page-header-shape-2 float-bob-y">
                <img src="{{ asset('website/assets/images/shapes/page-header-shape-2.png') }}" alt="">
            </div>
            <div class="page-header-shape-3 float-bob-x">
                <img src="{{ asset('website/assets/images/shapes/page-header-shape-3.png') }}" alt="">
            </div>
            <div class="container">
                <div class="page-header__inner">
                    @yield('breadcrumb')
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <!--General Page Start-->
        @yield('pageGeneral')
        <!--General Page End-->

        @yield('pageProgram')

        @yield('pageBlog')

        @yield('pageGallery')

        @yield('pageContact')

        


        <!--Site Footer Start-->
        <footer class="site-footer">
            @include('layout.layout-footer')
        </footer>
        <!--Site Footer End-->


    </div><!-- /.page-wrapper -->


    <div class="mobile-nav__wrapper">
        @include('layout.layout-footer-mobile')
    </div>
    <!-- /.mobile-nav__wrapper -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="icon-right-arrow"></i></a>


    <script src="{{ asset('website/assets/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/jarallax/jarallax.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/jquery-appear/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/odometer/odometer.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/tiny-slider/tiny-slider.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/wow/wow.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/isotope/isotope.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/countdown/countdown.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/bxslider/jquery.bxslider.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/vegas/vegas.min.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/timepicker/timePicker.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/circleType/jquery.circleType.js') }}"></script>
    <script src="{{ asset('website/assets/vendors/circleType/jquery.lettering.min.js') }}"></script>




    <!-- template js -->
    <script src="{{ asset('website/assets/js/qrowd.js') }}"></script>

    @stack('script')
</body>

</html>