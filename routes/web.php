<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 文章模块
Route::get('/articles','ArticleController@lst');
Route::get('/addarticle','ArticleController@add');
Route::post('/addarticlepost','ArticleController@addArticlePost');
Route::get('/editarticle/{article}','ArticleController@edit');
Route::put('/editarticle/{article}','ArticleController@editArticlePost');
Route::get('/deletearticle/{article}','ArticleController@deleteArticle');
Route::get('/articles/{article}','ArticleController@show'); // 文章详情页

// 上传图片
Route::post('/articles/image/upload','ArticleController@uploadImage');
