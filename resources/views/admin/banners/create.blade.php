@extends('admin.layout.master')
@section('title', 'البانرات')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">البانرات</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">إنشاء جديد</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('banners.store')}}" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="form-group col-sm-6 col-lg-6">
                                    <label for="exampleInputEmail1">عنوان البانر باللغه العربية</label>
                                    <input type="text" class="form-control" required value="{{old('name_ar')}}"
                                           name="name_ar"
                                           id="exampleInputEmail1"
                                           placeholder="عنوان البانر باللغه العربية">
                                    @if ($errors->has('name_ar'))
                                        <small class="text-danger">{{ $errors->first('name_ar') }}</small>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6 col-lg-6">
                                    <label for="exampleInputEmail1">عنوان البانر باللغه الأنجليزية</label>
                                    <input type="text" class="form-control" required value="{{old('name_en')}}"
                                           name="name_en"
                                           id="exampleInputEmail1"
                                           placeholder="عنوان البانر باللغه الأنجليزية">
                                    @if ($errors->has('name_en'))
                                        <small class="text-danger">{{ $errors->first('name_en') }}</small>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="exampleInputEmail1">الوصف بالعربية</label>
                                <textarea class="form-control"
                                          required   name="notes_ar"> {{old('notes_ar')}} </textarea>
                                @if ($errors->has('notes_ar'))
                                    <small class="text-danger">{{ $errors->first('notes_ar') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">الوصف بالانجليزية</label>
                                <textarea class="form-control"
                                          required        name="notes_en">{{old('notes_en')}}</textarea>
                                @if ($errors->has('notes_en'))
                                    <small class="text-danger">{{ $errors->first('notes_en') }}</small>
                                @endif
                            </div>


                            <div class="row">
                                <div class="form-group col-sm-6 col-lg-4">
                                    <label for="url_type">نوع الرابط</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="" disabled selected>اختر نوع</option>
                                        <option value="advertisement">اعلان</option>
                                        <option value="external">خارجي</option>
                                        <option value="no">لا يوجد</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6 col-lg-4">
                                    <label for="external_url_value">الرابط الخارجي</label>
                                    <input type="url" name="url" id="external_url_value" class="form-control">
                                </div>

                                <div class="form-group col-sm-6 col-lg-4">
                                    <label for="internal_url_value">الرابط الداخلي</label>
                                    <select name="item_id" id="internal_url_value" class="form-control select2">
                                        <option value="">اختر اعلان</option>
                                        @foreach($ads as $ad)
                                            <option value="{{$ad->id}}">{{json_decode($ad->title)->ar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">صورة</h4>
                                        <input type="file" name="image" class="dropify"
                                         required      data-height="300"/>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

@stop

