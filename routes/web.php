<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;


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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [LoginController::class, 'index'])->name('index');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard/user/index', [UserController::class, 'index'])->name('indexUser');
Route::get('/dashboard/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
Route::post('/dashboard/accounts', [AccountController::class, 'store'])->name('accounts.store');
Route::post('/dashboard/transfer', [TransactionController::class, 'store'])->name('transfer.store');
Route::get('/dashboard/transfer/index', [TransactionController::class, 'index'])->name('transfer.index');




