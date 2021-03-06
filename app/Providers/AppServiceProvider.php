<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('*', function ($view) {
            $versionFileExists = file_exists(base_path() . '/version.txt');
            $versionNumber = $versionFileExists ? file_get_contents(base_path() . '/version.txt') : '-';

            $view->with([
                'userName' => Auth::check() ? Auth::user()->name : null,
                'currency' => Auth::check() ? session('space') ? session('space')->currency->symbol : '-' : null,
                'suggestionBoxEnabled' => env('SUGGESTION_BOX_ENABLED', false),
                'versionNumber' => $versionNumber
            ]);
        });
    }

    public function register()
    {
        //
    }
}
