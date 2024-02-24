@extends('admin.layout.master')
@section('title', 'صفحات الموقع')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">صفحات الموقع</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">اضافه البيانات</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('seo-pages.store')}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">رابط الصفحه</h4>
                                        <input type="text" name="uri" id="uri" class="form-control" value="">
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('uri'))
                                    <small class="text-danger">{{ $errors->first('uri') }}</small>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">عنوان رأس الصفحه بالعربيه</h4>
                                        <input type="text" name="ar_h1_header" id="ar_h1_header" class="form-control" value="">
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('ar_h1_header'))
                                    <small class="text-danger">{{ $errors->first('ar_h1_header') }}</small>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">عنوان رأس الصفحه بالانجليزيه</h4>
                                        <input type="text" name="en_h1_header" id="en_h1_header" class="form-control" value="">
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('en_h1_header'))
                                    <small class="text-danger">{{ $errors->first('en_h1_header') }}</small>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">عنوان الصفحه بالعربيه</h4>
                                        <input type="text" name="ar_title" id="ar_title" class="form-control" value="">
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('ar_title'))
                                    <small class="text-danger">{{ $errors->first('ar_title') }}</small>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">عنوان الصفحه بالانجليزيه</h4>
                                        <input type="text" name="en_title" id="en_title" class="form-control" value="">
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('en_title'))
                                    <small class="text-danger">{{ $errors->first('en_title') }}</small>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">وصف الصفحه بالعربيه</h4>
                                        <textarea name="ar_description" id="" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('ar_description'))
                                    <small class="text-danger">{{ $errors->first('ar_description') }}</small>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">وصف الصفحه بالانجليزيه</h4>
                                        <textarea name="en_description" id="" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('en_description'))
                                    <small class="text-danger">{{ $errors->first('en_description') }}</small>
                                @endif
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">محرر النصوص العربي</h4>
                                        <textarea name="ar_editor_section" id="" cols="30" rows="10" class="editor form-control"></textarea>
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('ar_editor_section'))
                                    <small class="text-danger">{{ $errors->first('ar_editor_section') }}</small>
                                @endif
                            </div>


                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box">
                                        <h4 class="header-title mb-4">محرر النصوص الانجليزي</h4>
                                        <textarea name="en_editor_section" id="" cols="30" rows="10" class="editor form-control"></textarea>
                                    </div>
                                </div><!-- end col -->
                                @if ($errors->has('en_editor_section'))
                                    <small class="text-danger">{{ $errors->first('en_editor_section') }}</small>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h4  class="header-title mb-4">البانر المتغير</h4>
                                    <input type="file" name="banner" id="banner" class="form-control">
                                </div>
                                @if ($errors->has('banner'))
                                    <small class="text-danger">{{ $errors->first('banner') }}</small>
                                @endif
                            </div>


                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </form>
                    </div><!-- end col -->


                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        $('.editor').map(function (i, el) {
            console.log(el);
            ClassicEditor
                .create(el)
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@stop

