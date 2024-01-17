@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره">ویرایش دوره</a></li>
@endsection
@section('content')
    <div class="row no-gutters ">
        <div class="col-12 bg-white">
            <p class="box__title">بروزرسانی دوره</p>
            <form action="{{route('courses.update', $course->id)}}" method="post" class="padding-30" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <x-input type="text" name="title" placeholder="عنوان دوره" required value="{{$course->title}}"></x-input>

                <x-input type="text" name="slug" class="text-left" placeholder="نام انگلیسی دوره" required value="{{$course->slug}}"></x-input>

                <div class="d-flex multi-text">
                    <x-input type="text" name="priority" class="text-left" placeholder="ردیف دوره" value="{{$course->priority}}"></x-input>

                    <x-input type="text" name="price" placeholder="مبلغ دوره" class="text-left" required value="{{$course->price}}"></x-input>

                    <x-input type="number" name="percent" placeholder="درصد مدرس" class="text-left" required value="{{$course->percent}}"></x-input>
                </div>

                <x-select name="teacher_id" required>
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}" @if($teacher->id == $course->teacher_id) selected @endif>{{$teacher->name}}</option>
                    @endforeach
                </x-select>

                <x-tag-select type="text" name="tags"></x-tag-select>

                <x-select name="type" required>
                    <option value="">نوع دوره</option>
                    @foreach(\Course\Models\Course::$types as $type)
                    <option value="{{$type}}" @if($type == $course->type) selected @endif>@lang($type)</option>
                    @endforeach
                </x-select>

                <x-select name="status" required>
                    <option value="">وضعیت دوره</option>
                    @foreach(\Course\Models\Course::$statuses as $status)
                    <option value="{{$status}}" @if($status == $course->status) selected @endif>@lang($status)</option>
                    @endforeach
                </x-select>

                <x-select name="category_id" required>
                    <option value="0">دسته بندی</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($category->id == $course->category_id) selected @endif>{{$category->title}}</option>
                    @endforeach
                </x-select>

                <x-file-upload type="file" name="image" placeholder="آپلود بنر دوره" :value="$course->banner"></x-file-upload>

                <x-textarea name="body" placeholder="توضیحات دوره" value="{{$course->body}}"></x-textarea>

                <br>
                <button class="btn btn-webamooz_net">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="/panel/js/tagsInput.js"></script>
@endsection
