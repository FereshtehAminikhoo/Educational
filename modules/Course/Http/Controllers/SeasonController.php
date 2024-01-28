<?php

namespace Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Common\Responses\AjaxResponses;
use Course\Http\Requests\SeasonRequest;
use Course\Models\Season;
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

    public function destroy($seasonId)
    {
        $season = $this->repository->findById($seasonId);
        $season->delete();
        return AjaxResponses::SuccessResponse();
    }

    public function accept($seasonId)
    {
        //$this->authorize('change_confirmation_status', Season::class);
        if($this->repository->updateConfirmationStatus($seasonId, Season::CONFIRMATION_STATUS_ACCEPTED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }

    public function reject($seasonId)
    {
        //$this->authorize('change_confirmation_status', Season::class);
        if($this->repository->updateConfirmationStatus($seasonId, Season::CONFIRMATION_STATUS_REJECTED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }

    public function lock($seasonId)
    {
        //$this->authorize('change_confirmation_status', Season::class);
        if($this->repository->updateStatus($seasonId, Season::STATUS_LOCKED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }

    public function unlock($seasonId)
    {
        //$this->authorize('change_confirmation_status', Season::class);
        if($this->repository->updateStatus($seasonId, Season::STATUS_OPENED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }
}
