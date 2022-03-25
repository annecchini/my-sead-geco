<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('person', 'PersonController');
Route::get('/person/{person}/bonds', [App\Http\Controllers\BondController::class, 'personBondIndex'])->name('bond.personBondIndex');
Route::get('/person/{person}/documents', [App\Http\Controllers\DocumentController::class, 'personDocumentIndex'])->name('document.personDocumentIndex');

Route::resource('user', 'UserController');

Route::resource('document', 'DocumentController');

Route::resource('bond', 'BondController');
