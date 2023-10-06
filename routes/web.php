<?php

use Illuminate\Support\Facades\Route;

use Laravel\Socialite\Facades\Socialite;

use App\Http\Controllers\BingoFopre\BingoFopreController;
use App\Http\Controllers\Admin\Redirect\RedirectController;

use App\Http\Controllers\Admin\Cardboards\CardboardsController;

use App\Http\Controllers\Admin\Salesforce\SalesforceController;

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
Route::get('/salesforece/{id}', [SalesforceController::class, 'index']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //Route de estudiante y vendedor
    Route::get('/dashboard',[RedirectController::class, 'dashboardUser'])->middleware('can:dashboard')->name('dashboard');
    Route::get('/dashboard',[BingoFopreController::class,'dashboardcartsgroup'])->middleware('can:dashboard')->name('dashboard');
    Route::get('/cartones/carrito', [CardboardsController::class,'showCart'])->middleware('can:addToCart')->name('user.cart.index');


    Route::match(['get', 'post', 'put', 'delete'], '/register', function () {
        abort(404);
    })->name('register');
});
