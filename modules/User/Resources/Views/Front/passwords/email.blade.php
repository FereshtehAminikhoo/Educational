@extends('User::Front.master')
@section('content')
    <form action="{{route('password.sendVerifyCodeEmail')}}" class="form" method="get">
        <a class="account-logo" href="/">
            <img src="/img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{session('status')}}
                </div>
            @endif

            <input type="email" class="txt-l txt @error('email') is-invalid @enderror" placeholder="ایمیل"
                   name="email" value="{{old('email')}}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
            @enderror
            <br>
            <button class="btn btn-recoverpass" type="submit">بازیابی</button>
        </div>
        <div class="form-footer">
            <a href="{{route('login')}}">صفحه ورود</a>
        </div>
    </form>
@endsection
