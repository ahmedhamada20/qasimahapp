@extends('admin.layout.master')
@section('title', 'الصفقات')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">الصفقات</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">إنشاء جديد</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('offers.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">الكود</label>
                                <input type="text" class="form-control" required value="{{old('discount_code')}}"
                                       name="discount_code"
                                       id="exampleInputEmail1"
                                       placeholder="الكود">
                                @if ($errors->has('discount_code'))
                                    <small class="text-danger">{{ $errors->first('discount_code') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">نسبة الخصم</label>
                                <input type="number" class="form-control" required value="{{old('discount_percent')}}"
                                       name="discount_percent"
                                       id="exampleInputEmail1"
                                       placeholder="نسبة الخصم">
                                @if ($errors->has('discount_percent'))
                                    <small class="text-danger">{{ $errors->first('discount_percent') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">الرابط</label>
                                <input type="text" class="form-control" required value="{{old('url')}}"
                                       name="url"
                                       id="exampleInputEmail1"
                                       placeholder="الرابط">
                                @if ($errors->has('url'))
                                    <small class="text-danger">{{ $errors->first('url') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">الماركات</label>
                                <select name="brand_id" class="form-control" id="exampleSelect1">
                                    <option disabled>اختر الماركة</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name['ar']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id'))
                                    <small class="text-danger">{{ $errors->first('brand_id') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleSelect1">التصنيفات</label>
                                <select name="category_id" class="form-control" id="exampleSelect1">
                                    <option disabled>اختر التصنيف</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name['ar']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">الوصف بالعربية</label>
                                <textarea class="form-control"
                                          name="description_ar"> {{old('description_ar')}} </textarea>
                                @if ($errors->has('description_ar'))
                                    <small class="text-danger">{{ $errors->first('description_ar') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">الوصف بالانجليزية</label>
                                <textarea class="form-control"
                                          name="description_en">{{old('description_en')}}</textarea>
                                @if ($errors->has('description_en'))
                                    <small class="text-danger">{{ $errors->first('description_en') }}</small>
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

@section('scripts')

    <script>
        $("#mobile").on('keyup', function () {
            var mobile = $("#mobile").val();
            if (mobile >= 1) {

            } else if (mobile < 1) {
                alert('رقم الجوال يجب أن يبدأ برقم 5');
                $("#mobile").val("");
            }
        })
    </script>
@stop
