<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
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




//メール認証待機
Route::get('/verify', function() {
    return view('auth.verify');
});

Route::group(['middleware' => 'auth'], function () {
//タスク
    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::get('/task/add', [TaskController::class, 'add'])->name('add');
    Route::post('/task/create', [TaskController::class, 'create'])->name('create');
    Route::get('/task/edit/{id}', [TaskController::class, 'edit'])->name('edit');
    Route::post('/task/update', [TaskController::class, 'update'])->name('update');
    Route::post('/task/delete/{task_id}', [TaskController::class, 'delete'])->name('delete');
});

//登録
Route::get('/register/forms', [RegisterController::class, 'showRegisterForm'])->name('register.index');
Route::post('/register/create', [RegisterController::class, 'create'])->name('register.create');
Route::get('/register/confirmation/{email_confirmation_token}', [RegisterController::class, 'confirmation'])->name('register.confirmation');
Route::get('/register/completed', [RegisterController::class, 'completed'])->name('register.completed');

Auth::routes();
