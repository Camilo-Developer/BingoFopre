<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Redirect\RedirectController;
use App\Http\Controllers\Admin\Dashboard\DashboardsController;
use App\Http\Controllers\Admin\TemplateConfigs\TemplateConfigsController;
use App\Http\Controllers\Admin\CardMains\CardMainsController;
use App\Http\Controllers\Admin\Sponsors\SponsorsController;
use App\Http\Controllers\Admin\Instructions\InstructionsController;
use App\Http\Controllers\Admin\DynamicGames\DynamicGamesController;
use App\Http\Controllers\Admin\Prizes\PrizesController;
use App\Http\Controllers\Admin\States\StatesController;
use App\Http\Controllers\Admin\Roles\RolesController;
use App\Http\Controllers\Admin\Cardboards\CardboardsController;
use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\Admin\CartonGroups\CartonGroupsController;


Route::get('/dashboard', [DashboardsController::class, 'index'])->middleware('can:admin.dashboard')->name('admin.dashboard');
Route::resource('/templateconfigs', TemplateConfigsController::class)->names('admin.templateconfigs');
Route::resource('/cardmains', CardMainsController::class)->names('admin.cardmains');
Route::resource('/sponsors', SponsorsController::class)->names('admin.sponsors');
Route::resource('/instructions', InstructionsController::class)->names('admin.instructions');
Route::resource('/dynamicgames', DynamicGamesController::class)->names('admin.dynamicgames');
Route::resource('/prizes', PrizesController::class)->names('admin.prizes');
Route::resource('/states', StatesController::class)->names('admin.states');
Route::resource('/roles', RolesController::class)->names('admin.roles');
Route::get('/cartones/create', [CardboardsController::class,'createForm'])->middleware('can:admin.cartones.createForm')->name('admin.cartones.createForm');
Route::post('/cartones/create', [CardboardsController::class,'create'])->middleware('can:admin.cartones.createForm')->name('admin.cartones.create');
Route::put('/cartones/{cardboard}', [CardboardsController::class,'update'])->middleware('can:admin.cartones.update')->name('admin.cartones.update');
Route::get('/add-to-cart/{name}',[CardboardsController::class,'addToCart'])->middleware('can:addToCart');
Route::post('/cartones/finalizar-compra', [CardboardsController::class,'finishPurchase'])->middleware('can:admin.cartones.finishPurchase')->name('admin.cartones.finishPurchase');
Route::delete('/cartones/eliminar-del-carrito/{cartonId}', [CardboardsController::class,'removeFromCart'])->middleware('can:admin.cartones.removeFromCart')->name('admin.cartones.removeFromCart');
Route::resource('/users', UsersController::class)->names('admin.users');
Route::post('/users/group_assignment',[UsersController::class,'asiginacionGrupos'])->middleware('can:admin.users.asiginacionGrupos')->name('admin.users.asiginacionGrupos');
Route::post('/users/cambio-state-grupos-cartones',[UsersController::class,'cambioStateGruposCartones'])->middleware('can:admin.users.cambioStateGruposCartones')->name('admin.users.cambioStateGruposCartones');
Route::resource('/cartongroups', CartonGroupsController::class)->names('admin.cartongroups');
Route::post('/cardboard/generadormasivoQR', [CardboardsController::class,'generadormasivoQR'])->middleware('can:admin.cardboard.generadormasivoQR')->name('admin.cardboard.generadormasivoQR');

Route::post('/importar-cartones', [CardboardsController::class,'import'])->name('admin.importar.cartones');

Route::get('/sales-report-cardboards', [CardboardsController::class, 'showReport'])->name('admin.sales.showReport');
Route::get('/export-sales-cardboards', [CardboardsController::class, 'exportToExcel'])->name('admin.export.sales');

Route::get('/sales-detail-report', [CardboardsController::class, 'showDetailReport'])->name('admin.sales.detailReport');
Route::get('/export-sales-detail-report', [CardboardsController::class, 'exportDetailReport'])->name('admin.export.detailReport');
