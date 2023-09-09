<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\TemplateConfigs\TemplateConfigsController;


Route::resource('/templateconfigs', TemplateConfigsController::class)->names('admin.templateconfigs');
