<!DOCTYPE html>
@if(\App::getLocale() == 'en')
<html dir="ltr" lang="en">
@else
<html dir="rtl" lang="ar">
@endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    {{-- <meta property="og:title" content="قسيمة" />
    <meta property="og:url" content="https://alkhalaffamily.com/" />
    <meta property="og:image" content="{{asset('logo.png')}}" />
    <meta property="og:description" content="قسيمة هو تطبيق يقدم لك العديد من كوبونات الخصم المتنوعة للحصول علي أفضل العروض لمختلف الماركات العالمية, حمل التطبيق الآن و استمتع بتجربة فريدة من نوعها.
" />
    <meta property="og:site_name" content="قسيمة" />

    <title>@lang('data.siteTitle')</title> --}}


    <title>{{$page->title[App::getLocale() ?? 'ar'] ?? ''}}</title>
    <meta name="description" content="{{$page->description[App::getLocale() ?? 'ar'] ?? ''}}"/>

    <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large"/>

    <meta property="og:locale" content="ar_AR" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{$page->title[App::getLocale() ?? 'ar'] ?? ''}}" />
    <meta property="og:description" content="{{$page->description[App::getLocale() ?? 'ar'] ?? ''}}" />

    <meta property="og:url" content="{{$page->uri ?? '/'}}" />

    <meta property="og:site_name" content="قسيمة" />

    <meta property="article:section" content="القسم" />
    {{-- <meta property="og:updated_time" content="2023-11-19T20:51:13+03:00" /> --}}
    <meta property="og:image" content="{{$page->model->brand->image ?? $page->model->image ?? asset('logo.png')}}" />

    <meta property="og:image:width" content="1119" />
    <meta property="og:image:height" content="502" />
    <meta property="og:image:alt" content="{{$page->title[App::getLocale() ?? 'ar'] ?? ''}}" />

    <meta property="og:image:type" content="image/png" />


    <meta name="twitter:card" content="{{$page->model->brand->image ?? asset('logo.png')}}" />

    <meta name="twitter:title" content="{{$page->title[App::getLocale() ?? 'ar'] ?? ''}}" />
    <meta name="twitter:description" content="{{$page->description[App::getLocale() ?? 'ar'] ?? ''}}" />
    <meta name="twitter:site" content="@Qasimah_" />
    <meta name="twitter:creator" content="@Qasimah_" />

    <meta name="twitter:label1" content="Written by" />
    <meta name="twitter:data1" content="قسيمة " />

    <link rel="icon" href="https://qasimahapp.com/site/site/img/qasima-logo.png" type="image/x-icon" />

    <link rel="shortcut icon" href="{{asset('logo.png')}}" />

    <link rel="stylesheet" href="{{asset('site/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/sass/style.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    {{-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Tajawal';
        }

    </style>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- @include('facebook-pixel::head') --}}
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TMB6H81SL2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-TMB6H81SL2');
    </script>
</head>

