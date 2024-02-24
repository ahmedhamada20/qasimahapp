@extends('admin.layout.master')
@section('title', 'رساله الخطأ')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">رساله الخطأ</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">رساله الخطأ</h4>
                @include('admin.layout.message')

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('errorApi.store')}}"
                              enctype="multipart/form-data">
                            @csrf


                            <input type="hidden" value="{{$data->id ?? null}}" name="id">

                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">العنوان باللغه العربية</label>
                                    <input type="text" name="notes_ar" required value="{{ old('notes_ar') ?? ($data ? ($data->notes['ar'] ?? '') : '') }}"
                                           class="form-control">
                                    @if ($errors->has('notes_ar'))
                                        <small class="text-danger">{{ $errors->first('notes_ar') }}</small>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">العنوان باللغه الإنجليزية</label>
                                    <input type="text" name="notes_en" required value="{{ old('notes_en') ?? ($data ? ($data->notes['en'] ?? '') : '') }}"
                                           class="form-control">
                                    @if ($errors->has('notes_en'))
                                        <small class="text-danger">{{ $errors->first('notes_en') }}</small>
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-primary">إرسال</button>
                            </div>
                        </form>
                    </div><!-- end col -->


                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>

@stop
