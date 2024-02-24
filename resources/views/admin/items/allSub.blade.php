@extends('admin.layout.master')
@section('title', 'الكوبونات')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">الكوبونات</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                {{--                 @include('admin.layout.message') --}}

                <h4 class="page-title">الكوبونات ::{{$data->title['ar']}}</h4>

                <form action="{{route('changeShowPostSub')}}" class="form" method="post">
                    @csrf

                    <input type="hidden" value="{{$data->id}}" name="id">

                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="show">الحاله</label>
                            <select class="form-control" name="show">
                                <option value="">الكل</option>
                                <option value="1" {{request()->show == '1' ? 'selected' : ''}}>مفعل</option>
                                <option value="0" {{request()->show == '0' ? 'selected' : ''}}>غير مفعل</option>
                            </select>

                        </div>

                    </div>
                    <div class="form-group col-sm-3">
                        <button type="submit" value="بحث" class="btn btn-info pull-left">بحث</button>
                    </div>
                </form>


                <table id="datatable" class="table table-bordered dt-responsive nowrap _datatable"
                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr style="font-size: large ; font-family: cairo">
                        <th>#</th>
                        <th>عنوان الكوبون</th>
                        <th>حاله الكوبون</th>
                        <th>الماركة</th>
                        <th>التصنيف</th>
                        <th>الكود</th>
                        <th>نسبة الخصم</th>
                        <th>الرابط</th>
                        <th>عدد الاستخدام</th>
                        <th>اخر استخدام</th>
                        <th>عدد نقرات الرابط</th>
                        <th>عدد نسخ الكوبون</th>

                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>

                        <td>#</td>
                        <td style="color: blue">
                            {{ $data->title ? $data->title['ar'] : '' }}
                        </td>

                        <td>{{ $data->show  == 1 ? 'مقعل' : 'غير مفعل' }}</td>
                        {{--                            <td>{{$row->store_affiliate ?? ''}}</td> --}}
                        <td>{{ $data->brand ? $data->brand->name['ar'] : 'تم حذف الماركة' }}</td>
                        <td>{{ $data->category ? $data->category->name['en'] : 'تم حذف القسم' }}</td>

                        <td>{{ $data->discount_code }}</td>
                        <td>{{ $data->discount_percent }}</td>
                        <td>
                            <a href="{{$data->url}}">
                                {{ \Str::limit($data->url,100) }}
                            </a>
                        </td>
                        <td>{{ $data->used_count }}</td>
                        <td>{{ $data->last_used }}</td>
                        <td>{{ $data->click_count }}</td>
                        <td>{{ $data->copy_count }}</td>
                            <td>

                            </td>
                    </tr>

                    <?php
                    $i = 1;
                    ?>
                    @foreach ($rows as $row)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $row->title ? $row->title['ar'] : '' }}</td>
                            <td>{{ $row->show  == 1 ? 'مقعل' : 'غير مفعل' }}</td>
                            <td>{{ $row->brand ? $row->brand->name['ar'] : 'تم حذف الماركة' }}</td>
                            <td>{{ $row->category ? $row->category->name['en'] : 'تم حذف القسم' }}</td>

                            <td>{{ $row->discount_code }}</td>
                            <td>{{ $row->discount_percent }}</td>
                            <td>
                                <a href="{{$row->url}}">
                                    {{ \Str::limit($row->url,100) }}
                                </a>
                            </td>

                            <td>{{ $row->used_count }}</td>
                            <td>{{ $row->last_used }}</td>
                            <td>{{ $row->click_count }}</td>
                            <td>{{ $row->copy_count }}</td>

                            <td>
                                <a href="{{ route('editSub',$row->id) }}">
                                    <button type="button" class="btn btn-info waves-effect waves-light">تعديل
                                    </button>
                                </a>

                                <button type="button" class="btn btn-danger waves-effect waves-light"
                                        data-toggle="modal" data-target="#myModal{{ $row->id }}">حذف
                                </button>

                            </td>

                        </tr>
                            <?php
                            $i++;
                            ?>
                        <div id="myModal{{ $row->id }}" class="modal fade" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel">حذف العنصر</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="font-16">هل تريد الحذف ؟</h5>

                                    </div>
                                    <div class="modal-footer">

                                        <form method="post" enctype="multipart/form-data"
                                              action="{{ route('destroySub') }}">
                                            @csrf

                                            <input type="hidden" value="{{$row->id}}" name="id">
                                            <button type="button" class="btn btn-light waves-effect"
                                                    data-dismiss="modal">إلغاء
                                            </button>
                                            <button type="submit" class="btn btn-danger waves-effect waves-light">حذف
                                            </button>
                                        </form>


                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end row -->

    <script>
        function showBtnClickSub(event, id) {
            var checed = event.target.checked == true ? 1 : 0;

            $.ajax({
                url: '/admin/change-item-show-sub/' + id,
                method: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    show: checed
                },
            });
        }
    </script>

@stop
