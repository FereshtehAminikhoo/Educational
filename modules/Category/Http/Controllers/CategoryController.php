<?php

namespace Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Category\Http\Requests\CategoryRequest;
use Category\Models\Category;
use Category\Repositories\CategoryRepo;
use Common\Responses\AjaxResponses;


class CategoryController extends Controller
{
    /**
     * @var CategoryRepo
     */
    private $repository;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->repository = $categoryRepo;
    }

    public function index()
    {
        $this->authorize('view', Category::class);
        $categories = $this->repository->all();
        return view('Categories::index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->authorize('view', Category::class);
        $this->repository->create($request);
        return back();
    }

    public function edit($categoryId)
    {
        $this->authorize('view', Category::class);
        $category = $this->repository->findById($categoryId);
        $categories = $this->repository->allExceptById($categoryId);
        return view('Categories::edit', compact('categories', 'category'));
    }

    public function update($categoryId, CategoryRequest $request)
    {
        $this->authorize('view', Category::class);
        $this->repository->update($categoryId, $request);
        return redirect(route('categories.index'));
    }

    public function destroy($categoryId)
    {
        $this->authorize('view', Category::class);
        $this->repository->delete($categoryId);
        return AjaxResponses::SuccessResponse();
    }
}
