@extends('admin.layout.master')
@section('title', "حاله الكوبونات")
@section('content')



    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">حاله الكوبونات</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                {{--                 @include('admin.layout.message')--}}

                <h4 class="page-title">حاله الكوبونات</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap _datatable"
                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr style="font-size: large ; font-family: cairo">
                        <th>#</th>
                        <th>
                            حذف
                            <input type="checkbox" onclick="deleteAllRecords(event)" id="delete_all">
                        </th>
                        <th>عنوان الكوبون</th>
                        <th>الكود</th>
                        <th>اخر استخدام عير فعال</th>
                        <th>عدد الاستخدامات الغير فعاله</th>
                        <th>عدد الاستخدامات  الفعاله</th>
                        <th>مشاهده</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rows as $key=>$row)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <input type="checkbox"  class="delete_this" data-id="{{$row->id}}">
                            </td>
                            <td>{{$row->title ? $row->title['ar'] : ''}}</td>
                            <td>{{$row->discount_code}}</td>
                            <td style="direction:ltr!important">{{ optional($row->thumbs->where('down',1)->last())->created_at ?? 'لا يوجد' }}</td>
                            <td> {{ $row->thumbs->where('down',1)->count() }} </td>
                            <td> {{ $row->thumbs->where('up',1)->count() }} </td>
                            <td>
                                <button type="button" class="btn btn-info waves-effect waves-light"
                                        data-toggle="modal" onclick="fetchData('{{$row->id}}')" data-target="#thumModal">مشاهده
                                </button>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end row -->

    <button class="btn btn-danger" onclick="deleteSelectedRecords()" >حذف كل المحدد</button>

    <div id="thumModal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title"
                       id="myModalLabel">مشاهده العناصر الفعاله والغير فعاله</h5>
                   <button type="button" class="close" data-dismiss="modal"
                           aria-hidden="true">×
                   </button>
               </div>
               <div class="modal-body">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>الكود</th>
                                <th>المستخدم</th>
                                <th>الحاله</th>
                                <th>التاريخ</th>
                                <th>حذف</th>
                            </tr>
                        </thead>
                        <tbody class="table-body">
                        </tbody>
                    </table>
               </div>
               <div class="modal-footer">

               </div>
           </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
   </div><!-- /.modal -->
   <script>
        function fetchData(id) {
            $.ajax({
                url : `/admin/get-item/${id}`,
                success : data => {
                    var modal = $('#thumModal');

                    var modalBodyHtml = data.thumbs.map(item=>{
                        return `
                            <tr class="record">
                                <td>${data.discount_code}</td>
                                <td>${item?.user?.email ?? item.ip ?? 'غير موجود'}</td>
                                <td>${item.up == 1 ? 'فعال' : 'غير فعال'}</td>
                                <td style="direction:ltr!important">${item.date}</td>
                                <td>
                                    <a href="javascript:" onclick="deleteThis('/admin/delete-item-thumb/${item.id}')" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        `;
                    }).join('');
                    modal.find('.modal-body .table-body').html(modalBodyHtml);

                    var modalFooterHtml = `
                        <a href="javascript:" onclick="deleteAll('/admin/delete-item-thumb/${data.id}/all')" class="btn btn-danger">
                            حذف الكل
                        </a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    `;

                    modal.find('.modal-footer').html(modalFooterHtml);
                }
            });

        }


        function deleteThis(url) {
            $.ajax({
                url,
                method:'get',
                success:function(data){
                    fetchData(data.id);
                    // window.location.reload();
                }
            });
        }

        function deleteAll(url) {
            $.ajax({
                url,
                method:'get',
                success:function(data){
                    fetchData(data.id);
                    window.location.reload();
                }
            });
        }

        function deleteAllRecords(event) {
            $('.delete_this').prop('checked', event.target.checked);
        }

        function deleteSelectedRecords() {
            // delete selected checkbox
            var checked = $('.delete_this:checked');


            if(checked.length == 0){
                alert('لم يتم تحديد اي عنصر');
                return;
            }

            if(confirm('هل انت متاكد من حذف العناصر المحدده')){
                var ids = [];

                checked.each((index, item) => ids.push($(item).data('id')));

                if(ids.length > 0){
                    $.ajax({
                        url : '/admin/delete-selected',
                        method : 'post',
                        data : {
                            _token : '{{ csrf_token() }}',
                            ids
                        },
                        success : data => {
                            window.location.reload();
                        }
                    });
                }
            }

        }

   </script>

@stop
