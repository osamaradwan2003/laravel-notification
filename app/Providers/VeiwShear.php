<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class VeiwShear extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $adminID = User::all()->where('is_admin', '=', true)[0]->id;
        View::composer('*', function ($view) use($adminID)
        {
            $view->with('adminID', $adminID);
        });
    }
}
