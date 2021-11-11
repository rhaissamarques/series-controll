<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create somNavbarething great!
|
*/

Route::get('/series', 'SeriesController@index')->name('listar_series');
Route::get('/series/criar', 'SeriesController@create')
    ->name('form_criar_serie')
    ->middleware('auth');
//qualquer url que eu colocar em cima vai funcionar pq no arquivo index, criei um href="{{ route('form_criar_serie') }}"
//é ele quem define qual url seguir e não o nome que eu coloco acima.
Route::post('/series/criar', 'SeriesController@store')
    ->middleware('auth');
Route::delete('/series/{id}', 'SeriesController@destroy')
->middleware('auth');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')
->middleware('auth');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');
Route::get('/temporadas/{temporada}/episodios', 'EpisodiosController@index');
Route::post('/temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir')
->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/sair', function () {
    Auth::logout();
    return redirect('/entrar');
});
