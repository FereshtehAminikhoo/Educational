<?php

namespace Course\Repositories;

use Course\Models\Lesson;
use Illuminate\Support\Str;


class LessonRepo
{
    public function store($courseId, $values)
    {
        return Lesson::create([
            'title' => $values->title,
            'slug' => $values->slug ?  Str::slug($values->slug) : Str::slug($values->title),
            'time' => $values->time,
            'number' => $this->generateNumber($values->number, $courseId),
            'season_id' => $values->season_id,
            'is_free' => $values->is_free,
            'media_id' => $values->media_id,
            'course_id' => $courseId,
            'user_id' => auth()->id(),
            'body' => $values->body,
            'confirmation_status' => Lesson::CONFIRMATION_STATUS_PENDING,
            'status' => Lesson::STATUS_OPENED,
        ]);
    }

    public function paginate()
    {
        return Lesson::orderBy('number')->paginate();
    }

    public function findById($id)
    {
        return Lesson::findOrFail($id);
    }

    public function update($id, $values)
    {
        return Lesson::where('id', $id)->update([
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'number' => $values->number,
            'price' => $values->price,
            'percent' => $values->percent,
            'teacher_id' => $values->teacher_id,
            'type' => $values->type,
            'status' => $values->status,
            'category_id' => $values->category_id,
            'banner_id' => $values->banner_id,
            'body' => $values->body,
        ]);
    }

    public function updateConfirmationStatus($id, string $status)
    {
        return Lesson::where('id', $id)->update(['confirmation_status' => $status]);
    }

    public function updateStatus($id, string $status)
    {
        return Lesson::where('id', $id)->update(['status' => $status]);
    }




    public function generateNumber($number, $courseId)
    {
        $courseRepo = new CourseRepo();
        if (is_null($number)) {
            $number = $courseRepo->findById($courseId)->lessons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        }

        return $number;
    }

}
