<?php

namespace Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Course\Http\Requests\LessonRequest;
use Course\Repositories\CourseRepo;
use Course\Repositories\LessonRepo;
use Course\Repositories\SeasonRepo;
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
}
