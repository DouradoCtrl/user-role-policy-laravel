<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    Route::get('/produtos', function () {
        return view('produtos');
    })->name('produtos')->middleware('estoque');

    Route::get('/pedidos', function () {
        return view('pedidos');
    })->name('pedidos')->middleware('atendente');

    Route::get('/rastreio-atividades', function () {
        return view('rastreio-atividades');
    })->name('rastreio-atividades')->middleware('admin.only');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'admin.only']], function () {
    Route::get('/user-management', [UserController::class, 'index'])->name('users-management');

    Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');
    
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::delete('/user-management', [UserController::class, 'destroy'])->name('user.destroy');
});

require __DIR__.'/auth.php';
