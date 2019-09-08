<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/* 自作ヘルパーを作成して使用する為のもの */
class MyHelpersServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // MyHelpersディレクトリ＋正規表現で全てのMyhelpersのPHPファイルを指定
        $preg_path = sprintf('%s/MyHelpers/*.php', app_path());
        // glob関数でMyHelpersディレクトリ内のすべてのPHPファイルのフルパスを取得する
        $helper_files= glob($preg_path);
        // foreachしてMyHelpersディレクトリ内のすべてのPHPファイルを読み込む
        foreach ($helper_files as $helper_file){
            require_once($helper_file);
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