<body>
    <div style=" position: sticky ;
    top: 0;
    z-index: 999;
    width: 100%;
    height: auto;
    background-color: #ffff ;
    " class="bg-light">
        <div class="container ">
            <div class="d-flex ">
                <div class="">
                    <img style=" padding: 5px;    height: 70px;
    border-radius: 30%;
    margin-left: 0;" class="logo" src="./logo.png" alt="لوجو">
                </div>
                <div style="position: relative;" class="">
                    <div class="d-flex mt-2 flex-column">
                        <p class="slogan"
                        style="
                        margin-bottom: 5px;">اقوى
                         اكواد الخصم بالتطبيق🚀


                        </p>
                        <p style="
                            font-size: 10px ">حمل تطبيق قسيمة واستمتع بالعروض الحصرية💰
                        </p>
                        <!--TODO-->
                    </div>
                </div>
            </div>
        </div>
        <div class="rounded-pill download">
          <h6> <a style="text-decoration: none; color: #ffffff;
                background-color: #2FB2A2;
    margin-bottom: 1px;
    border: radius 20px;
    text-align: center;
    padding: 5px;
    margin: 5px; " href="http://Onelink.to/QasimahApp"> حمل التطبيق</a></h6>
        </div>
    </div>
    {{-- @include('facebook-pixel::body') --}}
    <!-- start nav -->
    <div class="responsive_nav">
        <!--<a href="{{route('home')}}"> <img style=" border-radius: 50%;" src="{{asset('logo.png')}}" alt=""></a> -->
        <div class="filter_bar">
                    <form method="get" action="{{route('searchCoupons')}}">

                        <button type="submit">
                            <img src="{{asset('site/img/search.svg')}}" alt="">
                        </button>

                        <input required name="search" type="text" placeholder="@lang('data.searchForCoupons')">
                    </form>
                    <div class="co_drop">
                        <button class="">
                            <img src="{{asset('site/img/filter.svg')}}" alt="">

                        </button>
                        <form method="get" action="{{route('couponFilter')}}">
                            <div class="drop_bo">
                                <div class="form_input">
                                    <select required name="filter" id="">
                                        <option value="high_discount">@lang('data.highestSale')</option>
                                        <option value="alpha_asc">@lang('data.A-Z')</option>
                                        <option value="alpha_desc">@lang('data.Z-A')</option>

                                    </select>
                                </div>
                                <div class="submit_but">
                                    <button class="login_btn"> @lang('data.Search')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        <div class="bar" style="padding-right: 3px;">
            <i class="fas fa-bars"></i>
        </div>
    </div>
    <nav>
        <div class="container">
            <div class="nav_item">
                <div class="logo md_none">
                    <a href="{{route('home')}}"><img style=" border-radius: 30%; margin-top :10px;" src="{{asset('logo.png')}}"
                            alt=""></a>
                </div>

                <div class="container_lan md_none">
                    <div class="cont_lang ">
                        @if(\App::getLocale() == 'ar')

                        <a href="{{route('language','en')}}">
                            <span>ENGLISH</span>
                            <img src="{{asset('site/img/lang.svg')}}" alt="">
                        </a>
                        @else
                        <a href="{{route('language','ar')}}">
                            <span>عربى</span>
                            <img src="{{asset('site/img/lang.svg')}}" alt="">
                        </a>
                        @endif
                    </div>
                    @if(\Auth::check())
                    <div class="login-droup">
                        <ul>


                            <li>
                                <div class="item-h">

                                    <img src="{{asset('site/img/user.svg')}}" alt="">
                                </div>
                                <div class="item-d">
                                    <!-- <p class="td-title">القائمة</p> -->
                                    <ul>
                                        <li>
                                            <a href="{{route('profile')}}">
                                                <img src="{{asset('site/img/edit.svg')}}" alt="">
                                                <span>@lang('data.profile')</span>
                                            </a>
                                        </li>
                                        <li class="red">
                                            <a href="{{route('userLogout')}}">
                                                <img src="{{asset('site/img/Login.svg')}}" alt="">
                                                <span>@lang('data.logoutFromSite')</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                    @else
                    <div class="login_content">

                        <a id="loginAction" style="cursor: default;" class="log_in">
                            @lang('data.login')
                        </a>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </nav>
    {{-- <div class="links_a">
        <div class="container">
            <ul>
                <li><a class="active" href="{{route('home')}}">@lang('data.home')</a></li>
                @if(\Auth::check())
                <li><a href="{{route('favourites')}}">@lang('data.favourites')</a></li>
                <li><a href="{{route('notifications')}}">@lang('data.notifications')</a></li>
                <li><a href="{{route('usedCoupons')}}">@lang('data.usedCoupons')</a></li>
                @endif
                <li><a href="{{route('suggestCouponIndex')}}">@lang('data.suggestCoupon')</a></li>

            </ul>
            <div class="container_lan md_show">
                <div class="cont_lang ">
                    <a href="">
                        <span>ENGLISH</span>
                        <img src="{{asset('site/img/lang.svg')}}" alt="">
                    </a>
                </div>
                <div class="login_content">

                    <a id="loginAction" style="cursor: default;" class="log_in">
                        @lang('data.login')
                    </a>
                </div>
            </div>
        </div>
    </div> --}}
    @yield('contents')
    @include('sweetalert::alert')

    <!-- start  -->
    <footer style="">
        <div class="container">
            <div class="foot-top">

                <div class="logo-img">
                    <a href="{{route('home')}}"> <img style=" border-radius: 30%; " src="{{asset('logo.png')}}"
                            alt=""></a>

                </div>
                <div   style="">
                <a style="text-decoration: none; color: #2FB2A2; font-size: 25px; border-radius: 30%; text-align:center ;  padding: 8px;" href="https://www.tiktok.com/@qasimahapp"><i style="text-align:center ;" class="fab fa-tiktok"></i></a>
                <a style="text-decoration: none; color: #2FB2A2; font-size: 25px; border-radius: 30%; text-align:center ;  padding: 8px;" href="https://instagram.com/qasimahapp?igshid=YmMyMTA2M2Y="><i style="text-align:center ;" class="fab fa-instagram"></i></a>
                    <a style="text-decoration: none; color: #2FB2A2; font-size: 25px; border-radius: 30%; text-align:center ;  padding: 8px;" href="https://m.facebook.com/people/تطبيق-قسيمة/100082208122983/"><i style="text-align:center ;" class="fab fa-facebook-square"></i></a>

                    <a style="text-decoration: none; color: #2FB2A2; font-size: 25px; border-radius: 30%; text-align:center ;  padding: 8px;" href="https://twitter.com/Qasimah_"><i style="text-align:center ;" class="fab fa-twitter-square"></i></a>
                    <a style="text-decoration: none; color: #2FB2A2; font-size: 25px; border-radius: 30%; text-align:center ;  padding: 8px;" href="https://youtube.com/@QasimahApp"><i style="text-align:center ;"class="fab fa-youtube-square"></i></a>
                    <a style="text-decoration: none; color: #2FB2A2; font-size: 25px; border-radius: 30%; text-align:center ;  padding: 8px;" href="https://t.snapchat.com/GofK2FG2"><i style="text-align:center ;" class="fab fa-snapchat-square"></i></a>
                </div>




                <ul>
                    @if(\Auth::check())

                    <li><a href="{{route('usedCoupons')}}">@lang('data.usedCoupons')</a></li>
                    @endif
                    <li><a href="{{route('suggestCouponIndex')}}">@lang('data.suggestCoupon')</a></li>
                    <li><a href="{{route('help')}}">@lang('data.helpSection')</a></li>

                </ul>


            </div>
            <div class="foot-buttom">
                <h6>جميع الحقوق محفوظة لموقع <span>قسيمة </span> {{\Carbon\Carbon::now()->format("Y")}}</h6>


                <!-- <a href="https://headshot.com.sa/" target="_blank">
                        <h6>برمجه وتصميم شركة <span>هيدشوت </span> {{\Carbon\Carbon::now()->format("Y")}}</h6>
                    </a> -->
            </div>
        </div>


        {{--  LOGIN - REGISTER _ FORGET PASSWORD POP UP  --}}
        <div style="display: none" id="loginForm" class="login_container">
            <div class="login_body">
                <button id="closeLogin" style=" width: 20px;
        height: 20px;
        display: flex;
        background: #2fb2a2;
        align-items: center;
        color: #fff;
        justify-content: center;
        border-radius: 50%;">
                    <i class="fa fa-times-circle"></i>
                </button>
                <h6>@lang('data.welcome')</h6>
                <h5>@lang('data.loginToAccount')</h5>
                <form method="post" action="{{route('authentication')}}">
                    @csrf
                    <div class="form_input">
                        <input type="email" name="email" required placeholder="@lang('data.email') ">
                    </div>
                    <div class="form_input">
                        <input type="password" required name="password" placeholder="@lang('data.password') ">
                    </div>
                    <div class="save_password">
                        <label for="tt">
                            <input type="checkbox" id="tt">
                            <span>@lang('data.savePassword')</span>
                        </label>
                    </div>
                    <div class="forget_p">
                        <a style="cursor:default;" onclick="showForgetPassword()">@lang('data.forgetPassword?')</a>
                    </div>
                    <div class="submit_but">
                        <button type="submit" class="login_btn"> @lang('data.login')</button>
                        <a id="registerAction" style="cursor: default;" class="lo_btn"> @lang('data.register')</a>
                    </div>
                </form>

            </div>
        </div>


        <div style="display: none" id="registerFrom" class="login_container">
            <div class="login_body">
                <button id="closeRegister" style=" width: 20px;
        height: 20px;
        display: flex;
        background: #2fb2a2;
        align-items: center;
        color: #fff;
        justify-content: center;
        border-radius: 50%;">
                    <i class="fa fa-times-circle"></i>
                </button>
                <h6>@lang('data.register')</h6>
                <form method="post" action="{{route('register')}}">
                    @csrf

                    <div class="form_input">
                        <input type="text" name="name" required placeholder="@lang('data.fullName') ">
                    </div>
                    <div class="form_input">
                        <input type="email" name="email" placeholder="@lang('data.email') ">
                    </div>
                    <div class="form_input">
                        <input type="password" name="password" placeholder="@lang('data.password') ">
                    </div>

                    <div class="submit_but">
                        <button type="submit" class="login_btn"> @lang('data.register')</button>
                        <button type="button" style="cursor: default" onclick="closeRegisterOpenLogin()" class="lo_btn">
                            @lang('data.login')
                        </button>

                    </div>


                </form>
            </div>
        </div>


        <div style="display: none" id="forgetPasswordFirstForm" class="login_container">
            <div class="login_body">
                <button id="closeForgetPasswordFirst" style=" width: 20px;
        height: 20px;
        display: flex;
        background: #2fb2a2;
        align-items: center;
        color: #fff;
        justify-content: center;
        border-radius: 50%;">
                    <i class="fa fa-times-circle"></i>
                </button>

                <h6>@lang('data.restorePassword')</h6>
                <p class="log-m">@lang('data.enterPasswordToRecover')</p>

                <div class="form_input">
                    <input type="email" name="email" id="forgetPasswordFirstEmail" placeholder="@lang('data.email') ">
                </div>


                <div class="submit_but">
                    <button type="button" id="forgetPasswordFirstSubmit" class="login_btn"> @lang('data.send')</button>
                    <button type="button" style="cursor: default" onclick="closeRegisterOpenLogin()" class="lo_btn">
                        @lang('data.login')
                    </button>
                </div>


            </div>
        </div>

        <div style="display:none;" id="forgetOtpForm" class="login_container">
            <div class="login_body">
                <button id="closeOtpForm" style=" width: 20px;
        height: 20px;
        display: flex;
        background: #2fb2a2;
        align-items: center;
        color: #fff;
        justify-content: center;
        border-radius: 50%;">
                    <i class="fa fa-times-circle"></i>
                </button>
                <h6>@lang('data.enterCode')</h6>
                <p class="log-m">@lang('data.enterCodeSent')</p>

                <div class="form_input">
                    <input name="code" type="text" id="otp" placeholder="@lang('data.verificationCode') ">
                </div>
                <div class="submit_but">
                    <button type="button" id="checkOtp" class="login_btn"> @lang('data.accept')</button>
                    <!-- <a href="" class="lo_btn"> تسجيل دخول</a> -->
                </div>


            </div>
        </div>
        <div style="display: none" id="changePassword" class="login_container">
            <div class="login_body">
                <button id="closeChangePassword" style=" width: 20px;
        height: 20px;
        display: flex;
        background: #2fb2a2;
        align-items: center;
        color: #fff;
        justify-content: center;
        border-radius: 50%;">
                    <i class="fa fa-times-circle"></i>
                </button>
                <h6>@lang('data.newPasswordPop')</h6>
                <p class="log-m">@lang('data.enterNewPassword')</p>

                <div class="form_input">
                    <input type="password" id="new_password" placeholder=" @lang('data.newPassword') ">
                </div>
                <div class="form_input">
                    <input type="password" id="new_password_confirmation"
                        placeholder="@lang('data.newPasswordConfirmation') ">
                </div>


                <div class="submit_but">
                    <button type="button" id="changePasswordSubmit" class="login_btn"> @lang('data.save')</button>
                    <!-- <a href="" class="lo_btn"> تسجيل دخول</a> -->
                </div>


            </div>
        </div>

        {{--     END POP UPS   --}}


    </footer>
    <!-- end -->
    <script src="{{asset('site/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('site/js/poper.min.js')}}"></script>
    <script src="{{asset('site/js/bootstrap.min.js')}}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{asset('site/js/all.js')}}"></script>
    <script src="{{asset('site/js/owl.carousel.js')}}"></script>
    <script src="{{asset('site/js/main.js')}}"></script>
    <script>
    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $("#loginAction").on('click', function() {
        $("#forgetPasswordFirstForm").hide();
        $("#registerFrom").hide();
        $("#loginForm").show();
    });
    $("#closeLogin").on('click', function() {
        $("#loginForm").hide();
    });
    $("#registerAction").on('click', function() {
        $("#loginForm").hide();
        $("#registerFrom").show();
    });
    $("#closeRegister").on('click', function() {
        $("#registerFrom").hide();
    });

    function closeRegisterOpenLogin() {
        $("#registerFrom").hide();
        $("#forgetPasswordFirstForm").hide();

        $("#loginForm").show();

    }

    function showForgetPassword() {

        $("#loginForm").hide();
        $("#forgetPasswordFirstForm").show();
    }

    $("#closeForgetPasswordFirst").on('click', function() {
        $("#forgetPasswordFirstForm").hide();

    });
    $("#forgetPasswordFirstSubmit").on('click', function() {
        console.log('farouz');
        var email = $("#forgetPasswordFirstEmail").val();
        $.ajax({
            type: "POST",
            url: "{{route('firstForgetPassword')}}",
            data: {
                email: email
            },
            success: (data) => {

                if (data.value == true) {
                    console.log('here');
                    $("#forgetPasswordFirstForm").hide();
                    $("#forgetOtpForm").show();
                    $("#forgetPasswordFirstEmail").val(' ');
                    Swal.fire({
                        title: 'Success!',
                        text: data.data,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.msg,
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            }
        })
    });
    $("#closeOtpForm").on('click', function() {
        $("#forgetOtpForm").hide();
    });
    $("#checkOtp").on('click', function() {
        var code = $("#otp").val();
        $.ajax({
            type: "POST",
            url: "{{route('checkOtp')}}",
            data: {
                code: code
            },
            success: (data) => {
                if (data.value == true) {
                    $("#forgetOtpForm").hide();
                    $("#changePassword").show();
                    $("#otp").val(' ');
                    Swal.fire({
                        title: 'Success!',
                        text: data.data,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });

                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.msg,
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            }
        })
    });
    $("#closeChangePassword").on('click', function() {
        $("#changePassword").hide();
    });
    $("#changePasswordSubmit").on('click', function() {
        var new_password = $("#new_password").val();
        var new_password_confirmation = $("#new_password_confirmation").val();
        $.ajax({
            type: "POST",
            url: "{{route('changeNewPassword')}}",
            data: {
                new_password: new_password,
                new_password_confirmation: new_password_confirmation
            },
            success: (data) => {
                if (data.value == true) {
                    $("#changePassword").hide();
                    $("#loginForm").show();
                    $("#new_password").val(' ');
                    $("#new_password_confirmation").val(' ');
                    Swal.fire({
                        title: 'Success!',
                        text: data.data,
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });


                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.msg,
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            }
        })
    });

    function copy_data(containerid, item_id, itemTtile) {
        console.log(containerid);

        var range = document.createRange();

        range.selectNode(containerid); //changed here

        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand("copy");
        gtag('event', 'copy_code', {
            'store_name': itemTtile,
        });
        window.getSelection().removeAllRanges();
        // alert("data copied");
        $.ajax({
            type: "POST",
            data: {
                item_id: item_id
            },
            url: "{{route('userCoupon')}}",
            success: () => {
                console.log('coupon used');
            }
        })
    }
    </script>

</body>

</html>
<!--  -->
