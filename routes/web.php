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

// Rotas para as pessoas
Route::prefix('pessoas')->group(function () {

    // Lista as pessoas
    Route::get('/', 'PessoasController@index')->name('pessoas.index');

    // View para cadastrar uma nova pessoa
    Route::get('/cadastrar', 'PessoasController@create')->name('pessoas.create');

    // Post para cadastrar a nova pessoa
    Route::post('/salvar', 'PessoasController@store')->name('pessoas.store');
    
    // Post para deletar uma pessoa
    Route::post('/deletar', 'PessoasController@delete')->name('pessoas.delete');

    // Get para editar uma pessoa
    Route::get('/{id}/editar', 'PessoasController@edit')->name('pessoas.edit');

    // Post para salvar (update) uma pessoa
    Route::post('/atualizar', 'PessoasController@update')->name('pessoas.update');

    // Get para restaurar uma pessoa
    Route::get('/{id}/restaurar', 'PessoasController@restore')->name('pessoas.restore');
    
});