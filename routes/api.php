<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\States\StatesController;
use App\Http\Controllers\Api\TemplateConfigs\TemplateConfigsController;
use App\Http\Controllers\Api\CardMains\CardMainsController;
use App\Http\Controllers\Api\Sponsors\SponsorsController;
use App\Http\Controllers\Api\Instructions\InstructionsController;
use App\Http\Controllers\Api\DynamicGames\DynamicGamesController;
use App\Http\Controllers\Api\Prizes\PrizesController;
use App\Http\Controllers\Api\CardBoards\CardBoardsController;
use App\Http\Controllers\Api\CartonGroups\CartonGroupsController;
use App\Http\Controllers\Api\Users\UsersController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('states',StatesController::class);
Route::resource('templateconfigs',TemplateConfigsController::class);
Route::resource('cardmains',CardMainsController::class);
Route::resource('sponsors',SponsorsController::class);
Route::resource('instructions',InstructionsController::class);
Route::resource('dynamicgames',DynamicGamesController::class);
Route::resource('prizes',PrizesController::class);
Route::resource('cardboards',CardBoardsController::class);

Route::post('admin/cartones/create', [CardboardsController::class, 'create'])->name('admin.cartones.create');
Route::post('admin/cartones/addToCart/{name}', [CardboardsController::class, 'addToCart'])->name('admin.cartones.addToCart');
Route::post('admin/cartones/finishPurchase', [CardboardsController::class, 'finishPurchase'])->name('admin.cartones.finishPurchase');
Route::post('admin/cartones/removeFromCart/{cartonId}', [CardboardsController::class, 'removeFromCart'])->name('admin.cartones.removeFromCart');

Route::resource('cartongroups',CartonGroupsController::class);
Route::resource('users',UsersController::class);
