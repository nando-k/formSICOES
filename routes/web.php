<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/convocatorias', function () {
    return view('convocatorias.index');
});

Route::get('/convocatorias/create', function () {
    return view('convocatorias.create');
});

Route::get('/propuestas', function () {
    return view('propuestas.index');
});

Route::get('/propuestas/create', function () {
    return view('propuestas.create');
});

Route::get('/propuestas/generar', function () {
    return view('propuestas.generar');
});

Route::get('/empresas', function () {
    return view('empresas.index');
});

Route::get('/empresas/create', function () {
    return view('empresas.create');
});

Route::get('/personal', function () {
    return view('personal.index');
});

Route::get('/personal/create', function () {
    return view('personal.create');
});

Route::get('/empresas', function () {
    return view('empresas.index');
});

Route::get('/empresas/create', function () {
    return view('empresas.create');
});

Route::get('/personal', function () {
    return view('personal.index');
});

Route::get('/personal/create', function () {
    return view('personal.create');
});

Route::get('/formularios', function () {
    return view('formularios.index');
});

Route::get('/formularios/preview', function () {
    return view('formularios.preview');
});

Route::get('/documentos', function () {
    return view('documentos.index');
});

Route::get('/documentos/1', function () {
    return view('documentos.show');
});

Route::get('/formularios/generar', function () {
    return view('formularios.generar');
});