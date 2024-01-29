<?php

namespace Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Course\Repositories\SeasonRepo;

class LessonController extends Controller
{
    private $repository_season;

    public function __construct(SeasonRepo $seasonRepo)
    {
        $this->repository_season = $seasonRepo;
    }



    public function create($courseId)
    {
        $seasons = $this->repository_season->getCourseSeasons($courseId);
        return view('Courses::lessons.create', compact('seasons'));
    }
}
