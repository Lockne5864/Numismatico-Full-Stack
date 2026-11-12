<?php

use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\MoneyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



// Usando Closure para rotas simples
Route::get('/', fn () => Inertia::render('Welcome', [
	'canLogin' => Route::has('login'),
	'canRegister' => Route::has('register'),
	'laravelVersion' => Application::VERSION,
	'phpVersion' => PHP_VERSION,
]));

// Agrupando rotas com middlewares similares
Route::middleware(['auth', 'verified'])->group(function () {
	// Usando uma Closure para a rota Dashboard
	Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');

	// Agrupamento de rotas para MoneyController
	Route::controller(MoneyController::class)->group(function () {
		Route::get('/banknotes', 'index')->name('banknotes');
		Route::post('/banknotes', 'store')->name('addBanknotes');
		Route::delete('/delMoney/{id}', 'destroy')->name('delMoney');
	});

	// Agrupamento de rotas para MoneyController
	Route::controller(MarketplaceController::class)->group(function () {
		Route::get('/marketplace', 'index')->name('marketplace');
		Route::post('/marketplace', 'store')->name('addMarketplace');
	});

	// Rotas para ProfileController
	Route::controller(ProfileController::class)->group(function () {
		Route::get('/profile', 'edit')->name('profile.edit');
		Route::patch('/profile', 'update')->name('profile.update');
		Route::delete('/profile', 'destroy')->name('profile.destroy');
	});
});

// Incluindo rotas de autenticação
require __DIR__ . '/auth.php';
