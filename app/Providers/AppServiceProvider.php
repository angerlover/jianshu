<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 设置mysql的最大字符长度和laravel的冲突
        Schema::defaultStringLength(191);

        // 给sidebar合成视图
        \View::composer('layout.sidebar',function($view){

            $topics = \App\Topic::all();

            $view->with('topics',$topics);
        });


        // 慢查询
        \DB::listen(function ($query){
             $sql = $query->sql;
             $time = $query->time;
             $bindings = $query->bindings;

             // 输出到日志
            \Log::debug(var_export(compact('sql','time','bindings'),true));

    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
