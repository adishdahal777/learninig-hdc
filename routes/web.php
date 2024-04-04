<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/language/switch', [LanguageController::class, 'switchLanguage'])->name('language.switch');


Route::get('/', function () {
    return view('welcome');
});

Route::get( '/welcome/hi', [HomeController::class, 'index'])->name('welcome.hi');

Route::get( '/welcome/add', [HomeController::class, 'add'])->name('welcome.add');
Route::post( '/welcome/add/submit', [HomeController::class, 'store'])->name('welcome.add.submit');
Route::get( '/welcome/hi/delete/{id}', [HomeController::class, 'delete'])->name('welcome.add.delete');
Route::get( '/welcome/hi/edit/{id}', [HomeController::class, 'edit'])->name('welcome.add.edit');
Route::post('/welcome/hi/update/{id}', [HomeController::class, 'update'])->name('welcome.add.update');
