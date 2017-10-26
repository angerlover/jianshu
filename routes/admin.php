<?php
/**
 * Created by PhpStorm.
 * User: pepe
 * Date: 2017/10/25
 * Time: 上午9:52
 */

Route::group(['prefix'=>'admin'],function (){
    // 登录
    Route::get('/login','\App\Http\Controllers\admin\LoginController@index');
    // 登录行为
    Route::post('/login','\App\Http\Controllers\admin\LoginController@login');
    // 登出
    Route::get('/logout','\App\Http\Controllers\admin\LoginController@logout');

    Route::group(['middleware'=>'auth:admin'],function (){
        // 首页
        Route::get('/index','\App\Http\Controllers\admin\IndexController@index');

        // 管理员
        Route::get('/adminlist','\App\Http\Controllers\admin\UserController@lst');
        Route::get('/adminadd','\App\Http\Controllers\admin\UserController@add');
        Route::post('/adminstore','\App\Http\Controllers\admin\UserController@store');

        // 文章审核
        Route::get('/articlelist','\App\Http\Controllers\admin\ArticleController@lst');
        Route::post('/shenhe/{article}','\App\Http\Controllers\admin\ArticleController@shenhe');

    });




});