@extends('admin.layout.master')
@section('title', 'التصنيفات')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">التصنيفات</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">تعديل البيانات</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('categories.update',$row->id)}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم بالعربية</label>
                                <input type="text" class="form-control" required value="{{$row->name['ar']}}"
                                       name="name_ar"
                                       id="exampleInputEmail1"
                                       placeholder="الاسم بالعربية">
                                @if ($errors->has('name_ar'))
                                    <small class="text-danger">{{ $errors->first('name_ar') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم بالانجليزية</label>
                                <input type="text" class="form-control" required value="{{$row->name['en']}}"
                                       name="name_en"
                                       id="exampleInputEmail1"
                                       placeholder="الاسم بالانجليزية">
                                @if ($errors->has('name_en'))
                                    <small class="text-danger">{{ $errors->first('name_en') }}</small>
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


                             <br>

                            <div class="row">
                                <div class="col">
                                     <label>الصوره الاساسيه للتصنيف</label>
                                    <input type="file" name="photo" accept="image/*" class="form-control" onchange="loadFile(event)"    >
                                    <img id="output" width="100px" height="100px"/>
                                    @if($row->photo)
                                    <div class="img-wrap">
                                        <span onclick="deleteImg('{{$row->id}}')">x</span>
                                        <img src="{{ asset('dash/category/' . $row->photo) }}" width="100px" height="100px" alt="">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </form>
                    </div><!-- end col -->


                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>

@stop


@section('scripts')

<style>
    .img-wrap {
        position : relative;
        width:70px;
        height : 70px;
    }
    .img-wrap span {
        position : absolute;
        top : 2px;
        left:2px;
        font-size : 20px;
        cursor : pointer;
        color : red;
        font-weight : bolder;
    }
    .img-wrap img {
        width : 100%;
    }
</style>

     <script>

        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

        function deleteImg(categoryId) {
            window.location.href = '/admin/delete-category-image/' + categoryId;
        }
    </script>

@stop


