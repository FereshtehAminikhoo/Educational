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
}
