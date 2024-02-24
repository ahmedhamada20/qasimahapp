@extends('site.layouts.master')
@section('contents')




    <!-- start inner -->
    <div class="inner_header">
        <div class="container">
            <div class="i_head">
                <h4>@lang('data.suggestCoupon')</h4>
                <ul>
                    <li><a href="{{route('home')}}">@lang('data.home') </a></li>
                    <li>/</li>
                    <li>@lang('data.suggestCoupon')</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end inner -->
    <!-- start items -->
    <div class="l_items">
        <div class="container">
            <div class="row">
                <form method="POST" action="{{route('suggestCouponStore')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 col-md-12">
                        <div class="mmain_card prof">

                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="text" name="full_name" required placeholder="@lang('data.fullName') ">
                                    </div>
                                    @if ($errors->has('full_name'))
                                        <small class="text-danger">{{ $errors->first('full_name') }}</small>
                                    @endif
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="email" name="email" required placeholder="@lang('data.email') ">
                                    </div>
                                    @if ($errors->has('email'))
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="text" name="whatsapp" required placeholder="@lang('data.whatsapp') ">
                                    </div>
                                    @if ($errors->has('whatsapp'))
                                        <small class="text-danger">{{ $errors->first('whatsapp') }}</small>
                                    @endif
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="text" name="address" required placeholder="@lang('data.address') ">
                                    </div>
                                    @if ($errors->has('address'))
                                        <small class="text-danger">{{ $errors->first('address') }}</small>
                                    @endif
                                </div>

                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="text" name="coupon_code" placeholder="@lang('data.coupon') ">
                                    </div>
                                    @if ($errors->has('coupon_code'))
                                        <small class="text-danger">{{ $errors->first('coupon_code') }}</small>
                                    @endif
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="number" name="discount_percent" placeholder="@lang('data.discountAmount') ">
                                    </div>
                                    @if ($errors->has('discount_percent'))
                                        <small class="text-danger">{{ $errors->first('discount_percent') }}</small>
                                    @endif
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">

                                        <select required name="category_id" class="form-control">
                                            <option disabled selected>@lang('data.choseCategory')</option>
                                            @foreach($categories as $category)
                                                <option
                                                    value="{{$category->id}}">{{$category->name[App::getLocale()]}}</option>

                                            @endforeach
                                        </select>


                                    </div>
                                    @if ($errors->has('category_id'))
                                        <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                    @endif
                                </div>


                            </div>

                        </div>
                        <div class="col-12">
                            <a href="https://api.whatsapp.com/send?phone={{$setting->mobile}}" target="_blank"
                               class="conact_whats">

                                <span>@lang('data.connectWhatsapp')</span>
                                <img src="{{asset('site/img/whats.svg')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="load_more pr">
                            <button class="btn btn-primary"> @lang('data.save')</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- end items -->
@stop
