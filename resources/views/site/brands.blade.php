@extends('site.layouts.master')
@section('contents')

<div class="container">
    <div class="row">
        <h1 class="text-center">{{$page->h1_header['ar']}}</h1>
        {{-- Search Input --}}
        <div class="col-12 col-md-12 col-lg-12 mb-5">
            <div class="search_input">
                <form action="" method="GET">
                    <div class="form-group">
                        <label for="search">البحث</label>
                        <input type="text" class="form-control" name="query" onkeyup="handleSearch(event)" placeholder="ابحث عن تطبيقك">
                    </div>
                </form>
            </div>
    </div>

    {{-- <div class="main_slider">
        <div class="container">
            <div class="owl-carousel owl-theme owl-header">

                @foreach($sliders as $slider)
                    <div class="item"><img src="{{$slider->image}}" alt=""></div>
                @endforeach
            </div>
        </div>
    </div> --}}

    <div class="row">
        @foreach ($brands as $brand)
            <a href="{{$brand->seoPage->uri}}"  ar_name="{{$brand->name['ar']}}" en_name="{{$brand->name['en']}}" class="card col-sm-3 brand-card">
                <img class="card-img-top" src="{{$brand->image}}" alt="{{$brand->name['ar']}}">
                <div class="card-body">
                    <p class="card-text text-center">
                        <span class="text-bolder">{{$brand->name['ar']}}</span>
                    </p>
                </div>
            </a>
        @endforeach
    </div>

    <div class="about_app">
        <div class="container">
            <div class="row a_c">
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="img_app">
                        <img class="img-fluid" src="{{asset('site/img/Vector.png')}}" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <div class="app_info">
                        <h5>@lang('data.aboutApp')</h5>
                        <h2>@lang('data.downloadFromStore')</h2>
                        <p>
                            @lang('data.aboutDescription')
                        </p>
                       <h2> حمل تطبيق قسيمة الحين!</h2>
<p>
 تطبيق قسيمة لأكواد وكوبونات الخصم: بوابتك الأولى لكل العروض والخصومات على أفضل المتاجر والمنتجات.

 تطبيق واحد وخدمة واحدة توفر لك مئات أكواد الخصم على كل ما تحتاجه من منتجات.

 حمِّل تطبيق قسيمة ولا تجهد نفسك بالتنقل بين تويتر والمواقع بحثا عن كوبونات الخصم وعروض التوفير!

 الأمر بسيط فقط نزّل التطبيق وخله وجهتك الأولى والأسرع لمعرفة العروض والخصومات في كل مرة تتسوق فيها أونلاين.

 حمل التطبيق الحين.</p>

                        <div class="text-center" style="margin-top: 20px;">
        <h2 class="h1">بسيييطة!</h2>
        <h4> حمّل
 تطبيق قسيمة</h4>
    </div>
    <div class="d-flex justify-content-center">
    <a href="https://shorturl.at/efzR6" target="_blank">
        <img class="img-fluid" style="margin-top: 10px; width: 180px; height: 60px; margin-left: 5px; "
            src="https://lh3.googleusercontent.com/RyLoNcOmb91IxHIP9NWfC82chbsCsT-5R25efns1FmuM8xz6znE4CRjIEBosZ1FH2xG1UqH6Axyp-vPFnm4sazbrsaB-S0QT_cN9uWU9UKoSQYCjYQ=s0"
            alt=""></a>
            <a href="https://shorturl.at/cfqER" target="_blank">
        <img style="margin-top: 10px; width: 180px; height: 60px; margin-right: 5px;"
            src="https://developer.apple.com/app-store/marketing/guidelines/images/badge-example-preferred_2x.png"
            alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    function handleSearch(event) {
        let query = event.target.value;
        let cards = document.querySelectorAll('.brand-card');
        cards.forEach(card => {
            let ar_name = card.getAttribute('ar_name');
            let en_name = card.getAttribute('en_name');
            if(ar_name.includes(query) || en_name.includes(query)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>

@stop
