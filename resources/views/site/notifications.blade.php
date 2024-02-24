@extends('site.layouts.master')
@section('contents')

    <!-- start inner -->
    <div class="inner_header">
        <div class="container">
            <div class="i_head">
                <h4>@lang('data.notification')</h4>
                <ul>
                    <li><a href="{{route('home')}}">@lang('data.home') </a></li>
                    <li>/</li>
                    <li>@lang('data.notification')</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end inner -->

    <!-- start  Notifications-->
    <div class="notifications">

        <div class="container">

            @if(count($rows) > 0)
                <div class="notification_head">
                    {{--      <h6>30 يونيو 2021</h6>--}}
                    <a href="{{route('delete_notifications')}}">
                        <img src="{{asset('site/img/trash.svg')}}" alt="">
                        <span>@lang('data.deleteAll')</span>
                    </a>
                </div>
                <div class="notification_body">
                    @foreach($rows as $row)
                        <div class="item_noti">
                            <img src="{{asset('site/img/user_not.svg')}}" alt="">
                            <p>{{$row->body}}</p>
                            <span>{{\Carbon\Carbon::parse($row->create_at)->diffForHumans()}}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-data">
                    <img class="img-fluid" src="{{asset('site/img/et.svg')}}" alt="">
                    <h4>@lang('data.noNotifications')</h4>
                    <div class="">
                        <a href="{{route('home')}}" class="main_btn">@lang('data.backHome')</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- end Notifications -->

@endsection
