<?php

use Illuminate\Support\Facades\Route;
use App\Models\DocumentoGenerado;
use App\Models\Persona;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/empresas', function () {
    return view('empresas.index');
});

Route::get('/empresas/create', function () {
    return view('empresas.create');
});

Route::get('/empresas/{id}/edit', function ($id) {
    return view('empresas.edit', ['id' => $id]);
});

Route::get('/empresas/{id}', function ($id) {
    return view('empresas.show', ['id' => $id]);
});

Route::get('/entidades', function () {
    return view('entidades.index');
});

Route::get('/entidades/create', function () {
    return view('entidades.create');
});

Route::get('/entidades/{id}/edit', function ($id) {
    return view('entidades.edit', ['id' => $id]);
});

Route::get('/personal', function () {
    return view('personal.index');
});

Route::get('/personal/create', function () {
    return view('personal.create');
});

Route::get('/personal/{id}/edit', function ($id) {
    return view('personal.edit', ['id' => $id]);
});

Route::get('/personal/plantilla-csv', function () {
    $contenido = "\xEF\xBB\xBF";
    $contenido .= "nombres;apellido_paterno;apellido_materno;ci;ci_expedido;direccion;telefono;correo;profesion\n";
    $contenido .= "JUAN;CALLE;PEREZ;1234567;LP;CALLE FALSA 123;76543210;juan@example.com;INGENIERO\n";

    return response()->streamDownload(function () use ($contenido) {
        echo $contenido;
    }, 'plantilla_personas.csv', [
        'Content-Type' => 'text/csv; charset=UTF-8',
    ]);
});

Route::get('/personal/exportar-csv', function () {
    $personas = Persona::orderBy('id_persona')->get();

    $contenido = "\xEF\xBB\xBF";
    $contenido .= "nombres;apellido_paterno;apellido_materno;ci;ci_expedido;direccion;telefono;correo;profesion\n";

    foreach ($personas as $persona) {
        $fila = [
            $persona->nombres,
            $persona->apellido_paterno,
            $persona->apellido_materno,
            $persona->ci,
            $persona->ci_expedido,
            $persona->direccion,
            $persona->telefono,
            $persona->correo,
            $persona->profesion,
        ];

        $fila = array_map(function ($valor) {
            $valor = (string) ($valor ?? '');
            $valor = str_replace('"', '""', $valor);

            return '"' . $valor . '"';
        }, $fila);

        $contenido .= implode(';', $fila) . "\n";
    }

    return response()->streamDownload(function () use ($contenido) {
        echo $contenido;
    }, 'personal_registrado.csv', [
        'Content-Type' => 'text/csv; charset=UTF-8',
    ]);
});

Route::get('/convocatorias', function () {
    return view('convocatorias.index');
});

Route::get('/convocatorias/create', function () {
    return view('convocatorias.create');
});

Route::get('/convocatorias/{id}/edit', function ($id) {
    return view('convocatorias.edit', ['id' => $id]);
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

Route::get('/formularios', function () {
    return view('formularios.index');
});

Route::get('/formularios/preview', function () {
    return view('formularios.preview');
});

Route::get('/formularios/generar', function () {
    return view('formularios.generar');
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