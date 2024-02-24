@extends('admin.layout.master')
@section('title', 'الماركات')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">الماركات</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">إنشاء جديد</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('brands.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">الإسم باللغة العربية</label>
                                <input type="text" class="form-control" required value="{{old('name_ar')}}" name="name_ar"
                                       id="exampleInputEmail1"
                                       placeholder="الإسم باللغة العربية">
                                @if ($errors->has('name_ar'))
                                    <small class="text-danger">{{ $errors->first('name_ar') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">الإسم باللغة الإنجليزية</label>
                                <input type="text" class="form-control" required value="{{old('name_en')}}"
                                       name="name_en"
                                       id="exampleInputEmail1"
                                       placeholder="الإسم باللغة الإنجليزية">
                                @if ($errors->has('name_en'))
                                    <small class="text-danger">{{ $errors->first('name_en') }}</small>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">الصورة</h4>
                                        <input type="file" name="image" class="dropify"
                                               required    data-height="300"/>
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('image'))
                                    <small class="text-danger">{{ $errors->first('image') }}</small>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </form>
                    </div><!-- end col -->


                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>



@stop
