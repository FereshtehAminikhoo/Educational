<?php

namespace Front\Providers;

use Category\Repositories\CategoryRepo;
use Course\Repositories\CourseRepo;
use Illuminate\Support\ServiceProvider;

class FrontServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/front_routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Front');

        view()->composer('Front::layout.header', function($view){
            $categories = (new CategoryRepo())->tree();
            $view->with(compact('categories'));
        });

        view()->composer('Front::layout.latestCourses', function($view){
            $latestCourses = (new CourseRepo())->latestCourses();
            $view->with(compact('latestCourses'));
        });
    }


    public function boot()
    {

    }
}
