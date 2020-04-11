<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->group(function () {
    // 注册
    Route::post('register', 'UsersController@register')->name('users.register');
    // 登录
    Route::post('login', 'UsersController@login')->name('login');
    // 删除token
    Route::post('logout', 'UsersController@destroy')->name('users.destroy');
});


Route::middleware('auth:api')->namespace('Api')->group(function () {
    Route::get('info', 'UsersController@info')->name('users.info');
    Route::post('create-lesson', 'LessonsController@create')->name('lessons.create');
    Route::get('lesson-list', 'LessonsController@lessonList')->name('lessons.lessonList');
    Route::post('join', 'LessonsController@join')->name('lessons.join');
    Route::get('my-lesson', 'LessonsController@myLession')->name('lessons.myLesson');
    Route::get('student-list', 'LessonsController@studentList')->name('lessons.studentList');
});
