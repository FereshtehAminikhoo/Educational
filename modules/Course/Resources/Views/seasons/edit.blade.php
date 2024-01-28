@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.details', $season->course_id)}}" title="سرفصل ها">سرفصل ها</a></li>
    <li><a href="#" title="ویرایش سرفصل">ویرایش سرفصل</a></li>
@endsection
@section('content')
    <div class="row no-gutters ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی سرفصل</p>
            <form action="{{route('seasons.update', $season->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input type="text" name="title" placeholder="عنوان سرفصل" class="text" required value="{{$season->title}}"></x-input>
                <x-input type="text" name="number" placeholder="شماره سرفصل" class="text" value="{{$season->number}}"></x-input>
                <br>
                <button class="btn btn-webamooz_net">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection



