<?php

namespace Course\Repositories;

use Course\Models\Lesson;
use Illuminate\Support\Str;


class LessonRepo
{
    public function store($values)
    {
        return Lesson::create([
            'title' => $values->title,
            'slug' => $values->slug,
            'time' => $values->time,
            'number' => $values->number,
            'season_id' => $values->season_id,
            'free' => $values->free,
            'media_id' => $values->media_id,
            'body' => $values->body,
            'confirmation_status' => Lesson::CONFIRMATION_STATUS_PENDING,
            'status' => Lesson::STATUS_OPENED,
        ]);
    }

    public function paginate()
    {
        return Lesson::paginate();
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
        return Lesson::where('id', $id)->update(['confirmation_status' => $status]);
    }

    public function updateStatus($id, string $status)
    {
        return Lesson::where('id', $id)->update(['status' => $status]);
    }

}
