<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard', function () {return Inertia::render('Dashboard');})->name('dashboard');
    Route::get('/shops', function () {return Inertia::render('Shops');})->name('shops');
    Route::get('/home', function () {return Inertia::render('Home');})->name('home');
    Route::get('/order', function () {return Inertia::render('Order');})->name('order');
    Route::get('/cart', function () {return Inertia::render('Cart');})->name('cart');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/data', [ItemsController::class, 'index']);
    Route::get('/items', [ItemsController::class, 'index']);

    Route::get('/user', [RegisteredUserController::class, 'index']);
    Route::get('/users', [RegisteredUserController::class, 'indexall']);
    Route::post('/orders', [OrdersController::class, 'store']);

});

Route::get('/roles', [RolesController::class, 'index']);


require __DIR__.'/auth.php';
