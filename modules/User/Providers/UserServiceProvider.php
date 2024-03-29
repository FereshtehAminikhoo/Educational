<?php

namespace User\Providers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use RolePermissions\Models\Permission;
use User\Database\Seeds\UsersTableSeeder;
use User\Http\Middlewares\StoreUserIp;
use User\Models\User;
use User\Policies\UserPolicy;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/user_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'User');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
        $this->app['router']->pushMiddlewareToGroup('web', StoreUserIp::class);

        Factory::guessFactoryNamesUsing(function(string $modelName){
            return 'User\Database\Factories\\' . class_basename($modelName) . 'Factory';
        });

        config()->set('auth.providers.users.model', User::class);
        DatabaseSeeder::$seeders[] = UsersTableSeeder::class;
        Gate::policy(User::class, UserPolicy::class);
    }


    public function boot()
    {
        config()->set('sidebar.items.users', [
            "icon" => "i-users",
            "title" => "کاربران",
            "url" => route('users.index'),
            "permission" => Permission::PERMISSION_MANAGE_USERS,
        ]);

        $this->app->booted(function(){
            config()->set('sidebar.items.user-information', [
                "icon" => "i-user__inforamtion",
                "title" => "اطلاعات کاربری",
                "url" => route('users.profile'),
            ]);
        });
    }
}
