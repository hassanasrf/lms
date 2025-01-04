<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindContracts();
    }

    private function bindContracts()
    {
        $repositoryNamespace = 'App\Repository\Eloquent';
        $contractsNamespace = 'App\Repository\Contracts';

        $files = (new Filesystem)->files(app_path('Repository/Eloquent'));

        foreach ($files as $file) {
            $className = $file->getBasename('.php');

            $repositoryClass = "{$repositoryNamespace}\\{$className}";
            $contractInterface = "{$contractsNamespace}\\{$className}Interface";

            if (class_exists($repositoryClass) && interface_exists($contractInterface)) {
                $this->app->bind($contractInterface, $repositoryClass);
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
