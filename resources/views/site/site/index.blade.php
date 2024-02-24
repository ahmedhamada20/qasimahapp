<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


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
    <meta property="og:image" content="{{$page->model->brand->image ?? asset('logo.png')}}" />

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






       <link rel="stylesheet" href="{{ asset('site/site/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('site/site/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/site/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/site/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>قسيمه</title>
</head>

<body>
    <div class="container mycontainer">
        <div class="d-flex justify-content-between text-center">
            <div class=" mt-3 ">
                <!-- <a href="#"> <img class=" menu " src="./img/Menu.svg" alt="menu"></a> -->
                <div id="mySidenav" class="sidenav text-center">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="#">الرئيسية</a>
                    <a href="/coupons">تصفح الكوبونات</a>

                </div>

                <div id="main">

                    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
                </div>

            </div>
            <div class="logo mt-2 ">
              <img class="logo " src="{{ asset('site/site/img/qasima-logo.png') }}" alt="logo">
            </div>
        </div>

        <div class=" text-center mt-lg-5 mt-5 mytext ">
            <span class="myh1">!مع قسيمة ، تدلل بالخصومات كلها</span>
            <h3 class="gray mt-3">لأن قسيمة ما يقول لا</h3>
        </div>


        <div class=" mt-lg-3 mt-5">
            <div class="centerimg">
                <a class="app1 " href=" http://Onelink.to/QasimahApp"><img class="app1" src="{{ asset('site/site/img/app-store.svg') }}"
                        alt=""></a>
                <a class="app2 " href=" http://Onelink.to/QasimahApp"><img class="app2" src="{{ asset('site/site/img/google-play.svg') }}"
                        alt=""></a>
            </div>
        </div>
       <div class="mypos">
            <img src="{{ asset('site/site/img/arrow.svg') }}" alt="">
        </div>
        <div class=" imgcard1">
            <img class="img-fluid imgcard mt-2 none  " src="{{ asset('site/site/img/card.svg') }}" alt="">
        </div>
        <div>
            <img class="img-fluid imgcard mt-0 d-lg-none" src="{{ asset('site/site/img/mcard.svg') }}" alt="">
        </div>
    </div>




    </div>

    <div class="container mycontainer p-2 mt-lg-0 mt-md-4 mt-2">

        <div class="container text-end green mt-3 p-2 ">
            <div class="row">
                <div class="col-lg-6 col none p-lg-5">
                   <div class="centerimg2 ">
                        <a class="app1" href="http://Onelink.to/QasimahApp"><img class="app1"
                                src="{{ asset('site/site/img/google-play (1).svg') }}" alt=""></a>
                        <a class="app2" href="http://Onelink.to/QasimahApp"><img class="app2"
                                src="{{ asset('site/site/img/google-play (1).svg') }}" alt=""></a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 p-lg-4 mt-1 ">
                    <h4 class="white">!لا تدفع زي غيرك </h4>
                    <h6 class="white">!تطبيقنا بطل ويخليك تدفع اقل، حمله الان
                    </h6>
                </div>
               <div class="col-lg-6 col-md-6 d-lg-none mb-3 mt-2  mt-lg-3 ">
                    <div class="centerimg2  ">
                        <a class="app1" href="http://Onelink.to/QasimahApp"><img class="app1"
                                src="{{ asset('site/site/img/app-store (1).svg') }}" alt=""></a>
                        <a class="app2" href="http://Onelink.to/QasimahApp"><img class="app2"
                                src="{{ asset('site/site/img/google-play (1).svg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <div class="container mycontainer text-end mt-5">
        <div class="row">
            <div data-aos="fade-right" class="col-lg-5 col-12">
                <img class="img-fluid  " src="{{ asset('site/site/img/photo 1.svg') }}" alt="">
            </div>
            <div class="col-lg-2 col-12"></div>
            <div data-aos="flip-down" class="col-lg-5 col-12 mt-5">

                <h3 class="myh3 mt-5">!أكثر من 250 كود خصم</h3>
                <h6 class="gray">تطبيقنا يوفر لك خصومات متنوعة من المتاجر والمطاعم وتطبيقات التوصيل والصيدليات وغيرها
                    الكثير </h6>
                <a class="mya" href="http://Onelink.to/QasimahApp"><i class="fa-solid fa-arrow-left p-3"></i>إعرف أكثر
                </a>
            </div>
        </div>
    </div>
    <div class="container mycontainer text-end mt-lg-5 mt-1">
        <div class="row">

            <div data-aos="flip-down" class="col-lg-5 col-12 d-lg-none  mt-5">
           <img class="img-fluid  " src="{{ asset('site/site/img/photo 1.svg') }}" alt="">

            </div>
            <div data-aos="fade-right" class="col-lg-5 col-12 mt-lg-5 mb-5 mt-5">
                <h3 class="myh3 mt-5">!ضمان أعلى خصم</h3>
                <h6 class="gray">نضمن لك ان خصوماتنا هي الاقوى ، عندنا اتفاقيات مع متاجر ان عروضنا تكون خصمها اعلى من
                    بقية الاكواد
                </h6>
                <a class="mya" href="http://Onelink.to/QasimahApp"><i class="fa-solid fa-arrow-left p-3"></i>إعرف أكثر
                </a>
            </div>

            <div class="col-lg-2 col-12"></div>

            <div data-aos="flip-down" class="col-lg-5 col-12 none  mt-5">
                <img class="img-fluid  " src="{{ asset('site/site/img/photo 2.svg') }}" alt="">

            </div>

        </div>
    </div>
    <div class="container mycontainer text-end mt-5">
        <div class="row">
            <div data-aos="fade-right" class="col-lg-5 col-12">
              <img class="img-fluid  " src="{{ asset('site/site/img/photo 3.svg') }}" alt="">
            </div>
            <div class="col-lg-2 col-12"></div>
            <div data-aos="flip-down" class="col-lg-5 col-12 mt-5">

                <h3 class="myh3 mt-5">!أكوادنا محدثة بشكل دوري</h3>
                <h6 class="gray">لاتشيل هم الكود لو ما اشتغل معك بتلقانا نتواصل مع المتجر لإعادة تفعيله او ايقافه من
                    التطبيق</h6>
                <a class="mya" href="http://Onelink.to/QasimahApp"><i class="fa-solid fa-arrow-left p-3"></i>إعرف أكثر
                </a>
            </div>

        </div>
    </div>

    <div class="container mycontainer lg mt-5 text-center">
        <div>
            <h2 class="pt-5 white ">تدري ان فيه اكثر من 65 متجر متاح فقط على قسيمة ؟</h2>
            <h5 class="mt-3 white ">الحصريات لعبتنا حمّل تطبيقنا وخليك مميز</h5>
        </div>
        <div class="centerimg2 mt-5  ">
            <a class="app1" href="http://Onelink.to/QasimahApp"><img class="app1" src="{{ asset('site/site/img/app-store (1).svg') }}"
                    alt=""></a>
            <a class="app2" href="http://Onelink.to/QasimahApp"><img class="app2" src="{{ asset('site/site/img/google-play (1).svg') }}"
                    alt=""></a>
        </div>
        <div class=" mt-5">
            <div class="centerimg">

                <a class="mywidth m-2 white"
                    href="https://www.snapchat.com/add/qasimahapp?share_id=xgG0GoeDQgOxT8erv%2FAFBg&locale=en_SA%40calendar%3Dgregorian&sid=88517f76c8344236ad66dda0daeec135">
                    <img src="{{ asset('site/site/img/snapchat.svg') }}" alt="">
                </a>
                <a class="mywidth m-2 white" href=" https://twitter.com/Qasimah_">
                    <img src="{{ asset('site/site/img/twitter.svg') }}" alt="">
                </a>
                <a class="mywidth m-2 white" href="https://www.tiktok.com/@qasimahapp">
                    <img src="{{ asset('site/site/img/tiktok.svg') }}" alt="">
                </a>
                <a class="mywidth m-2 white " href="https://www.instagram.com/qasimahapp/?igshid=YmMyMTA2M2Y%3D">
                    <img src="{{ asset('site/site/img/insta.svg') }}" alt="">
                </a>
                <a class="mywidth m-2  white"
                    href=" facebook.com/people/تطبيق-قسيمة/100082208122983/?paipv=0&eav=Afa2OLf4OS72y6uQxdyVBUzbWeaAvSSImKhKE8robVy_heLX7w1hAs6PfMlec0wdE3Q&_rdr">
                    <img src="{{ asset('site/site/img/fb.svg') }}" alt="">
                </a>
            </div>
            <h6 class="text-center white mt-3"> <img src="{{ asset('site/site/img/copy rights.svg') }}" alt="">جميع الحقوق محفوظة لموقع قسيمة
                {{\Carbon\Carbon::today()->year}} </h6>

        </div>



    </div>



    </div>






    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous">
    </script>
    <script>
        AOS.init();
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
     <script src="{{ asset('site/site/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('site/site/js/main.js') }}"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
