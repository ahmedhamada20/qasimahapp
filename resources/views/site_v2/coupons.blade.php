@extends('site_v2.layouts.index')


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
    </div>

@endpush


@section('content')

<div class="main_slider mt-5">
    <div class="container">
        <div class="owl-carousel owl-theme owl-header">

            @foreach($sliders as $slider)
                <div class="item"><img src="{{$slider->image}}" alt="قسيمه"></div>
            @endforeach
        </div>
    </div>
</div>
<!-- end slider -->
<!-- start  main tabs-->
<div class="main_tabs">
    <div class="container">
        <ul>
            <li data-tabs="#All"> @lang('data.All')</li>
            @foreach($categories as $category)

                <li data-tabs="#{{$category->id}}">{{$category->name[App::getLocale()]}}</li>
            @endforeach

        </ul>
        <div class="main_tabs_body">
            <div class="m_t_body" id="All">
                <div class="row">
                    @foreach($items as $item)
                        @include('site.itemCard')
                    @endforeach
                    {{-- <div class="col-12">
                        <div class="load_more">
                            <a href="{{route('showAllItems','all')}}">@lang('data.showAll')</a>
                        </div>
                    </div> --}}
                </div>
            </div>

            @foreach($categories as $category)


                <div class="m_t_body" id="{{$category->id}}">
                    <div class="row">

                        @foreach($category->items->where('offer','false') as $item)

                            @include('site.itemCard')
                        @endforeach

                        {{-- <div class="col-12">
                            <div class="load_more">
                                <a href="{{route('showAllItems',$category->id)}}">@lang('data.showAll')</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
@if(count($offersCoupon) > 0 )
    <!-- end  main tabs-->
    <!-- start strong_offer -->
    <div class="strong_offer normal">
        <div class="container">
            <div class="offer_head">
                <h6>@lang('data.bestDeals')</h6>
            </div>
            <div class="container">
                <div class="container">
                    <div class="item">
                        <div class="row">

                            @foreach($offersCoupon as $item)

                                @include('site.itemCard')

                            @endforeach

                            {{-- <div class="col-12">
                            <div class="load_more">
                                    <a href="{{route('showAllItems','offers')}}">@lang('data.showAll')</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- start strong_offer -->
    <!-- start adds  -->
@endif
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('site/css/sass/style.css')}}">
<style>
    .ltr {
        direction: ltr
    }

    .rtl {
        direction: rtl
    }

    .logo img{
        width: 100%;
        height: auto;
    }

    body {
        background-color: #fff
    }
</style>
@endpush

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
