@extends('site.layouts.master')
@section('contents')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .default-color {
        color: inherit!important;
    }
</style>

    <div class="container  rtl mt-5">
        <div class="col-sm-12 mt-1">
            <a href="/" class="default-color"><i class="fa fa-house"></i></a> >
            <a href="/coupons" class="default-color">جميع المتاجر</a> >
            <span>{{optional($coupons->first())->title['ar']}}</span>
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


    <div class="main_slider">
        <div class="container">
            <div class="owl-carousel owl-theme owl-header">

                @foreach($sliders as $slider)
                    <div class="item"><img src="{{$slider->image}}" alt="{{$page->title[App::getLocale() ?? 'ar'] ?? ''}}"></div>
                @endforeach
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
