<?php

namespace Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Common\Responses\AjaxResponses;
use Course\Http\Requests\LessonRequest;
use Course\Models\Course;
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
        $course = $this->repository_course->findById($courseId);
        $this->authorize('createLesson', $course);
        $seasons = $this->repository_season->getCourseSeasons($courseId);
        return view('Courses::lessons.create', compact('seasons', 'course'));
    }

    public function store($courseId, LessonRequest $request)
    {
        $course = $this->repository_course->findById($courseId);
        $this->authorize('createLesson', $course);
        $request->request->add(['media_id' => MediaFileService::privateUpload($request->file('lesson_file'))->id]);
        $this->repository->store($courseId, $request);
        newFeedback();
        return redirect(route('courses.details', $courseId));
    }

    public function edit($courseId, $lessonId)
    {
        $lesson = $this->repository->findById($lessonId);
        $this->authorize('edit', $lesson);
        $seasons = $this->repository_season->getCourseSeasons($courseId);
        $course = $this->repository_course->findById($courseId);
        return view('Courses::lessons.edit', compact('lesson', 'seasons', 'course'));
    }

    public function update($courseId, $lessonId, LessonRequest $request)
    {
        $lesson = $this->repository->findById($lessonId);
        $this->authorize('edit', $lesson);
        if($request->hasFile('lesson_file')){
            if($lesson->media)
                $lesson->media->delete();

            $request->request->add(['media_id' => MediaFileService::privateUpload($request->file('lesson_file'))->id]);
        }else{
            $request->request->add(['media_id' => $lesson->media_id]);
        }
        $this->repository->update($lessonId, $request, $courseId);
        newFeedback();
        return redirect(route('courses.details', $courseId));
    }

    public function destroy($courseId, $lessonId)
    {
        $lesson = $this->repository->findById($lessonId);
        $this->authorize('delete', $lesson);
        if($lesson->media){
            $lesson->media->delete();
        }
        $lesson->delete();
        return AjaxResponses::SuccessResponse();
    }

    public function accept($lessonId)
    {
        $this->authorize('manage', Course::class);
        if($this->repository->updateConfirmationStatus($lessonId, Lesson::CONFIRMATION_STATUS_ACCEPTED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailResponse();
    }

    public function reject($lessonId)
    {
        $this->authorize('manage', Course::class);
        if($this->repository->updateConfirmationStatus($lessonId, Lesson::CONFIRMATION_STATUS_REJECTED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailResponse();
    }

    public function lock($lessonId)
    {
        $this->authorize('manage', Course::class);
        if($this->repository->updateStatus($lessonId, Lesson::STATUS_LOCKED)){
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailResponse();
    }

    public function unlock($lessonId)
    {
        $this->authorize('manage', Course::class);
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
            $this->authorize('delete', $lesson);
            if($lesson->media){
                $lesson->media->delete();
            }
            $lesson->delete();
        }
        newFeedback();
        return back();
    }

    public function acceptAll($courseId)
    {
        $this->authorize('manage', Course::class);
        $this->repository->acceptAll($courseId);
        newFeedback();
        return back();
    }

    public function acceptMultiple(Request $request)
    {
        $this->authorize('manage', Course::class);
        $ids = explode(',', $request->ids);
        $this->repository->updateConfirmationStatus($ids, Lesson::CONFIRMATION_STATUS_ACCEPTED);
        newFeedback();
        return back();
    }

    public function rejectMultiple(Request $request)
    {
        $this->authorize('manage', Course::class);
        $ids = explode(',', $request->ids);
        $this->repository->updateConfirmationStatus($ids, Lesson::CONFIRMATION_STATUS_REJECTED);
        newFeedback();
        return back();
    }
}
