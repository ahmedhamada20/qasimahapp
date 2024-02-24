@extends('site.layouts.master')
@section('contents')

    <!-- start inner -->
    <div class="inner_header">
        <div class="container">
            <div class="i_head">
                <h4>@lang('data.helpSection')</h4>
                <ul>
                    <li><a href="{{route('home')}}">@lang('data.home') </a></li>
                    <li>/</li>
                    <li>@lang('data.helpSection')</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end inner -->
    <!-- start items -->
    <div class="l_items">
        <div class="container">
            <div class="row">
                <form method="POST" action="{{route('help_post')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 col-md-12">
                        <div class="mmain_card prof">

                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="text" name="address" placeholder="@lang('data.address') ">
                                    </div>
                                    @if ($errors->has('address'))
                                        <small class="text-danger">{{ $errors->first('address') }}</small>
                                    @endif
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="text" name="brand" placeholder="@lang('data.brand')">
                                    </div>
                                    @if ($errors->has('brand'))
                                        <small class="text-danger">{{ $errors->first('brand') }}</small>
                                    @endif
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="text" name="email" placeholder="@lang('data.email') ">
                                    </div>
                                    @if ($errors->has('email'))
                                        <small class="text-danger">{{ $errors->first('email') }}</small>
                                    @endif
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="text" name="coupon" placeholder="@lang('data.coupon') ">
                                    </div>
                                    @if ($errors->has('coupon'))
                                        <small class="text-danger">{{ $errors->first('coupon') }}</small>
                                    @endif
                                </div>
                                <div class="col-12 col-md-12 col-lg-12">
                                    <div class="form_input">
                                        <textarea style="border-radius: 5px;
    width: 100%;
    height: 100px;
    border: 1px solid #DFDFDF;
    padding: 10px;
    color: #000;" name="message" placeholder="@lang('data.helpDesc') "></textarea>
                                    </div>
                                    @if ($errors->has('message'))
                                        <small class="text-danger">{{ $errors->first('message') }}</small>
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
                            <button class="btn btn-primary"> @lang('data.send')</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- end items -->



@endsection
