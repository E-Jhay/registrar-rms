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

Route::view('/', 'orders.create');
Route::resource('/orders', 'App\Http\Controllers\OrdersController');
Auth::routes();
Route::middleware('auth')->group(function (){
    
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    Route::view('/documents', 'documents.crud')->name('documents');
    Route::view('/accounts', 'accounts.crud')->name('accounts');
    Route::view('/logs', 'logs.crud')->name('logs');
    Route::view('/monthly-reports', 'reports.monthly-reports')->name('monthly-reports');
    Route::view('/quarterly-reports', 'reports.quarterly-reports')->name('quarterly-reports');

});