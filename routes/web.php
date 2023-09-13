<?php

use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\BingoFopre\BingoFopreController;
use App\Http\Controllers\Admin\Redirect\RedirectController;

use App\Http\Controllers\Admin\Cardboards\CardboardsController;
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

Route::get('/',[BingoFopreController::class,'index'])->name('bingofopre.index');
Route::get('/instructions',[BingoFopreController::class,'Instructions'])->name('bingofopre.instructions');
Route::get('/prizes',[BingoFopreController::class,'prizes'])->name('bingofopre.prizes');

Route::get('/redirect',[RedirectController::class, 'dashboard']);

Route::get('/auth/azure', [RedirectController::class, 'azureLogin'])->name('auth.azure');
Route::get('/auth/azure/callback', [RedirectController::class, 'azureCallback']);



Route::get('/cartones/create', [CardboardsController::class,'createForm'])->name('cartones.createForm');
Route::post('/cartones/create', [CardboardsController::class,'create'])->name('cartones.create');

Route::get('add-to-cart/{name}',[CardboardsController::class,'addToCart']);
Route::get('/cartones/carrito', [CardboardsController::class,'showCart'])->name('cartones.cart');
Route::post('cartones/finalizar-compra', [CardboardsController::class,'finishPurchase'])->name('cartones.finishPurchase');
Route::delete('cartones/eliminar-del-carrito/{cartonId}', [CardboardsController::class,'removeFromCart'])->name('cartones.removeFromCart');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',[RedirectController::class, 'dashboardUser'])->name('dashboard');
});
