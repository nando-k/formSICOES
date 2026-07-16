<?php

namespace App\Services;

use App\Models\Convocatoria;
use App\Models\DocumentoGenerado;
use App\Models\DocumentoModelo;
use App\Models\PlantillaCampo;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentoGeneradorService
{
    public function generar(Convocatoria $convocatoria, DocumentoModelo $documentoModelo): DocumentoGenerado
    {
        $rutaPlantilla = storage_path('app/plantillas/' . $documentoModelo->archivo_template);

        if (!file_exists($rutaPlantilla)) {
            throw new \Exception("No se encontro la plantilla: {$documentoModelo->archivo_template}");
        }

        $processor = new TemplateProcessor($rutaPlantilla);

        // Traemos los datos relacionados que vamos a necesitar
        $convocatoria->load('entidad', 'proponente.representanteLegal');

        // Armamos el "diccionario" de valores disponibles, por tabla de origen
        $valores = [
            'entidades' => $convocatoria->entidad?->toArray() ?? [],
            'convocatorias' => $convocatoria->toArray(),
            'proponentes' => $convocatoria->proponente?->toArray() ?? [],
            'personas' => $convocatoria->proponente?->representanteLegal?->toArray() ?? [],
        ];

        // Recorremos el catalogo de campos y reemplazamos cada uno
        $campos = PlantillaCampo::all();

        foreach ($campos as $campo) {
            $tabla = $campo->tabla_origen;
            $columna = $campo->campo_origen;
            $valor = $valores[$tabla][$columna] ?? '';

            $processor->setValue($campo->nombre_campo, (string) $valor);
        }

        // Guardamos el archivo generado con un nombre unico
        $nombreArchivo = $documentoModelo->codigo_modelo . '_' . $convocatoria->id_convocatoria . '_' . time() . '.docx';
        $rutaDestino = storage_path('app/generados/' . $nombreArchivo);
        $processor->saveAs($rutaDestino);

        // Registramos el documento generado en la base
        return DocumentoGenerado::create([
            'id_convocatoria' => $convocatoria->id_convocatoria,
            'id_documento_modelo' => $documentoModelo->id_documento_modelo,
            'nombre_archivo' => $nombreArchivo,
            'ruta_archivo' => 'generados/' . $nombreArchivo,
            'fecha_generacion' => now(),
            'generado_por' => auth()->user()->name ?? 'sistema',
        ]);
    }
}