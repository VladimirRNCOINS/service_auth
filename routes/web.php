<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValidateController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/signin', function () {
    if (!Auth::user()) {
        return view('login');
    }
    return Redirect::to('http://api_gateway.local:81/');
})->name('signin');

Route::post('signin', [AuthenticatedSessionController::class, 'store']);

Route::get('/validate', [ValidateController::class, 'validate'])->name('validate');

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

/*Route::get('/register', function () {
    return view('auth.register');
});*/

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/

require __DIR__.'/auth.php';
