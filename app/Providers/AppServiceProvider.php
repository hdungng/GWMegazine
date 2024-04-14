<?php

namespace App\Providers;

use App\Enums\AcademicYearStatusEnum;
use App\Models\AcademicYear;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        // Bind a global variable into the service container
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // Validator Square Check
        Validator::extend('square', function ($attribute, $value, $parameters, $validator) {
            $imageSize = getimagesize($value->getPathname());
            $width = $imageSize[0];
            $height = $imageSize[1];
            return $width === $height;
        });
    }
}
