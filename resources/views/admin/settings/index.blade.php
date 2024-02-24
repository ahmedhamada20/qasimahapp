@extends('admin.layout.master')
@section('title', 'الاعدادات')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">الاعدادات</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">الاعدادات</h4>
                @include('admin.layout.message')

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('settings.update',$row->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="exampleInputEmail1">رقم الجوال</label>
                                <input type="text" class="form-control"
                                       value="{{$row->mobile}}" required
                                       name="mobile"
                                       id="exampleInputEmail1"
                                       placeholder="رقم الجوال">
                                @if ($errors->has('mobile'))
                                    <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">البريد الألكترونى</label>
                                <input type="email" class="form-control"
                                       value="{{$row->email}}" required
                                       name="email"
                                       id="exampleInputEmail1"
                                       placeholder="البريد الألكترونى">
                                @if ($errors->has('email'))
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="banner">بانر الموقع</label>
                                <input type="file" name="banner" id="banner" class="form-control">
                                @if ($row->site_banner)
                                <div class="row">
                                    <img src="{{$row->site_banner_path}}" alt="image" width="100%">
                                </div>
                                @endif
                            </div>



                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </form>
                    </div><!-- end col -->


                </div><!-- end row -->
            </div>


        </div><!-- end col -->
    </div>



@stop
