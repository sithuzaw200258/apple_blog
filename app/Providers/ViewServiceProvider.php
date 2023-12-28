<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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

        DB::listen(function ($q) {
            logger($q->sql);
        });

        View::composer([
            'frontend.welcome',
            'frontend.detail',
            'posts.create',
            'posts.edit'
        ], function ($view) {
            $view->with('categories',Category::latest("id")->get());
        });
    }
}
