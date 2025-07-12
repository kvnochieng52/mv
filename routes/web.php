<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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



// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::get('/user-login', [LoginController::class, 'Login'])->name('login');
Route::post('login-process', [LoginController::class, 'LoginUser'])->name('login-process');
Route::get('/', [LoginController::class, 'Login'])->name('login');

Route::get('/user-register', [LoginController::class, 'register'])->name('register');
Route::post('register-user', [LoginController::class, 'registerUser'])->name('register-user');

Route::middleware('auth')->group(function () {
    Route::resource('movie', MovieController::class);
    Route::post('rate', [MovieController::class, 'rate'])->name('movie.rate');
});

require __DIR__ . '/auth.php';
