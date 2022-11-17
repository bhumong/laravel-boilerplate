<?php

namespace App\Providers;

use App\Console\DevOnly\GenerateInterfaceIDEHelper;
use App\Console\DevOnly\ModelsCommand;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->registerDevOnlyCommands();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register dev only commands
     *
     * @return void
     */
    public function registerDevOnlyCommands()
    {
        if (app()->environment(['local', 'dev', 'testing']) && $this->app->runningInConsole()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->commands([
                GenerateInterfaceIDEHelper::class,
                ModelsCommand::class,
            ]);
        }
    }
}
