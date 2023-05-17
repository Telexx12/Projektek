<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', function() {
    return view('pages.login');
})->name('login');

Route::get('/register', function (){
    return view('pages.register');
})->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout',[UserController::class,'logout'])->name('logout');

    Route::get('/', function () {
        return view('pages.welcome');
    })->name('dashboard');

    Route::get('/accounts',[AccountsController::class,'show'])->name('accounts');
    Route::get('/account/{account}',[AccountsController::class,'details'])->name('account.details');
    Route::get('/settings',[SettingsController::class,'show'])->name('settings');

});
