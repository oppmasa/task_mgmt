<?php

use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
//タスク
    Route::get('/task', [TaskController::class, 'index'])->name('index');
    Route::get('/task/add', [TaskController::class, 'add'])->name('add');
    Route::post('/task/create', [TaskController::class, 'create'])->name('create');
    Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('edit');
    Route::post('/task/update', [TaskController::class, 'update'])->name('update');
    Route::get('/task/delete/{task_id}', [TaskController::class, 'delete'])->name('delete');
});
