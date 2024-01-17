<?php

namespace Course\Http\Requests;

use Course\Models\Course;
use Course\Rules\ValidTeacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|min:3|max:190',
            'slug' => 'required|min:3|max:190|unique:courses,slug',
            'priority' => 'nullable|numeric',
            'price' => 'required|numeric|min:0|max:10000000',
            'percent' => 'required|numeric|min:0|max:100',
            'teacher_id' => ['required', 'exists:users,id', new ValidTeacher()],
            'category_id' => 'required|exists:categories,id',
            'type' => ['required', Rule::in(Course::$types)],
            'status' => ['required', Rule::in(Course::$statuses)],
            'image' => 'required|mimes:jpg,png,jpeg',

        ];

        if(request()->method === 'PATCH'){
            $rules['slug'] = 'required|min:3|max:190|unique:courses,slug,' . request()->route('course');
            $rules['image'] = 'nullable|mimes:jpg,png,jpeg';
        }

        return $rules;
    }


    public function attributes()
    {
        return [
            'title' => 'عنوان',
            'slug' => 'عنوان انگلیسی',
            'priority' => 'ردیف دوره',
            'price' => 'قیمت',
            'percent' => 'درصد مدرس',
            'teacher_id' => 'مدرس',
            'category_id' => 'دسته بندی',
            'type' => 'نوع',
            'status' => 'وضعیت',
            'image' => 'بنر دوره',
            'body' => 'توضیحات',
        ];
    }
}
