<?php

use App\Http\Controllers\AdminNotificationController;
use App\Http\Middleware\Authenticate;
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

Auth::routes();


Route::get('/notify-setting',[AdminNotificationController::class, 'index'])
    ->middleware('auth')
    ->name('notificationSetting');

Route::post('/notify-setting',[AdminNotificationController::class, 'save'])
    ->middleware('auth')
    ->name('notificationSetting');


Route::get('/', [App\Http\Controllers\TodoController::class, 'index'])
    ->middleware('auth')
    ->name('home');


//index pages item view url
Route::get('view/{id}', [App\Http\Controllers\TodoController::class,'view'])->middleware('auth');


Route::get('create', [App\Http\Controllers\TodoController::class, 'create'])
    ->middleware('auth')
    ->name('create');
Route::post('store', [App\Http\Controllers\TodoController::class, 'store'])
    ->middleware('auth')
    ->name('save');


Route::get('/edit/{id}', [App\Http\Controllers\TodoController::class, 'edit'])
    ->middleware('auth')
    ->name('edit');

Route::post('/update/{id}', [App\Http\Controllers\TodoController::class,'update'])
    ->middleware('auth')
    ->name('update');


Route::get('/delete/{id}', [App\Http\Controllers\TodoController::class, 'delete'])
    ->middleware('auth')
    ->name('delete');


Route::get('/compleated/{id}', [App\Http\Controllers\TodoController::class,'compleated'])
    ->middleware('auth')
    ->name('compleated');
