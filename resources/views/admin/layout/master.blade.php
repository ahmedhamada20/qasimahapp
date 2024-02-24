<!DOCTYPE html>
<html lang="ar">
<head>
    <?php $version="1"; ?>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- App favicon -->

    <link rel="shortcut icon" href="{{asset('logo.png')}}">

    <!-- Plugins css -->
    <link href="{{asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet"/>
    <link href="{{asset('assets/libs/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/multiselect/multi-select.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <!-- Table datatable css -->
    <link href="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/custombox/custombox.min.css')}}" rel="stylesheet">






    <link href="{{asset('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/clockpicker/bootstrap-clockpicker.min.css')}}" rel="stylesheet" type="text/css"/>



    <link href="{{asset('assets/libs/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/datatables/select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css"/>
    <script src="https://cdn.ckeditor.com/4.13.0/standard-all/ckeditor.js"></script>
    <!-- Magnific -->
    <link rel="stylesheet" href="{{asset('assets/libs/magnific-popup/magnific-popup.css')}}"/>

    <!-- App css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet"/>

    <!-- TinyMCE -->
    <link rel="stylesheet" href="{{asset('assets/plugin/tinymce/skins/lightgray/skin.min.css')}}">
    <!-- Must include this script FIRST -->
    <script src="{{asset('assets/plugin/tinymce/tinymce.min.js')}}"></script>

    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link href="{{asset('assets/css/custom-style.css')}}" rel="stylesheet" type="text/css" id="app-stylesheet"/>

    @yield('stylesheets')
</head>

<body>

<!-- Begin page -->
<div id="wrapper">


    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">


            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown"
                   href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{asset('logo.png')}}" alt="user-image"
                         class="rounded-circle">
                    <span class="d-none d-sm-inline-block ml-1 font-weight-medium">{{Auth::guard('admin')->user()->email}}</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">

                    <!-- item-->

                    <!-- item-->
                    <a href="{{route('admin_logout')}}" class="dropdown-item notify-item">
                        <i class="mdi mdi-logout-variant"></i>
                        <span>تسجيل خروج</span>
                    </a>
                </div>
            </li>


        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="{{route('admin')}}" class="logo text-center logo-dark">
                        <span class="logo-lg">
                            <img src="{{asset('logo.png')}}" id="logo" width="90">
                            <!-- <span class="logo-lg-text-dark">Uplon</span> -->
                        </span>
                <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">U</span> -->
                            <img src="{{asset('logo.png')}}" id="logo" alt="" width="90">
                        </span>
            </a>

            <a href="#" class="logo text-center logo-light">
                        <span class="logo-lg">
                            <img src="{{asset('logo.png')}}" alt="" width="90">
                            <!-- <span class="logo-lg-text-dark">Uplon</span> -->
                        </span>
                <span class="logo-sm">
                            <!-- <span class="logo-lg-text-dark">U</span> -->
                            <img src="{{asset('logo.png')}}" alt="" height="24">
                        </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>
    </div>
    <!-- end Topbar -->


    <!-- ========== Left Sidebar Start ========== -->
@include('admin.layout.sidebar')
<!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                @yield('content')
                @include('sweetalert::alert')

            </div> <!-- end container-fluid -->

        </div> <!-- end content -->


        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        {{date('Y')}}   &copy; Copy rights by <a href="https://headshot.com.sa/"
                                                             target="_blank">مؤسسة هيدشوت للإتصالات وتقنية المعلومات</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<!-- /Right-bar -->

<!-- Right bar overlay-->

<!-- Vendor js -->
<script src="{{asset('assets/js/vendor.min.js')}}"></script>

<!-- Datatable plugin js -->
<script src="{{asset('assets/libs/datatables/jquery.dataTables.min.js')}}?v={{$version}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.bootstrap4.min.js')}}?v={{$version}}"></script>

<script src="{{asset('assets/libs/datatables/dataTables.responsive.min.js')}}?v={{$version}}"></script>
<script src="{{asset('assets/libs/datatables/responsive.bootstrap4.min.js')}}?v={{$version}}"></script>

<script src="{{asset('assets/libs/datatables/dataTables.buttons.min.js')}}?v={{$version}}"></script>
<script src="{{asset('assets/libs/datatables/buttons.bootstrap4.min.js')}}?v={{$version}}"></script>

<script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/libs/pdfmake/vfs_fonts.js')}}"></script>

