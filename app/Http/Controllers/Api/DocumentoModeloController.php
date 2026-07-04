<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentoModelo;
use Illuminate\Http\Request;

class DocumentoModeloController extends Controller
{
    public function index()
    {
        return DocumentoModelo::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_modelo' => 'required|string|max:150',
            'codigo_modelo' => 'required|string|max:50|unique:documentos_modelo,codigo_modelo',
            'descripcion' => 'nullable|string',
            'archivo_template' => 'required|string|max:255',
            'activo' => 'nullable|boolean',
        ]);

        return DocumentoModelo::create($validated);
    }

    public function show(DocumentoModelo $documentoModelo)
    {
        return $documentoModelo->load('documentosGenerados');
    }

    public function update(Request $request, DocumentoModelo $documentoModelo)
    {
        $validated = $request->validate([
            'nombre_modelo' => 'sometimes|string|max:150',
            'codigo_modelo' => 'sometimes|string|max:50|unique:documentos_modelo,codigo_modelo,' . $documentoModelo->id_documento_modelo . ',id_documento_modelo',
            'descripcion' => 'nullable|string',
            'archivo_template' => 'sometimes|string|max:255',
            'activo' => 'nullable|boolean',
        ]);

        $documentoModelo->update($validated);
        return $documentoModelo;
    }

    public function destroy(DocumentoModelo $documentoModelo)
    {
        $documentoModelo->delete();
        return response()->noContent();
    }
}