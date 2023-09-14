<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Redirect\RedirectController;
use App\Http\Controllers\Admin\TemplateConfigs\TemplateConfigsController;
use App\Http\Controllers\Admin\CardMains\CardMainsController;
use App\Http\Controllers\Admin\Sponsors\SponsorsController;
use App\Http\Controllers\Admin\Instructions\InstructionsController;
use App\Http\Controllers\Admin\DynamicGames\DynamicGamesController;
use App\Http\Controllers\Admin\Prizes\PrizesController;
use App\Http\Controllers\Admin\States\StatesController;
use App\Http\Controllers\Admin\Roles\RolesController;

use App\Http\Controllers\Admin\Cardboards\CardboardsController;



Route::get('/dashboard', [RedirectController::class, 'dashboardAdmin'])->name('admin.dashboard');

Route::resource('/templateconfigs', TemplateConfigsController::class)->names('admin.templateconfigs');
Route::resource('/cardmains', CardMainsController::class)->names('admin.cardmains');
Route::resource('/sponsors', SponsorsController::class)->names('admin.sponsors');
Route::resource('/instructions', InstructionsController::class)->names('admin.instructions');
Route::resource('/dynamicgames', DynamicGamesController::class)->names('admin.dynamicgames');
Route::resource('/prizes', PrizesController::class)->names('admin.prizes');
Route::resource('/states', StatesController::class)->names('admin.states');
Route::resource('/roles', RolesController::class)->names('admin.roles');


Route::get('/cartones/create', [CardboardsController::class,'createForm'])->name('admin.cartones.createForm');
Route::post('/cartones/create', [CardboardsController::class,'create'])->name('admin.cartones.create');

Route::get('/add-to-cart/{name}',[CardboardsController::class,'addToCart']);
Route::get('/cartones/carrito', [CardboardsController::class,'showCart'])->name('admin.cartones.cart');
Route::post('/cartones/finalizar-compra', [CardboardsController::class,'finishPurchase'])->name('admin.cartones.finishPurchase');
Route::delete('/cartones/eliminar-del-carrito/{cartonId}', [CardboardsController::class,'removeFromCart'])->name('admin.cartones.removeFromCart');

