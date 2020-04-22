<?php

namespace InetStudio\SocialContest\Tags\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class TagsServiceProvider.
 */
class TagsServiceProvider extends ServiceProvider
{
    /**
     * Загрузка сервиса.

     */
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
    }

    /**
     * Регистрация команд.

     */
    protected function registerConsoleCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                'InetStudio\SocialContest\Tags\Console\Commands\SetupCommand',
            ]);
        }
    }

    /**
     * Регистрация ресурсов.

     */
    protected function registerPublishes(): void
    {
        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateSocialContestTagsTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../../database/migrations/create_social_contest_tags_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_social_contest_tags_tables.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Регистрация путей.

     */
    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    /**
     * Регистрация представлений.

     */
    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.social-contest.tags');
    }
}
