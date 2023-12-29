<?php

use Illuminate\Support\Facades\Route;

Route::get('/actuator', [Eureka\LaravelEureka\LaravelEurekaController::class, 'actuator']);
Route::get('/actuator/health', [Eureka\LaravelEureka\LaravelEurekaController::class, 'actuator_health']);
