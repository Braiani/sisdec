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
Route::group(['middleware' => 'auth', 'as' => 'sisdec.'], function () {
    Route::post('/docente', 'HomeController@gerar')->name('gerar');
    Route::post('docente/planilha', 'DocenteController@atualizar')->name('docente.atualizar');
    Route::resource('/docente', 'DocenteController');
    Route::get('/declaracao', 'DocenteController@declaracao')->name('declaracao');
    Route::post('/disciplina/planilha', 'DisciplinaController@atualizar')->name('disciplina.atualizar');
    Route::resource('/disciplina', 'DisciplinaController');
    Route::resource('/curso', 'CursoController');
});
