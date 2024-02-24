@extends('site.layouts.master')

@section('contents')

    <!-- start inner -->
    <div class="inner_header">
        <div class="container">
            <div class="i_head">
                <h4>@lang('data.profile')</h4>
                <ul>
                    <a href="{{route('home')}}">
                        <li>@lang('data.home')</li>
                    </a>
                    <li>/</li>
                    <li>@lang('data.profile')</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- end inner -->
    <!-- start items -->
    <div class="l_items">
        <div class="container">
            <div class="title-pro">
                <h6>@lang('data.changeInfo')</h6>
            </div>
            <form action="{{route('updateProfile')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="mmain_card prof">

                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="text" name="name" value="{{\Auth::user()->name}}"
                                               placeholder="@lang('data.fullName') ">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="email" value="{{\Auth::user()->email}}" name="email"
                                               placeholder="@lang('data.email') ">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="load_more pr">
                            <button class="btn btn-info" style="background: #2fb2a2"> @lang('data.save')</button>
                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <div class="l_items main-t">
        <div class="container">
            <div class="title-pro">
                <h6>@lang('data.changePassword')</h6>
            </div>

            <form action="{{route('updatePassword')}}" method="post">
                @csrf
                <div class="row">


                    <div class="col-12 col-md-12">
                        <div class="mmain_card prof">

                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="password" name="old_password"
                                               placeholder="@lang('data.currentPassword') ">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="password" name="new_password" placeholder="@lang('data.newPassword') ">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6">
                                    <div class="form_input">
                                        <input type="password" name="new_password_confirmation"
                                               placeholder="@lang('data.newPasswordConfirmation') ">
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>
                    <div class="col-12">
                        <div class="load_more pr">
                            <button class="btn btn-info" style="background: #2fb2a2"> @lang('data.save')</button>
                        </div>
                    </div>


                </div>
            </form>

        </div>
    </div>
    <!-- end items -->




@stop