<script src="{{asset('assets/libs/datatables/buttons.html5.min.js')}}?v={{$version}}"></script>
<script src="{{asset('assets/libs/datatables/buttons.print.min.js')}}?v={{$version}}"></script>

<script src="{{asset('assets/libs/datatables/dataTables.keyTable.min.js')}}?v={{$version}}"></script>
<script src="{{asset('assets/libs/datatables/dataTables.select.min.js')}}?v={{$version}}"></script>

<!-- Datatables init -->
<script src="{{asset('assets/js/pages/datatables.init.js')}}?v={{$version}}"></script>
<!-- isotope filter plugin -->
<script src="{{asset('assets/libs/isotope/isotope.pkgd.min.js')}}"></script>

<!-- Magnific -->
<script src="{{asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

<!-- Gallery Init-->
<script src="{{asset('assets/js/pages/gallery.init.js')}}"></script>

<!--Morris Chart-->
<script src="{{asset('assets/libs/morris-js/morris.min.js')}}"></script>
<script src="{{asset('assets/libs/raphael/raphael.min.js')}}"></script>

<!-- Dashboard init js-->
<script src="{{asset('assets/js/pages/dashboard.init.js')}}"></script>
<script src="{{asset('assets/libs/custombox/custombox.min.js')}}"></script>

<!-- Plugins Js -->
<script src="{{asset('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('assets/libs/switchery/switchery.min.js')}}"></script>
<script src="{{asset('assets/libs/multiselect/jquery.multi-select.js')}}"></script>
<script src="{{asset('assets/libs/jquery-quicksearch/jquery.quicksearch.min.js')}}"></script>
<script src="{{asset('assets/libs/select2/select2.min.js')}}"></script>



<!-- plugins -->
<script src="{{asset('assets/libs/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('assets/libs/clockpicker/bootstrap-clockpicker.min.js')}}"></script>

{{--<script src="{{asset('assets/libs/jquery-mockjax/jquery.mockjax.min.js')}}"></script>--}}
<script src="{{asset('assets/libs/autocomplete/jquery.autocomplete.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<!-- Plugins js -->
<script src="{{asset('assets/libs/dropify/dropify.min.js')}}"></script>

<!-- Init js-->
<script src="{{asset('assets/js/pages/form-fileuploads.init.js')}}"></script>


<!-- form advanced init -->
<script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>


<!-- TinyMCE -->
<!-- Plugin Files DON'T INCLUDES THESES FILES IF YOU USE IN THE HOST -->
<link rel="stylesheet" href="{{asset('assets/plugin/tinymce/skins/lightgray/skin.min.css')}}">
<script src="{{asset('assets/plugin/tinymce/plugins/advlist/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/anchor/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/autolink/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/autoresize/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/autosave/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/bbcode/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/charmap/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/code/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/codesample/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/colorpicker/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/contextmenu/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/directionality/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/emoticons/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/example/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/example_dependency/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/fullpage/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/fullscreen/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/hr/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/image/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/imagetools/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/importcss/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/insertdatetime/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/layer/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/legacyoutput/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/link/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/lists/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/media/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/nonbreaking/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/noneditable/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/pagebreak/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/paste/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/preview/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/print/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/save/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/searchreplace/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/spellchecker/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/tabfocus/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/table/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/template/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/textcolor/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/textpattern/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/visualblocks/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/visualchars/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/plugins/wordcount/plugin.min.js')}} "></script>
<script src="{{asset('assets/plugin/tinymce/themes/modern/theme.min.js')}}"></script>
<!-- Plugin Files DON'T INCLUDES THESES FILES IF YOU USE IN THE HOST -->


<script src="{{asset('assets/js/tinymce-rtl.init.min.js')}}"></script>


<!-- App js -->
<script src="{{asset('assets/js/app.min.js')}}"></script>


@yield('scripts')

<script>

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<script>

    !function () {
        "use strict";
        tinyMCE.baseURL = "/assets/plugin/tinymce", tinymce.init({
            selector: ".tinymce",
            height: 500,
            directionality: "rtl",
            plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste code"],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            content_css: "assets/plugin/tinymce/content.min.css"
        }), tinymce.init({
            selector: "h2.editable",
            inline: !0,
            directionality: "rtl",
            toolbar: "undo redo",
            menubar: !1
        }), tinymce.init({
            selector: "div.editable",
            inline: !0,
            directionality: "rtl",
            plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        })
    }(jQuery);

</script>
</body>
</html>
