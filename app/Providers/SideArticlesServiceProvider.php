<?php

namespace App\Providers;

use App\Article;
use App\Entry;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SideArticlesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'components.sidebar', function($view)
            {

                if (session('msg'))
                {
                    $view->with(['sideArticles' => Article::visible('released_at')->get(),
                                'sideEntries' => Entry::selectEntries(),]);
                } else {
                    $view->with(['sideArticles' => Article::visible('released_at')
                                ->where('member_only', 0)->get(),
                                'sideEntries' => Entry::selectEntries(),]);
                }


            }
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
