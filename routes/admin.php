<?php
/**
 * Created by PhpStorm.
 * User: pepe
 * Date: 2017/10/25
 * Time: 上午9:52
 */

Route::group(['prefix'=>'admin'],function (){
    // 登录
    Route::get('/login','\App\Http\Controllers\admin\LoginController@index')->name('login');
    // 登录行为
    Route::post('/login','\App\Http\Controllers\admin\LoginController@login');
    // 登出
    Route::get('/logout','\App\Http\Controllers\admin\LoginController@logout');

    Route::group(['middleware'=>'auth:admin'],function (){
        // 首页
        Route::get('/index','\App\Http\Controllers\admin\IndexController@index');

        // 系统权限
        Route::group(['middleware' => 'can:system'],function (){
            // 管理员
            Route::get('/adminlist','\App\Http\Controllers\admin\UserController@lst');
            Route::get('/adminadd','\App\Http\Controllers\admin\UserController@add');
            Route::post('/adminstore','\App\Http\Controllers\admin\UserController@store');
            Route::get('/roles/{admin}','\App\Http\Controllers\admin\UserController@rolelist');
            Route::post('/roles/{admin}','\App\Http\Controllers\admin\UserController@editRole');


            // 角色
            Route::get('/rolelist','\App\Http\Controllers\admin\RoleController@rolelist');
            Route::get('/addrole','\App\Http\Controllers\admin\RoleController@addRole');
            Route::post('/addrole','\App\Http\Controllers\admin\RoleController@storerole');
            Route::get('/role/permissions/{role}','\App\Http\Controllers\admin\RoleController@permissions');
            Route::post('/role/permissions/{role}','\App\Http\Controllers\admin\RoleController@editPermissions');


            // 权限
            Route::get('/permissionlist','\App\Http\Controllers\admin\PermissionController@lst');
            Route::get('/addpermission','\App\Http\Controllers\admin\PermissionController@add');
            Route::post('/addpermission','\App\Http\Controllers\admin\PermissionController@addPost');

        });


        Route::group(['middleware' => 'can:article'],function (){
            // 文章审核
            Route::get('/articlelist','\App\Http\Controllers\admin\ArticleController@lst');
            Route::post('/shenhe/{article}','\App\Http\Controllers\admin\ArticleController@shenhe');
        });

        // 专题管理
        Route::group(['middleware' => 'can:topic'],function (){

            Route::resource('topic','\App\Http\Controllers\admin\TopicController',['only' => ['index','create','store','destroy']]);
        });
        


    });




});