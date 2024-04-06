<?php

namespace Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Course\Repositories\CourseRepo;
use Illuminate\Support\Str;

class FrontController extends Controller
{
    private $repository_course;
    public function __construct(CourseRepo $courseRepo)
    {
        $this->repository_course = $courseRepo;
    }


    public function index()
    {
        return view('Front::index');
    }

    public function singleCourse($slug)
    {
        $courseId =  Str::before(Str::after($slug, 'c-'), '-');
        $course = $this->repository_course->findById($courseId);
        return view('Front::singleCourse', compact('course'));
    }
}
