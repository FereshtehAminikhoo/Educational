<?php

namespace Course\Repositories;

use Course\Models\Course;
use Course\Models\Season;
use Illuminate\Support\Str;

class SeasonRepo
{
    public function store($values, $id)
    {
        $courseRepo = new CourseRepo();
        if(is_null($values->number)){
            $number = $courseRepo->findById($id)->seasons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        }else{
            $number = $values->number;
        }

        return Season::create([
            'course_id' => $id,
            'user_id' => auth()->id(),
            'title' => $values->title,
            'number' => $number,
            'confirmation_status' => Season::CONFIRMATION_STATUS_PENDING,
        ]);
    }

    public function findById($id)
    {
        return Course::findOrFail($id);
    }

    public function update($id, $values)
    {
        return Course::where('id', $id)->update([
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'priority' => $values->priority,
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
        return Course::where('id', $id)->update(['confirmation_status' => $status]);
    }

    public function updateStatus($id, string $status)
    {
        return Course::where('id', $id)->update(['status' => $status]);
    }

}
