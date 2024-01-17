@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('role-permissions.index')}}" title="نقش های کاربری">نقش های کاربری</a></li>
    <li><a href="#" title="ویرایش نقش کاربری">ویرایش نقش کاربری</a></li>
@endsection
@section('content')
    <div class="row no-gutters ">
        <div class="col-6 bg-white">
            <p class="box__title">بروزرسانی نقش کاربری</p>
            <form action="{{route('role-permissions.update', $role->id)}}" method="post" class="padding-30">
                @csrf
                @method('patch')
                <input type="text" name="name" required placeholder="عنوان" class="text" value="{{old('name', $role->name)}}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
                </span>
                @enderror

                <p class="box__title margin-bottom-15">انتخاب مجوزها</p>
                @foreach($permissions as $permission)
                    <label class="ui-checkbox pt-1">
                        <input type="checkbox" name="permissions[{{$permission->name}}]" class="sub-checkbox" data-id="2" value="{{$permission->name}}"
                               @if($role->hasPermissionTo($permission->name)) checked @endif>
                        <span class="checkmark"></span>
                        @lang($permission->name)
                    </label>
                @endforeach
                @error('permissions')
                <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
                </span>
                @enderror

                <button class="btn btn-webamooz_net mt-2">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection
