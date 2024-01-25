@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="اطلاعات کاربری">اطلاعات کاربری</a></li>
    <li><a href="#" title="پروفایل کاربر">پروفایل کاربر</a></li>
@endsection
@section('content')
    <div class="row no-gutters margin-bottom-20 ">
        <div class="col-12 bg-white">
            <p class="box__title">پروفایل کاربر</p>
            <x-user-photo></x-user-photo>
            <form action="{{route('users.profile')}}" method="post" class="padding-30">
                @csrf
                <x-input type="text" name="name" placeholder="نام کاربر" required value="{{auth()->user()->name}}"></x-input>

                <x-input type="text" name="email" class="text-left" placeholder="ایمیل" required value="{{auth()->user()->email}}"></x-input>

                <x-input type="number" name="mobile" class="text-left" placeholder="شماره موبایل" required value="{{auth()->user()->mobile}}"></x-input>

                <x-input type="text" name="card_number" class="text-left" placeholder="شماره کارت بانکی" value="{{auth()->user()->card_number}}"></x-input>

                <x-input type="text" name="shaba" class="text-left" placeholder="شماره شبا بانکی" value="{{auth()->user()->shaba}}"></x-input>

                <x-input type="text" name="username" class="text-left" placeholder="نام کاربری و آدرس پروفایل" value="{{auth()->user()->username}}"></x-input>
                <p class="input-help text-left margin-bottom-12" dir="ltr">
                    {{auth()->user()->profilePath()}}
                    <a href="{{auth()->user()->profilePath()}}">{{auth()->user()->username}}</a>
                </p>

                <x-input type="text" name="headline" placeholder="عنوان" value="{{auth()->user()->headline}}"></x-input>

                <x-input type="text" name="telegram" class="text-left" placeholder="تلگرام" value="{{auth()->user()->telegram}}"></x-input>

                <x-input type="password" name="password" placeholder="رمز عبور" value=""></x-input>
                <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                    غیر الفبا مانند <strong>!@#$%^&*()</strong> باشد.</p>

                @can(\RolePermissions\Models\Permission::PERMISSION_TEACH)
                <x-textarea name="bio" placeholder="بیو" value="{{auth()->user()->bio}}"></x-textarea>
                @endcan

                <br>
                <button class="btn btn-webamooz_net">بروزرسانی پروفایل</button>
            </form>
        </div>
    </div>
@endsection

{{--@section('js')--}}
{{--    <script src="/panel/js/tagsInput.js"></script>--}}
{{--    <script>--}}
{{--        @include('Common::layouts.feedbacks')--}}
{{--    </script>--}}
{{--@endsection--}}
