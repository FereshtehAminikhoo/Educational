<?php

namespace Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Common\Responses\AjaxResponses;
use Course\Http\Requests\LessonRequest;
use Course\Models\Lesson;
use Course\Repositories\CourseRepo;
use Course\Repositories\LessonRepo;
use Course\Repositories\SeasonRepo;
use Illuminate\Http\Request;
use Media\Services\MediaFileService;

class LessonController extends Controller
{
    private $repository;
    private $repository_season;
    private $repository_course;

    public function __construct(LessonRepo $lessonRepo, SeasonRepo $seasonRepo, CourseRepo $courseRepo)
    {
        $this->repository = $lessonRepo;
        $this->repository_season = $seasonRepo;
        $this->repository_course = $courseRepo;
    }




    public function create($courseId)
    {
        $seasons = $this->repository_season->getCourseSeasons($courseId);
        $course = $this->repository_course->findById($courseId);
        return view('Courses::lessons.create', compact('seasons', 'course'));
    }

    public function store($courseId, LessonRequest $request)
    {
        $request->request->add(['media_id' => MediaFileService::privateUpload($request->file('lesson_file'))->id]);
        $this->repository->store($courseId, $request);
        newFeedback();
        return redirect(route('courses.details', $courseId));
    }

    public function destroy($courseId, $lessonId)
    {
        $lesson = $this->repository->findById($lessonId);
        if($lesson->media){
            $lesson->media->delete();
        }
        $lesson->delete();
        return AjaxResponses::SuccessResponse();
    }

    public function accept($lessonId)
    {
        if($this->repository->updateConfirmationStatus($lessonId, Lesson::CONFIRMATION_STATUS_ACCEPTED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailResponse();
    }

    public function reject($lessonId)
    {
        if($this->repository->updateConfirmationStatus($lessonId, Lesson::CONFIRMATION_STATUS_REJECTED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailResponse();
    }

    public function lock($lessonId)
    {
        if($this->repository->updateStatus($lessonId, Lesson::STATUS_LOCKED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailResponse();
    }

    public function unlock($lessonId)
    {
        if($this->repository->updateStatus($lessonId, Lesson::STATUS_OPENED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailResponse();
    }

    public function destroyMultiple(Request $request)
    {
        $ids = explode(',', $request->ids);
        foreach($ids as $id){
            $lesson = $this->repository->findById($id);
            if($lesson->media){
                $lesson->media->delete();
            }
            $lesson->delete();
        }
        newFeedback();
        return back();
    }
}
