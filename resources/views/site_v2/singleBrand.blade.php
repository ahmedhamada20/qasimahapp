@extends('site_v2.layouts.index')

@push('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="{{asset('site/css/sass/style.css')}}">

    <style>
    .logo img{
        width: 100%;
        height: auto;
    }

    body {
        background-color: #fff
    }

    </style>
@endpush


@push('stiky-navbar')
<div style=" position: sticky ;
    top: 0;
    z-index: 999;
    width: 100%;
    height: auto;
    background-color: #ffff;" class="bg-light">
        <div class="container ">
            <div class="d-flex ">
                <div class="">
                    <img style=" padding: 5px;    height: 70px;
    border-radius: 30%;
    margin-left: 0;" class="logo" src="/logo.png" alt="لوجو">
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

@endpush
@section('content')


    <div class="container rtl mt-5">
        <div class="col-sm-12 mt-1 mb-1">
            <a href="/" class="default-color"><i class="fa fa-house"></i></a> >
            <a href="/coupons" class="default-color">جميع المتاجر</a> >
            <span>{{ count($coupons) > 0 ? optional($coupons->first())->title['ar'] : ''}}</span>
        </div>

        <div class="row d-flex">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-start align-items-center">
                            <img
                                src="{{optional(optional($coupons->first())->brand)->image ?? asset('site/img/logo.svg')}}"
                                alt="{{$page->title[App::getLocale() ?? 'ar'] ?? ''}}"
                                class="ms-2 rounded"
                                width="70" height="70" />

                            <div>
                                <h1 class="fw-bold mb-1 h6">{{$page->h1_header['ar']}}</h1>
                            </div>
                        </div>
                        <p class="mt-3 mb-4 pb-2">
                            {{$page->description['ar']}}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- end slider -->
    <!-- start  main tabs-->
    <div class="main_tabs">
        <div class="container">
            <div class="main_tabs_body">
                <div class="m_t_body" id="All">
                    <div class="row">
                        @foreach($coupons as $item)
                            @include('site.itemCard')
                        @endforeach
                        <div class="col-12">
                            <div class="load_more">
                                <a href="/coupons">@lang('data.showAll')</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div  style="position: relative">
        @include('site_v2.layouts.banner')
        <div class="container mycontainer">
            <div style="position: absolute;top:70px;left:20%">
                <img src="{{ asset('site/site/img/arrow.svg') }}" alt="">
            </div>
            <div class=" imgcard1">
                <img class="img-fluid imgcard mt-2 none  " src="{{ asset('site/site/img/card.svg') }}" alt="قسيمه">
            </div>
            <div>
                <img class="img-fluid imgcard mt-0 d-lg-none" src="{{ asset('site/site/img/mcard.svg') }}" alt="قسيمه">
            </div>
        </div>
    </div>


    @empty($siteBanner)
    @else
    <div class="col-sm-12">
        <img src="{{$siteBanner}}" alt="{{$page->h1_header[App::getLocale()] ?? ''}}" title="{{$page->h1_header[App::getLocale()] ?? ''}}" width="100%">
    </div>
    @endempty

    @empty($page->banner_path)
    @else
    <div class="col-sm-12">
        <img src="{{$page->banner_path}}" alt="{{$page->h1_header[App::getLocale()] ?? ''}}" title="{{$page->h1_header[App::getLocale()] ?? ''}}" width="100%">
    </div>
    @endempty

    <div class="col-sm-12">
        {!! $page->editor_section[App::getLocale()] ?? '' !!}
    </div>


@stop


@push('scripts')
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


@endpush
