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

                <h4 class="header-title mb-4">تعديل البيانات</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('banners.update',$row->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')



                            <div class="row">
                                <div class="form-group col-sm-6 col-lg-6">
                                    <label for="exampleInputEmail1">عنوان البانر باللغه العربية</label>
                                    <input type="text" class="form-control" required value="{{$row->name ? $row->name['ar'] : ''}}"
                                           name="name_ar"
                                           id="exampleInputEmail1"
                                           placeholder="عنوان البانر باللغه العربية">
                                    @if ($errors->has('name_ar'))
                                        <small class="text-danger">{{ $errors->first('name_ar') }}</small>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6 col-lg-6">
                                    <label for="exampleInputEmail1">عنوان البانر باللغه الأنجليزية</label>
                                    <input type="text" class="form-control" required value="{{$row->name ? $row->name['en'] : ''}}"
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
                                          required
                                          name="notes_ar"> {{$row->notes ? $row->notes['ar'] : ''}} </textarea>
                                @if ($errors->has('notes_ar'))
                                    <small class="text-danger">{{ $errors->first('notes_ar') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">الوصف بالانجليزية</label>
                                <textarea class="form-control"
                                          required
                                          name="notes_en"> {{$row->notes ? $row->notes['en'] : ''}} </textarea>
                                @if ($errors->has('notes_en'))
                                    <small class="text-danger">{{ $errors->first('notes_en') }}</small>
                                @endif
                            </div>


                            <div class="row">
                                <div class="form-group col-sm-6 col-lg-4">
                                    <label for="url_type">نوع الرابط</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="" disabled selected>اختر نوع</option>
                                        <option value="advertisement" {{$row->type == "advertisement" ? 'selected': null}}>اعلان</option>
                                        <option value="external" {{$row->type == "external" ? 'selected': null}}>خارجي</option>
                                        <option value="no" {{$row->type == "no" ? 'selected': null}}>لا يوجد</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6 col-lg-4">
                                    <label for="external_url_value">الرابط الخارجي</label>
                                    <input type="url" name="url"  value="{{$row->url}}" id="external_url_value" class="form-control">
                                </div>

                                <div class="form-group col-sm-6 col-lg-4">
                                    <label for="internal_url_value">الرابط الداخلي</label>
                                    <select name="item_id" id="internal_url_value" class="form-control select2">
                                        <option value="">اختر اعلان</option>
                                        @foreach($ads as $ad)
                                            <option value="{{$ad->id}}" {{$ad->id == $row->item_id ? 'selected' : null}}>{{json_decode($ad->title)->ar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">صورة الإعلان</h4>
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

