<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HelloServiceProvider extends ServiceProvider
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
        View::composer(
            'layouts.layouts', function($view){
                $title = 'Morning Glory';
                $user_id = '';
                /* ビューに変数が渡されているかは$view->変数で調べる */
                if ($view->offsetExists('page_title')) {
                    $title = $view->page_title. " - ". 'title';
                }

                $view->with('page_title', $title);
             }
         );
    }
}
