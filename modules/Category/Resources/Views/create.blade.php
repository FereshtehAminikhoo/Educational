<p class="box__title">ایجاد دسته بندی جدید</p>
<form action="{{route('categories.store')}}" method="post" class="padding-30">
    @csrf
    <input type="text" name="title" required placeholder="نام دسته بندی" class="text">
    @error('title')
    <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
    </span>
    @enderror

    <input type="text" name="slug" required placeholder="نام انگلیسی دسته بندی" class="text">
    @error('slug')
    <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
    </span>
    @enderror

    <p class="box__title margin-bottom-15">انتخاب دسته والد</p>
    <select name="parent_id" id="parent_id">
        <option value="">ندارد</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->title}}</option>
        @endforeach
    </select>
    @error('parent_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
    </span>
    @enderror

    <button class="btn btn-webamooz_net">اضافه کردن</button>
</form>
