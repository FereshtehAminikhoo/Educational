<?php

namespace Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Course\Http\Requests\SeasonRequest;
use Course\Repositories\SeasonRepo;

class SeasonController extends Controller
{
    private $repository;

    public function __construct(SeasonRepo $seasonRepo)
    {
        $this->repository = $seasonRepo;
    }


    public function store(SeasonRequest $request, $courseId)
    {
        $this->repository->store($request, $courseId);
        newFeedback();
        return back();
    }

    public function edit($seasonId)
    {
        $season = $this->repository->findById($seasonId);
        return view('Courses::seasons.edit', compact('season'));
    }

    public function update($seasonId, SeasonRequest $request)
    {
        $this->repository->update($seasonId, $request);
        // Find the course ID associated with the given season ID
        $courseId = $this->repository->findById($seasonId)->course_id;
        newFeedback();
        return redirect(route('courses.details', ['course' => $courseId]));
    }
}
