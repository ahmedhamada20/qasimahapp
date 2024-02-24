@extends('admin.layout.master')
@section('title', 'مستخدمين الموقع')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">مستخدمين الموقع</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">إنشاء جديد</h4>

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('users.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">الإسم</label>
                                <input type="text" class="form-control" required value="{{old('name')}}" name="name"
                                       id="exampleInputEmail1"
                                       placeholder="الإسم">
                                @if ($errors->has('name'))
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">البريد الألكترونى</label>
                                <input type="email" class="form-control" required value="{{old('email')}}" name="email"
                                       id="exampleInputEmail1"
                                       placeholder="البريد الألكترونى">
                                @if ($errors->has('email'))
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">كلمة المرور</label>
                                <input name="password" type="password" class="form-control"
                                       id="exampleInputPassword1" placeholder="كلمة المرور"
                                       value="{{old('password')}}" required>
                            </div>
                            @if ($errors->has('password'))
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            @endif
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
