<?php

namespace Course\Repositories;

use Course\Models\Course;
use Illuminate\Support\Str;

class CourseRepo
{
    public function paginate()
    {
        return Course::paginate(50);
    }

    public function getCoursesByTeacherId(?int $id)
    {
        return Course::where('teacher_id', $id)->get();
    }

    public function store($values)
    {
        return Course::create([
            'title' => $values->title,
            'slug' => Str::slug($values->slug),
            'priority' => $values->priority,
            'price' => $values->price,
            'percent' => $values->percent,
            'teacher_id' => $values->teacher_id,
            'type' => $values->type,
            'status' => $values->status,
            'confirmation_status' => Course::CONFIRMATION_STATUS_PENDING,
            'category_id' => $values->category_id,
            'banner_id' => $values->banner_id,
            'body' => $values->body,
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
