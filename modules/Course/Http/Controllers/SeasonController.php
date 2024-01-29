<?php

namespace Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Common\Responses\AjaxResponses;
use Course\Http\Requests\SeasonRequest;
use Course\Models\Season;
use Course\Repositories\CourseRepo;
use Course\Repositories\SeasonRepo;

class SeasonController extends Controller
{
    private $repository;
    private $repository_course;

    public function __construct(SeasonRepo $seasonRepo, CourseRepo $courseRepo)
    {
        $this->repository = $seasonRepo;
        $this->repository_course = $courseRepo;
    }


    public function store(SeasonRequest $request, $courseId)
    {
        $course = $this->repository_course->findById($courseId);
        $this->authorize('createSeason', $course);
        $this->repository->store($request, $courseId);
        newFeedback();
        return back();
    }

    public function edit($seasonId)
    {
        $season = $this->repository->findById($seasonId);
        $this->authorize('edit', $season);
        return view('Courses::seasons.edit', compact('season'));
    }

    public function update($seasonId, SeasonRequest $request)
    {
        $season = $this->repository->findById($seasonId);
        $this->authorize('edit', $season);
        $this->repository->update($seasonId, $request);
        // Find the course ID associated with the given season ID
        $courseId = $this->repository->findById($seasonId)->course_id;
        newFeedback();
        return redirect(route('courses.details', ['course' => $courseId]));
    }

    public function destroy($seasonId)
    {
        $season = $this->repository->findById($seasonId);
        $this->authorize('delete', $season);
        $season->delete();
        return AjaxResponses::SuccessResponse();
    }

    public function accept($seasonId)
    {
        $this->authorize('change_confirmation_status', Season::class);
        if($this->repository->updateConfirmationStatus($seasonId, Season::CONFIRMATION_STATUS_ACCEPTED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }

    public function reject($seasonId)
    {
        $this->authorize('change_confirmation_status', Season::class);
        if($this->repository->updateConfirmationStatus($seasonId, Season::CONFIRMATION_STATUS_REJECTED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }

    public function lock($seasonId)
    {
        $this->authorize('change_confirmation_status', Season::class);
        if($this->repository->updateStatus($seasonId, Season::STATUS_LOCKED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }

    public function unlock($seasonId)
    {
        $this->authorize('change_confirmation_status', Season::class);
        if($this->repository->updateStatus($seasonId, Season::STATUS_OPENED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }
}
