<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\TaskController;
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




Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [MainController::class, 'index'])->name('dashboard');
});
Route::get('/tasks/{$id}', [TaskController::class,'destroy'])->name('tasks.destroy')->whereNumber('id');
Route::resource('/tasks', TaskController::class);

require __DIR__.'/auth.php';
