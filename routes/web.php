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

Auth::routes();

Route::get('/', 'ProfilController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('profiles', 'ProfilController');

Route::resource('courses', 'CoursesController');

Route::resource('grades', 'GradesController');

Route::resource('lessons', 'LessonsController');


Route::get('/getStudent',function(){
    if(\Illuminate\Http\Request::ajax()){
        return 'get Studeent has loaded complyty';
    }
});