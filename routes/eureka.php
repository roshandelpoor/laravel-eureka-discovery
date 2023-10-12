<?php

use Illuminate\Routing\Route;

Route::get('/actuator', 'LaravelEurekaController:class@actuator');
Route::get('/actuator/health', 'LaravelEurekaController:class@actuator_health');
