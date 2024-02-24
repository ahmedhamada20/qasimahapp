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

                <h4 class="header-title mb-4">إنشاء جديد</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('categories.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم بالعربية</label>
                                <input type="text" class="form-control" required value="{{old('name_ar')}}"
                                       name="name_ar"
                                       id="exampleInputEmail1"
                                       placeholder="الاسم بالعربية">
                                @if ($errors->has('name_ar'))
                                    <small class="text-danger">{{ $errors->first('name_ar') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم بالانجليزية</label>
                                <input type="text" class="form-control" required value="{{old('name_en')}}"
                                       name="name_en"
                                       id="exampleInputEmail1"
                                       placeholder="الاسم بالانجليزية">
                                @if ($errors->has('name_en'))
                                    <small class="text-danger">{{ $errors->first('name_en') }}</small>
                                @endif
                            </div>
                            
                            
                             <div class="form-group">
                                <label for="sort_orderInput">الترتيب</label>
                                <input type="text" class="form-control" required value=""
                                       name="sort_order"
                                       id="sort_orderInput"
                                       placeholder="الترتيب">
                                @if ($errors->has('sort_order'))
                                    <small class="text-danger">{{ $errors->first('sort_order') }}</small>
                                @endif
                            </div>
                            
                            
                             <div class="form-group">
                                  <label>الصوره الاساسيه للتصنيف</label>
                                <input type="file" name="photo" accept="image/*" class="form-control" onchange="loadFile(event)"    >
                                    <img id="output" width="100px" height="100px"/>
                                @if ($errors->has('photo'))
                                    <small class="text-danger">{{ $errors->first('photo') }}</small>
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
    
    
     <script>
     
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

@stop
