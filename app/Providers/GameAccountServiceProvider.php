<?php

namespace App\Providers;

use App\ServiceContainers\CallOfDuty;
use App\ServiceContainers\LeagueOfLegends;
use Illuminate\Support\ServiceProvider;

class GameAccountServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton('CoD', function($app) {
        //     return new CallOfDuty("2beae5e1-f094-44cb-85ef-737d4e3046d3");
        // });
        $this->app->singleton('LoL', function($app) {
            return new LeagueOfLegends("please enter Riot Games API key (new one needed every day)");
        });
    }
}
