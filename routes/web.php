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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/docente', 'HomeController@docentes')->name('docentes');
Route::post('/docente', 'HomeController@gerar')->name('gerar');
Route::get('/declaracao', 'HomeController@declaracao')->name('declaracao');
Route::post('/carregar/planilha', 'HomeController@planilha')->name('planilha');
