<?php

use App\Http\Controllers\Api\PersonaController;
use App\Http\Controllers\Api\EntidadController;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\ProponenteController;
use App\Http\Controllers\Api\ConvocatoriaController;
use App\Http\Controllers\Api\ProponentePersonalController;
use App\Http\Controllers\Api\DocumentoModeloController;
use App\Http\Controllers\Api\DocumentoGeneradoController;
use App\Http\Controllers\Api\PlantillaCampoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('personas', PersonaController::class);
Route::apiResource('entidades', EntidadController::class);
Route::apiResource('cargos', CargoController::class);
Route::apiResource('proponentes', ProponenteController::class);
Route::apiResource('convocatorias', ConvocatoriaController::class);
Route::apiResource('proponente-personal', ProponentePersonalController::class);
Route::apiResource('documentos-modelo', DocumentoModeloController::class);
Route::apiResource('documentos-generados', DocumentoGeneradoController::class);
Route::apiResource('plantilla-campos', PlantillaCampoController::class);
Route::post('convocatorias/{convocatoria}/generar/{documentoModelo}', [DocumentoGeneradoController::class, 'generar']);