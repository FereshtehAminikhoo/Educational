@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="کاربران">کاربران</a></li>
@endsection
@section('content')
    <div class="row no-gutters ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">کاربران</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>نقش کاربری</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr role="row" class="">
                        <td><a href="">{{$user->id}}</a></td>
                       <!-- <td width="80"><img src="" alt="" width="80"></td> -->
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><a href="">
                                <ul>
                                    @foreach($user->roles as $userRole)
                                        <li>{{$userRole->name}}</li>
                                    @endforeach
                                    <li><a href="#select-role" rel="modal:open" data-modal onclick="setFormAction({{$user->id}})">افزودن نقش کاربری</a></li>
                                </ul>
                            </a></td>
                        <td>
                            <a href="" onclick="deleteItem(event, '{{route('users.destroy', $user->id)}}')" class="item-delete mlg-15" title="حذف"></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <div id="select-role" class="modal">
                    <form action="{{route('users.addRole', 0)}}" id="select-role-form" method="post">
                        @csrf
                        <select id="" name="role">
                            <option value="">نقش کاربری را انتخاب کنید.</option>
                            @foreach($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>

                        <button class="btn btn-webamooz_net mt-2">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
    <script>
        function setFormAction(userId){
            $("#select-role-form").attr('action', '{{route('users.addRole', 0)}}'.replace('/0/', '/' + userId + '/'));
        }
        @include('Common::layouts.feedbacks')
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css" />
@endsection
