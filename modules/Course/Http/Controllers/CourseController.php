<?php

namespace Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Category\Repositories\CategoryRepo;
use Course\Http\Requests\CourseRequest;
use Course\Models\Course;
use Course\Repositories\CourseRepo;
use Media\Services\MediaFileService;
use Common\Responses\AjaxResponses;
use User\Repositories\UserRepo;

class CourseController extends Controller
{
    /**
     * @var CategoryRepo
     */
    private $repository_user;
    private $repository_category;
    private $repository;

    public function __construct(UserRepo $userRepo,CategoryRepo $categoryRepo, CourseRepo $courseRepo)
    {
        $this->repository_user = $userRepo;
        $this->repository_category = $categoryRepo;
        $this->repository = $courseRepo;
    }


    public function index()
    {
        $this->authorize('view', Course::class);
        $courses = $this->repository->paginate();
        return view('Courses::index', compact('courses'));
    }

    public function create()
    {
        $this->authorize('create', Course::class);
        $teachers = $this->repository_user->getTeachers();
        $categories = $this->repository_category->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }

    public function store(CourseRequest $request)
    {
        $request->request->add(['banner_id' => MediaFileService::upload($request->file('image'))->id]);
        $this->repository->store($request);
        return redirect(route('courses.index'));
    }

    public function edit($courseId)
    {
        $course = $this->repository->findById($courseId);
        $this->authorize('edit', $course);
        $teachers = $this->repository_user->getTeachers();
        $categories = $this->repository_category->all();
        return view('Courses::edit', compact('course', 'teachers', 'categories'));
    }

    public function update($id, CourseRequest $request)
    {
        $course = $this->repository->findById($id);
        $this->authorize('edit', $course);
        if($request->hasFile('image')){
            $request->request->add(['banner_id' => MediaFileService::upload($request->file('image'))->id]);
            if ($course->banner)
                $course->banner->delete();
        }else{
            $request->request->add(['banner_id' => $course->banner_id]);
        }

        $this->repository->update($id, $request);
        return redirect(route('courses.index'));
    }

    public function details($courseId)
    {
        $course = $this->repository->findById($courseId);
        return view('Courses::details', compact('course'));
    }

    public function destroy($courseId)
    {
        $course = $this->repository->findById($courseId);
        $this->authorize('delete', $course);
        if($course->banner){
            $course->banner->delete();
        }
        $course->delete();
        return AjaxResponses::SuccessResponse();
    }

    public function accept($courseId)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if($this->repository->updateConfirmationStatus($courseId, Course::CONFIRMATION_STATUS_ACCEPTED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }

    public function reject($courseId)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if($this->repository->updateConfirmationStatus($courseId, Course::CONFIRMATION_STATUS_REJECTED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }

    public function lock($courseId)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if($this->repository->updateStatus($courseId, Course::STATUS_LOCKED)){
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailResponse();
    }
}
