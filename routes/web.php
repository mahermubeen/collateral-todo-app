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
Route::get('/', 'LandingPageController@index');

Route::post('memberId/{id}', 'LandingPageController@index1');

Route::post('/updateStatuss/{id}', 'LandingPageController@updateStatus');
Route::post('/updateStatuss1/{id}', 'LandingPageController@updateStatus1');
Route::get('/getCommentss/{id}', 'LandingPageController@getComments');



Route::get('/dashboard', 'HomeController@dashboard');
Route::get('/people', 'HomeController@people');
Route::post('/updateStatus/{id}', 'HomeController@updateStatus');
Route::post('/updateStatus1/{id}', 'HomeController@updateStatus1');
Route::get('/getComments/{id}', 'HomeController@getComments');
Route::post('/update/password', 'HomeController@update_password');
Route::get('/getMember/{id}', 'HomeController@getMember');

Route::post('/member/add', 'MemberController@add_member');
Route::get('/member/destroy/{id}', 'MemberController@destroy_member');
Route::post('/member/edit/{id}', 'MemberController@edit_member');


Route::post('/post/add', 'PostController@add_post');
Route::get('/post/destroy/{id}', 'PostController@destroy_post');
Route::post('/post/update', 'PostController@edit_posts');
Route::get('/destroy/posts', 'PostController@destroy_allPosts');
Route::get('/destroy/post/{id}', 'PostController@destroy_post');

Route::post('/update/status/{id}', 'PostController@edit_post');

Route::post('/comment/add/{id}', 'CommentController@add_comment');

Route::get('/login', 'CustomAuth\LoginController@showLoginForm')->name('login');
Route::post('/customLogin', 'CustomAuth\LoginController@login');
Route::post('/logout', 'CustomAuth\LoginController@logout');
Route::get('/customRegister', 'CustomAuth\RegisterController@showRegistrationForm');
Route::post('/customRegister', 'CustomAuth\RegisterController@register');

Route::post('/password/email', 'CustomAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset', 'CustomAuth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/reset', 'CustomAuth\ResetPasswordController@reset')->name('password.update');
Route::get('/password/reset', 'CustomAuth\ResetPasswordController@showResetForm')->name('password.reset');
