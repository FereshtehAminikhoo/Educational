@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('categories.index')}}" title="دسته بندی ها">دسته بندی ها</a></li>
    <li><a href="#" title="ویرایش دسته بندی">ویرایش دسته بندی</a></li>
@endsection
@section('content')
    <div class="row no-gutters ">
        <div class="col-6 bg-white">
            <p class="box__title">بروزرسانی دسته بندی</p>
            <form action="{{route('categories.update', $category->id)}}" method="post" class="padding-30">
                @csrf
                @method('patch')
                <input type="text" name="title" required placeholder="نام دسته بندی" class="text" value="{{$category->title}}">
                @error('title')
                <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
                </span>
                @enderror

                <input type="text" name="slug" required placeholder="نام انگلیسی دسته بندی" class="text" value="{{$category->slug}}">
                @error('slug')
                <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
                </span>
                @enderror

                <p class="box__title margin-bottom-15">انتخاب دسته والد</p>
                <select name="parent_id" id="parent_id">
                    <option value="">ندارد</option>
                    @foreach($categories as $categoryItem)
                        <option value="{{$categoryItem->id}}" @if($category->parentCategory && $categoryItem->id == $category->parentCategory->id) selected @endif>{{$categoryItem->title}}</option>
                    @endforeach
                </select>
                @error('parent_id')
                <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
                </span>
                @enderror

                <button class="btn btn-webamooz_net">بروزرسانی</button>
            </form>
        </div>
    </div>
@endsection
