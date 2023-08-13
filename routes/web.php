<?php

use App\Http\Controllers\CepController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CepController::class,'showCepForm']);

Route::post('/', [CepController::class,'consultaCeps']);

Route::post('/exportar-csv', [CepController::class,'exportarCsv']);
