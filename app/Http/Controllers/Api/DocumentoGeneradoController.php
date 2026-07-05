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
            'id_convocatoria' => 'required|exists:contratacion.convocatorias,id_convocatoria',   // ← CAMBIAR
            'id_documento_modelo' => 'required|exists:documentacion.documentos_modelo,id_documento_modelo', // ← CAMBIAR
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
            'id_convocatoria' => 'sometimes|exists:contratacion.convocatorias,id_convocatoria',   // ← CAMBIAR
            'id_documento_modelo' => 'sometimes|exists:documentacion.documentos_modelo,id_documento_modelo', // ← CAMBIAR
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