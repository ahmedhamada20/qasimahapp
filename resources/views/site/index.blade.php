@extends('site.layouts.master')
@section('contents')

    <div class="main_slider">
        <div class="container">
            <div class="owl-carousel owl-theme owl-header">

                @foreach($sliders as $slider)
                    <div class="item"><img src="{{$slider->image}}" alt=""></div>
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

                            @foreach($category->items->where('offer','false')->take(9) as $item)

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

@stop
