<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentoGenerado;
use Illuminate\Http\Request;

class DocumentoGeneradoController extends Controller
{
    public function index()
    {
        return DocumentoGenerado::with('convocatoria', 'documentoModelo')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_convocatoria' => 'required|exists:convocatorias,id_convocatoria',
            'id_documento_modelo' => 'required|exists:documentos_modelo,id_documento_modelo',
            'nombre_archivo' => 'required|string|max:255',
            'ruta_archivo' => 'required|string|max:255',
            'fecha_generacion' => 'nullable|date',
            'generado_por' => 'nullable|string|max:100',
        ]);

        return DocumentoGenerado::create($validated);
    }

    public function show(DocumentoGenerado $documentoGenerado)
    {
        return $documentoGenerado->load('convocatoria', 'documentoModelo');
    }

    public function update(Request $request, DocumentoGenerado $documentoGenerado)
    {
        $validated = $request->validate([
            'id_convocatoria' => 'sometimes|exists:convocatorias,id_convocatoria',
            'id_documento_modelo' => 'sometimes|exists:documentos_modelo,id_documento_modelo',
            'nombre_archivo' => 'sometimes|string|max:255',
            'ruta_archivo' => 'sometimes|string|max:255',
            'fecha_generacion' => 'nullable|date',
            'generado_por' => 'nullable|string|max:100',
        ]);

        $documentoGenerado->update($validated);
        return $documentoGenerado;
    }

    public function destroy(DocumentoGenerado $documentoGenerado)
    {
        $documentoGenerado->delete();
        return response()->noContent();
    }
}