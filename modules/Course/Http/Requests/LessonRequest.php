<?php

namespace Course\Http\Requests;

use Course\Models\Course;
use Course\Rules\ValidSeason;
use Course\Rules\ValidTeacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Media\Services\MediaFileService;

class LessonRequest extends FormRequest
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
            'slug' => 'nullable|min:3|max:190',
            'number' => 'nullable|numeric',
            'time' => 'required|numeric|min:0|max:255',
            'season_id' => [new ValidSeason()],
            'is_free' => 'required|boolean',
            'lesson_file' => 'required|file|mimes:avi,mkv,mp4,zip,rar',
        ];

        if(request()->method === 'PATCH'){
            $rules['lesson_file'] = 'nullable|file|mimes:' . MediaFileService::getExtensions();
        }

        return $rules;
    }


    public function attributes()
    {
        return [
            'title' => 'عنوان درس',
            'slug' => 'عنوان انگلیسی درس',
            'number' => 'شماره درس',
            'time' => 'مدت زمان درس',
            'season_id' => 'سرفصل',
            'is_free' => 'رایگان',
            'lesson_file' => 'فایل درس',
            'body' => 'توضیحات درس',
        ];
    }
}
