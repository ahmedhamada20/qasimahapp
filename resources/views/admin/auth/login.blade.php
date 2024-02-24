<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>تسجيل الدخول</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('logo.png')}}">

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet"/>
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" id="app-stylesheet"/>

</head>

<body class="authentication-bg">
@include('sweetalert::alert')

<div class="account-pages pt-5 my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="account-card-box">
                    <div class="card mb-0">
                        <div class="card-body p-4">

                            <div class="text-center">
                                <div class="my-3">
                                    <a href="#">
                                        <span><img src="{{asset('logo.png')}}" alt=""  style="height: 104px;"></span>
                                    </a>
                                </div>
                                <h5 class="text-muted text-uppercase py-3 font-16">تسجيل الدخول</h5>
                            </div>

                            <form action="{{route('authenticate')}}" method="post" class="mt-2">
                                @csrf
                                @if(Session::has('error'))
                                    <p class="alert alert-danger" style="text-align: center"><b>{{ Session::get('error') }}</b></p>
                                @endif
                                <div class="form-group mb-3">
                                    <input class="form-control" name="email" value="{{old('email')}}" type="email"
                                           required
                                           placeholder="البريد الألكتروني">
                                </div>

                                <div class="form-group mb-3">
                                    <input class="form-control" name="password" type="password" required id="password"
                                           placeholder="الرقم السري">
                                </div>

                                <div class="form-group mb-3">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-signin"
                                               checked>
                                        <label class="custom-control-label" for="checkbox-signin">تذكرنى</label>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <button class="btn btn-success btn-block waves-effect waves-light" type="submit">
                                        تسجيل الدخول
                                    </button>
                                </div>


                            </form>


                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>


                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<!-- Vendor js -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('assets/js/app.min.js')}}"></script>

</body>
</html>
