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


// 登陆注册
Route::get('/register','RegisterController@index');
Route::post('/register','RegisterController@register');
Route::get('/login','LoginController@index');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@logout');

// 个人设置

Route::get('/settings/{user}','UserController@index');
Route::post('/settings/{user','UserController@settings');
// 上传图片
Route::post('/articles/image/upload','ArticleController@uploadImage');

// 评论
Route::post('/comment/{article}','CommentController@comment');
// 赞
Route::get('/zan/{article}','ZanController@zan');
Route::get('/unzan/{article}','ZanController@unzan');
Route::get('/search','SearchController@search');

// 个人中心
Route::get('/center/{user}','UserController@center');
// 关注和取关
Route::post('/fan/{user}','UserController@fan');
Route::post('/unfan/{user}','UserController@unfan');


// 专题详情页
Route::get('/topic/{topic}','TopicController@show');
// 投稿
Route::post('/topic/submit/{topic}','TopicController@submit');
// 通知
Route::get('/notices/{user}','NoticeController@index');
// 测试服务提供者
Route::get('/service','\App\Http\Controllers\ServiceTest\ServiceTestController@index');


include_once 'admin.php';