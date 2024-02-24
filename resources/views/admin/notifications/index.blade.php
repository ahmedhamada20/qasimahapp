@extends('admin.layout.master')
@section('title', 'الإشعارات')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">الإشعارات</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <h4 class="header-title mb-4">الإشعارات</h4>
                @include('admin.layout.message')

                <div class="row">
                    <div class="col-xl-12">
                        <form method="post" action="{{route('notifications.store')}}"
                              enctype="multipart/form-data">
                            @csrf


                            <div class="row">

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">العنوان باللغه العربية</label>
                                    <input type="text" name="title_ar" required value="{{old('title_ar')}}"
                                           class="form-control">
                                    @if ($errors->has('title_ar'))
                                        <small class="text-danger">{{ $errors->first('title_ar') }}</small>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">العنوان باللغه الإنجليزية</label>
                                    <input type="text" name="title_en" required value="{{old('title_en')}}"
                                           class="form-control">
                                    @if ($errors->has('title_en'))
                                        <small class="text-danger">{{ $errors->first('title_en') }}</small>
                                    @endif
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">المحتوي باللغه العربية</label>
                                    <textarea name="body_ar" class="form-control" required
                                              placeholder="المحتوي باللغه العربية">{{old('body_ar')}}</textarea>
                                    @if ($errors->has('body_ar'))
                                        <small class="text-danger">{{ $errors->first('body_ar') }}</small>
                                    @endif
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">المحتوي باللغه الإنجليزية</label>
                                    <textarea name="body_en" class="form-control" required
                                              placeholder="المحتوي باللغه الإنجليزية">{{old('body_en')}}</textarea>
                                    @if ($errors->has('body_en'))
                                        <small class="text-danger">{{ $errors->first('body_en') }}</small>
                                    @endif
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="url_type">نوع الرابط</label>
                                    <select name="url_type" id="url_type" class="form-control">
                                        <option value="">اختر نوع</option>
                                        <option value="internal">اعلان</option>
                                        <option value="external">خارجي</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="external_url_value">الرابط الخارجي</label>
                                    <input type="url" name="external_url_value" id="external_url_value" class="form-control">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="internal_url_value">الرابط الداخلي</label>
                                    <select name="internal_url_value" id="internal_url_value" class="form-control select2">
                                        <option value="">اختر اعلان</option>
                                        @foreach($ads as $ad)
                                            <option value="{{$ad->id}}">{{json_decode($ad->title)->ar}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="image">الصورة</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="user_id">المستخدم</label>
                                    <input type="text" class="form-control search" data-users="{{$users}}" />
                                    <select id="user_id" class="form-control" multiple>
                                        <option value="all" onclick="userIdElemClick(event)">الكل</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" onclick="userIdElemClickن (event)">{{$user->email}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <br><br><br>
                                    <div id="selected_user_inputs"></div>
                                    <select id="selected_users" class="form-control" multiple>
                                    </select>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

    var selectedUsersElem = $('#selected_users');
    var userIdElem = $('#user_id');
    var selectedUserInputs = $('#selected_user_inputs');
    var selectedUsers = [];

    $('.search').on('keyup',function(){
        var users = $(this).data('users');

        var value = $(this).val().toLowerCase();

        userIdElem.empty();

        var filteredUsers = users.map(user=>{
            var exists = (user.name||"").toLowerCase().indexOf(value) > -1;

            if(exists){
                userIdElem.append(`<option onclick="userIdElemClick(event)" value="${user.id}">${user.name}</option>`);
            }
        });


    });

    // userIdElem.find('option').click(function(){

    // });

    function userIdElemClick(event) {

        var elem = $(event.currentTarget);

        var user = {
            name : elem.text(),
            id : elem.val()
        };

        selectedUsers.push(user);

        elem.remove();

        selectedUserInputs.empty();
        selectedUsersElem.empty();


        selectedUsers.map(function(user){
            selectedUsersElem.append(`<option onclick="selectedUsersElemClick(event)" value="${user.id}">${user.name}</option>`);
            selectedUserInputs.append(`<input type="hidden" name="user_id[]" value="${user.id}" />`);
        });
    }

    function selectedUsersElemClick(event) {

        var elem = $(event.currentTarget);

        // Remove From selectedUsers
        var _user = {
            name : elem.text(),
            id : elem.val()
        };


        selectedUsers = selectedUsers.filter(user=>{
            return user.id != _user.id
        });

        elem.remove();

        selectedUserInputs.empty();
        selectedUsersElem.empty();

        userIdElem.append(`<option onclick="userIdElemClick(event)" value="${_user.id}">${_user.name}</option>`);

        selectedUsers.map(function(user){
            selectedUsersElem.append(`<option onclick="selectedUsersElemClick(event)" value="${user.id}">${user.name}</option>`);
            selectedUserInputs.append(`<input type="hidden" name="user_id[]" value="${user.id}" />`);
        });
    }

    // selectedUsersElem.find('option').click(function(){



    // });

</script>

@stop
