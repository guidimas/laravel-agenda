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

// Criamos um grupo de rotas com o prefixo: teste
Route::prefix('teste')->group(function () {

    // Cria uma rota diretamente para a view
    Route::view('/', 'teste');
    
});