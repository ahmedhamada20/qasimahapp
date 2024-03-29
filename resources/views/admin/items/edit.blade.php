@extends('admin.layout.master')
@section('title', 'الكوبونات')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">الكوبونات</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">تعديل البيانات</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('items.update',$row->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')




                            <div class="form-group">
                                <label for="exampleInputEmail1">عنوان الكوبون باللغه العربية</label>
                                <input type="text" class="form-control" required value="{{$row->title ? $row->title['ar'] : ''}}"
                                       name="title_ar"
                                       id="exampleInputEmail1"
                                       placeholder="عنوان الكوبون باللغه العربية">
                                @if ($errors->has('title_ar'))
                                    <small class="text-danger">{{ $errors->first('title_ar') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">عنوان الكوبون باللغه الأنجليزية</label>
                                <input type="text" class="form-control" required value="{{$row->title ? $row->title['en'] : ''}}"
                                       name="title_en"
                                       id="exampleInputEmail1"
                                       placeholder="عنوان الكوبون باللغه الأنجليزية">
                                @if ($errors->has('title_en'))
                                    <small class="text-danger">{{ $errors->first('title_en') }}</small>
                                @endif
                            </div>




                            <div class="form-group">
                                <label for="exampleInputEmail1">الكود</label>
                                <input type="text" class="form-control" required value="{{$row->discount_code}}"
                                       name="discount_code"
                                       id="exampleInputEmail1"
                                       placeholder="الكود">
                                @if ($errors->has('discount_code'))
                                    <small class="text-danger">{{ $errors->first('discount_code') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">نسبة الخصم</label>
                                <input type="text" class="form-control" required value="{{$row->discount_percent}}"
                                       name="discount_percent"
                                       id="exampleInputEmail1"
                                       placeholder="نسبة الخصم">
                                @if ($errors->has('discount_percent'))
                                    <small class="text-danger">{{ $errors->first('discount_percent') }}</small>
                                @endif
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label for="exampleInputEmail1">هل انت صاحب المتجر او مسوق بالعمولة؟</label>--}}
{{--                                <select class="form-control" name="store_affiliate" required>--}}
{{--                                    <option value="" disabled selected>-- اختر من القائمه --</option>--}}
{{--                                    <option value="store" {{$row->store_affiliate == "store" ? 'selected' : null}}>متجر</option>--}}
{{--                                    <option value="affiliate" {{$row->store_affiliate == "affiliate" ? 'selected' : null}}>مسوق بالعمولة</option>--}}
{{--                                </select>--}}

{{--                                @if ($errors->has('store_affiliate'))--}}
{{--                                    <small class="text-danger">{{ $errors->first('store_affiliate') }}</small>--}}
{{--                                @endif--}}
{{--                            </div>--}}

                            <div class="form-group">
                                <label for="exampleInputEmail1">الرابط</label>
                                <input type="text" class="form-control" required value="{{$row->url}}"
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
                                        <option {{$brand->id == $row->brand_id ? 'selected' : ''}}  value="{{$brand->id}}">{{$brand->name['ar']}}</option>
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
                                        <option {{$category->id == $row->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name['ar']}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <small class="text-danger">{{ $errors->first('category_id') }}</small>
                                @endif
                            </div>

                             <div class="form-group">
                                <label for="sort_orderInput">الترتيب</label>
                                <input type="text" class="form-control" required value="{{$row->sort_order}}"
                                       name="sort_order"
                                       id="sort_orderInput"
                                       placeholder="الترتيب">
                                @if ($errors->has('sort_order'))
                                    <small class="text-danger">{{ $errors->first('sort_order') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">الوصف بالعربية</label>
                                <textarea class="form-control"
                                          required
                                          name="description_ar"> {{$row->description ? $row->description['ar'] : ''}} </textarea>
                                @if ($errors->has('description_ar'))
                                    <small class="text-danger">{{ $errors->first('description_ar') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">الوصف بالانجليزية</label>
                                <textarea class="form-control"
                                          required
                                          name="description_en"> {{$row->description ? $row->description['en'] : ''}} </textarea>
                                @if ($errors->has('description_en'))
                                    <small class="text-danger">{{ $errors->first('description_en') }}</small>
                                @endif
                            </div>





                            <div class="form-group">
                                <label for="exampleInputEmail1">نصيحه  بالعربية</label>
                                <textarea class="form-control"

                                          name="advice_ar">{{$row->advice ? $row->advice['en'] : ''}} </textarea>
                                @if ($errors->has('advice_en'))
                                    <small class="text-danger">{{ $errors->first('advice_en') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">نصيحه  بالانجليزية</label>
                                <textarea class="form-control"

                                          name="advice_en"> {{$row->advice ? $row->advice['ar'] : ''}} </textarea>
                                @if ($errors->has('advice_ar'))
                                    <small class="text-danger">{{ $errors->first('advice_ar') }}</small>
                                @endif
                            </div>




                            <div class="form-group">
                                <label for="exampleInputEmail1"> تنببه  بالعربية</label>
                                <textarea class="form-control"

                                          name="alert_ar">{{$row->alert ? $row->alert['en'] : ''}} </textarea>
                                @if ($errors->has('alert_ar'))
                                    <small class="text-danger">{{ $errors->first('alert_ar') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">تنببه  بالانجليزية</label>
                                <textarea class="form-control"

                                          name="alert_en">  {{$row->alert ? $row->alert['ar'] : ''}}</textarea>
                                @if ($errors->has('alert_en'))
                                    <small class="text-danger">{{ $errors->first('alert_en') }}</small>
                                @endif
                            </div>




                            <div class="form-group">
                                <label for="exampleInputEmail1"> هاي لابت  بالعربية</label>
                                <textarea class="form-control"

                                          name="high_light_ar">{{$row->high_light ? $row->high_light['ar'] : ''}} </textarea>
                                @if ($errors->has('high_light_ar'))
                                    <small class="text-danger">{{ $errors->first('high_light_ar') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">هاي لابت  بالانجليزية</label>
                                <textarea class="form-control"

                                          name="alert_en">  {{$row->high_light ? $row->high_light['en'] : ''}}</textarea>
                                @if ($errors->has('high_light'))
                                    <small class="text-danger">{{ $errors->first('high_light') }}</small>
                                @endif
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">صورة </h4>
                                        <input type="file" name="image" class="dropify"
                                               data-default-file="{{$row->image}}" data-height="300"/>
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('image'))
                                    <small class="text-danger">{{ $errors->first('image') }}</small>
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

