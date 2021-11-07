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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::resource('/orders', 'App\Http\Controllers\OrdersController');
Route::view('/documents', 'documents.crud')->name('documents');
Route::view('/accounts', 'accounts.crud')->name('accounts');
Route::view('/reports', 'reports.reports')->name('reports');
Route::view('/quarterly-reports', 'reports.quarterly-reports')->name('quarterly-reports');
