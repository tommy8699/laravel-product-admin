<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => auth()->check() ? redirect()->route('products.index') : redirect()->route('login'));
Route::get('/login', [AuthController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/locale/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['sk', 'en'], true), 404);
    session(['locale' => $locale]);
    return back();
})->name('locale');
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class)->except('show');
});
