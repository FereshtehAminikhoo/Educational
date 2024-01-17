<?php

namespace Course\Providers;

use Course\Database\Seeds\RolePermissionTableSeeder;
use Course\Models\Course;
use Course\Policies\CoursePolicy;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/courses_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Courses');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        DatabaseSeeder::$seeders[] = RolePermissionTableSeeder::class;
        Gate::policy(Course::class, CoursePolicy::class);
    }


    public function boot()
    {
        config()->set('sidebar.items.courses', [
            "icon" => "i-courses",
            "title" => "دوره ها",
            "url" => route('courses.index'),
        ]);
    }

}
