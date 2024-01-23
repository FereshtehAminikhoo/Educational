@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="کاربران">کاربران</a></li>
    <li><a href="#" title="ویرایش کاربر">ویرایش کاربر</a></li>
@endsection
@section('content')
    <div class="row no-gutters ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی کاربر</p>
            <form action="{{route('users.update', $user->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input type="text" name="name" placeholder="نام کاربر" required value="{{$user->name}}"></x-input>

                <x-input type="text" name="email" class="text-left" placeholder="ایمیل" required value="{{$user->email}}"></x-input>

                <x-input type="text" name="username" class="text-left" placeholder="نام کاربری" value="{{$user->username}}"></x-input>

                <x-input type="number" name="mobile" class="text-left" placeholder="شماره موبایل" required value="{{$user->mobile}}"></x-input>

                <x-input type="text" name="headline" class="text-left" placeholder="عنوان" value="{{$user->headline}}"></x-input>

                <x-input type="text" name="website" class="text-left" placeholder="وب سایت" value="{{$user->website}}"></x-input>

                <x-input type="text" name="linkedin" class="text-left" placeholder="لینکداین" value="{{$user->linkedin}}"></x-input>

                <x-input type="text" name="facebook" class="text-left" placeholder="فیسبوک" value="{{$user->facebook}}"></x-input>

                <x-input type="text" name="twitter" class="text-left" placeholder="توییتر" value="{{$user->twitter}}"></x-input>

                <x-input type="text" name="youtube" class="text-left" placeholder="یوتیوب" value="{{$user->youtube}}"></x-input>

                <x-input type="text" name="instagram" class="text-left" placeholder="اینستاگرام" value="{{$user->instagram}}"></x-input>

                <x-input type="text" name="telegram" class="text-left" placeholder="تلگرام" value="{{$user->telegram}}"></x-input>

                <x-select name="status" required>
                    <option value="">وضعیت حساب</option>
                    @foreach(\User\Models\User::$statuses as $status)
                    <option value="{{$status}}" @if($status == $user->status) selected @endif>@lang($status)</option>
                    @endforeach
                </x-select>

                <x-file-upload type="file" name="image" placeholder="عکس پروفایل" :value="$user->image"></x-file-upload>

                <x-input type="password" name="password" placeholder="رمز عبور جدید" value=""></x-input>

                <x-textarea name="bio" placeholder="بیو" value="{{$user->bio}}"></x-textarea>

                <br>
                <button class="btn btn-webamooz_net">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js"></script>
    <script>
        @include('Common::layouts.feedbacks')
    </script>
@endsection
