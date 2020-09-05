<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Get the games list to be shared with the navigation header.
        $gameFile = Storage::disk('local')->get("games.json");
        $gamesList = json_decode($gameFile);
        View::share('gamesList', $gamesList);
    }
}
