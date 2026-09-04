<?php

use App\Http\Controllers\MuebleController;
use App\Http\Controllers\VentaController;

Route::get('/', fn () => redirect()->route('muebles.index'));
Route::resource('muebles', MuebleController::class);
Route::resource('ventas', VentaController::class);