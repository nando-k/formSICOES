<?php

use Illuminate\Support\Facades\Route;
use App\Models\DocumentoGenerado;

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

Route::get('/convocatorias/{id}', function ($id) {
    return view('convocatorias.show', ['id' => $id]);
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

Route::get('/empresas/{id}', function ($id) {
    return view('empresas.show', ['id' => $id]);
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

Route::get('/documentos/{id}', function ($id) {
    return view('documentos.show', ['id' => $id]);
});

Route::get('/documentos/{id}/descargar', function ($id) {
    $documento = DocumentoGenerado::findOrFail($id);

    $ruta = storage_path('app/' . $documento->ruta_archivo);

    if (!file_exists($ruta)) {
        abort(404, 'El archivo no existe en el servidor.');
    }

    return response()->download($ruta, $documento->nombre_archivo);
});

Route::get('/formularios/generar', function () {
    return view('formularios.generar');
});

Route::get('/entidades', function () {
    return view('entidades.index');
});

Route::get('/entidades/create', function () {
    return view('entidades.create');
});