@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="{{route('courses.details', $course->id)}}" title="{{$course->title}}">{{$course->title}}</a></li>
    <li><a href="#" title="ویرایش درس">ویرایش درس</a></li>
@endsection
@section('content')
    <div class="row no-gutters ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی درس</p>
            <form action="{{route('lessons.update', [$course->id, $lesson->id])}}" method="post" class="padding-30" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input type="text" name="title" placeholder="عنوان درس *" required value="{{$lesson->title}}"></x-input>

                <x-input type="text" name="slug" class="text-left" placeholder="نام انگلیسی درس اختیاری" value="{{$lesson->slug}}"></x-input>

                <x-input type="number" name="time" class="text-left" placeholder="مدت زمان جلسه *" required value="{{$lesson->time}}"></x-input>

                <x-input type="number" name="number" class="text-left" placeholder="شماره جلسه" value="{{$lesson->number}}"></x-input>

                @if(count($seasons))
                    <x-select name="season_id" required>
                        <option value="">انتخاب سرفصل درس *</option>
                        @foreach($seasons as $season)
                            <option value="{{$season->id}}" @if($season->id == $lesson->season_id) selected @endif>{{$season->title}}</option>
                        @endforeach
                    </x-select>
                @endif

                <div class="w-50">
                    <p class="box__title">آیا این درس رایگان است ؟ *</p>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-1" type="radio" name="is_free" value="0"  @if(! $lesson->is_free) checked @endif/>
                        <label for="lesson-upload-field-1">خیر</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-2" type="radio" name="is_free" value="1"  @if($lesson->is_free) checked @endif/>
                        <label for="lesson-upload-field-2">بله</label>
                    </div>
                </div>

                <x-file-upload type="file" name="lesson_file" placeholder="آپلود درس *" :value="$lesson->media"></x-file-upload>

                <x-textarea name="body" placeholder="توضیحات درس" value="{{$lesson->body}}"></x-textarea>

                <br>
                <button class="btn btn-webamooz_net">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection
