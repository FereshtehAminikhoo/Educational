<?php

namespace Course\Repositories;

use Course\Models\Season;


class SeasonRepo
{
    public function store($values, $id)
    {
        return Season::create([
            'course_id' => $id,
            'user_id' => auth()->id(),
            'title' => $values->title,
            'number' => $this->generateNumber($values->number, $id),
            'confirmation_status' => Season::CONFIRMATION_STATUS_PENDING,
        ]);
    }

    public function findById($id)
    {
        return Season::findOrFail($id);
    }

    public function update($id, $values)
    {
        return Season::where('id', $id)->update([
            'title' => $values->title,
            'number' => $this->generateNumber($values->number, $id),
        ]);
    }

    public function updateConfirmationStatus($id, string $status)
    {
        return Season::where('id', $id)->update(['confirmation_status' => $status]);
    }

    public function updateStatus($id, string $status)
    {
        return Season::where('id', $id)->update(['status' => $status]);
    }






    public function generateNumber($number, $courseId)
    {
        $courseRepo = new CourseRepo();
        if (is_null($number)) {
            $number = $courseRepo->findById($courseId)->seasons()->orderBy('number', 'desc')->firstOrNew([])->number ?: 0;
            $number++;
        }

        return $number;
    }

}
