@extends('admin.layout.master')
@section('title', "صفحات الموقع")
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
                {{--                 @include('admin.layout.message')--}}

                <h4 class="header-title">صفحات الموقع</h4>
                <p class="sub-header">
                    <a href="{{route('seo-pages.create')}}">
                        <button class="btn btn-success">
                            إنشاء جديد
                        </button>
                    </a>
                </p>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr style="font-size: large ; font-family: cairo">
                        <th>#</th>

                        <th>الرابط</th>
                        <th>عنوان رأس الصفحه بالعربيه</th>
                        <th>عنوان رأس الصفحه بالانجليزيه</th>
                        <th>العنوان عربي</th>
                        <th>العنوان انجليزي</th>
                        <th>النوع</th>
                        <th>الرقم التعريفي</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $i=>$row)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$row->uri}}</td>
                            <td>{{$row->h1_header['ar'] ?? ''}}</td>
                            <td>{{$row->h1_header['en'] ?? ''}}</td>
                            <td>{{$row->title['ar'] ?? ''}}</td>
                            <td>{{$row->title['en'] ?? ''}}</td>
                            <td>{{$row->type}}</td>
                            <td>{{$row->model_id}}</td>
                            <td>
                                <a href="{{route('seo-pages.edit',$row->id)}}">
                                    <button class="btn btn-warning">
                                        تعديل
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end row -->



@stop
