@extends('site.layouts.master')
@section('contents')
    <!-- start inner -->
    <div class="inner_header">
        <div class="container">
            <div class="i_head">
                <h4>{{$category}}</h4>
                <ul>
                    <li><a href="{{route('home')}}">@lang('data.home') </a></li>
                    <li>/</li>
                    <li>{{$category}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end inner -->
    <div class="container">

        <div class="main_tabs" style="min-height: 400px">
            <div class="row">
                @forelse($items as $item)
                    @include('site.itemCard')
                @empty

                    <div class="no-data" style="  margin: 0 auto;">
                        <img class="img-fluid" src="{{asset('site/img/et.svg')}}" alt="">
                        <h4>@lang('data.noResults')</h4>
                        <div class="">
                            <a href="{{route('home')}}" class="main_btn">@lang('daa.backHome')</a>
                        </div>
                    </div>

                @endforelse


            </div>
            <div style="text-align: center">
                {{$items->links()}}

            </div>
        </div>

    </div>



@stop

