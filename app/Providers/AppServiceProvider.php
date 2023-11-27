<?php

namespace App\Providers;

use App\Repositories\Article\ArticleRepository;
use App\Repositories\Article\EloquentArticle;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\EloquentCategory;
use Carbon\Carbon;
use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Activity\EloquentActivity;
use App\Repositories\Country\CountryRepository;
use App\Repositories\Country\EloquentCountry;
use App\Repositories\Permission\EloquentPermission;
use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Role\EloquentRole;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Session\DbSession;
use App\Repositories\Session\SessionRepository;
use App\Repositories\User\EloquentUser;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Notice\EloquentNotice;
use App\Repositories\Notice\NoticeRepository;
use App\Console\Commands\ModelMakeCommand;
use App\Repositories\File\FileRepository;
use App\Repositories\File\EloquentFile;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        \Illuminate\Database\Schema\Builder::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);
        $this->app->singleton(FileRepository::class, EloquentFile::class);
        $this->app->singleton(CategoryRepository::class, EloquentCategory::class);
        $this->app->singleton(ArticleRepository::class, EloquentArticle::class);
        if ($this->app->environment('local')) {

            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register('Kurt\Repoist\RepoistServiceProvider');
            /*$this->app->extend('command.model.make', function ($command, $app) {
                return new ModelMakeCommand($app['files']);
            });*/
        }
        $this->app->bind('path.public', function() {
            return base_path(Config::get("app.base_public_html"));
        });
    }
}
