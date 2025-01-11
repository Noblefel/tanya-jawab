<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JawabanController as AdminJawabanController;
use App\Http\Controllers\Admin\MapelController;
use App\Http\Controllers\Admin\PertanyaanController as AdminPertanyaanController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', [Controller::class, 'index'])->name('home');
Route::get('/logout', [Controller::class, 'logout']);

Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::post('/login', [Controller::class, 'login']);
    Route::get('/register', fn() =>  view('auth.register'))->name('register');
    Route::post('/register', [Controller::class, 'register']);
});

Route::get('/mapel', [PertanyaanController::class, 'mapel'])->name('mapel');
Route::get('/pertanyaan/search', [PertanyaanController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::resource("pertanyaan", PertanyaanController::class);
    Route::resource("user", UserController::class);
    Route::get("/user/{id}/jawaban", [UserController::class, 'jawaban'])->name('user.jawaban');
    Route::post('/pertanyaan/{id}/jawab', [JawabanController::class, 'store'])->name('jawab');
    Route::delete('/jawaban/{id}', [JawabanController::class, 'delete'])->name('jawaban.delete');
});

Route::prefix("admin")->as("admin.")->middleware([Admin::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', AdminUserController::class);
    Route::resource('pertanyaan', AdminPertanyaanController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('jawaban', AdminJawabanController::class);
});
