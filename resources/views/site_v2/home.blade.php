@extends('site_v2.layouts.index')

@push('styles')


@endpush

@section('content')
@include('site_v2.layouts.banner')
<div class="container mycontainer">
   <div class="mypos">
        <img src="{{ asset('site/site/img/arrow.svg') }}" alt="">
    </div>
    <div class=" imgcard1">
        <img class="img-fluid imgcard mt-2 none  " src="{{ asset('site/site/img/card.svg') }}" alt="قسيمه">
    </div>
    <div>
        <img class="img-fluid imgcard mt-0 d-lg-none" src="{{ asset('site/site/img/mcard.svg') }}" alt="قسيمه">
    </div>
</div>

<div class="container mycontainer p-2 mt-lg-0 mt-md-4 mt-2">

    <div class="container text-end green mt-3 p-2 ">
        <div class="row">
            <div class="col-lg-6 col none p-lg-5">
               <div class="centerimg2 ">
                    <a class="app1" href="http://Onelink.to/QasimahApp"><img class="app1"
                            src="{{ asset('site/site/img/google-play (1).svg') }}" alt="قسيمه"></a>
                    <a class="app2" href="http://Onelink.to/QasimahApp"><img class="app2"
                            src="{{ asset('site/site/img/google-play (1).svg') }}" alt="قسيمه"></a>
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
                            src="{{ asset('site/site/img/app-store (1).svg') }}" alt="قسيمه"></a>
                    <a class="app2" href="http://Onelink.to/QasimahApp"><img class="app2"
                            src="{{ asset('site/site/img/google-play (1).svg') }}" alt="قسيمه"></a>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="container mycontainer text-end mt-5">
    <div class="row">
        <div data-aos="fade-right" class="col-lg-5 col-12">
            <img class="img-fluid  " src="{{ asset('site/site/img/photo 1.svg') }}" alt="قسيمه">
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
       <img class="img-fluid  " src="{{ asset('site/site/img/photo 1.svg') }}" alt="قسيمه">

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
            <img class="img-fluid  " src="{{ asset('site/site/img/photo 2.svg') }}" alt="قسيمه">

        </div>

    </div>
</div>
<div class="container mycontainer text-end mt-5">
    <div class="row">
        <div data-aos="fade-right" class="col-lg-5 col-12">
          <img class="img-fluid  " src="{{ asset('site/site/img/photo 3.svg') }}" alt="قسيمه">
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


@endsection
