<?php

namespace App\Providers;

use App\Cities;
use App\Http\Helpers\Helper;
use App\Member;
use Illuminate\Support\Facades\Auth;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       
        $data['city'] = Cities::with('districts')->get();
        
        view()->share($data);
    }
}
