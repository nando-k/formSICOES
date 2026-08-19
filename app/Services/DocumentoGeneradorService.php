<?php

namespace App\Services;

use App\Models\Convocatoria;
use App\Models\DocumentoGenerado;
use App\Models\DocumentoModelo;
use App\Models\PlantillaCampo;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentoGeneradorService
{
    public function generar(Convocatoria $convocatoria, DocumentoModelo $documentoModelo): DocumentoGenerado
    {
        $rutaPlantilla = storage_path('app/plantillas/' . $documentoModelo->archivo_template);

        if (!file_exists($rutaPlantilla)) {
            throw new \Exception("No se encontró la plantilla: {$documentoModelo->archivo_template}");
        }

        $processor = new TemplateProcessor($rutaPlantilla);

        $convocatoria->load(
            'entidad',
            'proponente.representanteLegal',
            'personas'
        );

        $entidad = $convocatoria->entidad;
        $proponente = $convocatoria->proponente;
        $representante = $proponente?->representanteLegal;

        $valoresDirectos = [
            // Entidad
            'nombre_entidad' => $entidad?->nombre_entidad ?? '',
            'ciudad_entidad' => $entidad?->ciudad ?? '',
            'direccion_entidad' => $entidad?->direccion ?? '',
            'telefono_entidad' => $entidad?->telefono ?? '',
            'correo_entidad' => $entidad?->correo ?? '',
            'contacto_entidad' => $entidad?->contacto ?? '',
            'cargo_contacto_entidad' => $entidad?->cargo_contacto ?? '',

            // Convocatoria
            'cite' => $convocatoria->cite ?? '',
            'numero_convocatoria' => $convocatoria->numero_convocatoria ?? '',
            'cuce' => $convocatoria->cuce ?? '',
            'objeto_contratacion' => $convocatoria->objeto ?? '',
            'lugar_entrega' => $convocatoria->lugar_entrega ?? '',
            'fecha_presentacion' => $this->formatearFecha($convocatoria->fecha_presentacion),
            'fecha_apertura' => $this->formatearFecha($convocatoria->fecha_apertura),
            'hora_apertura' => $convocatoria->hora_apertura ?? '',
            'monto_propuesta' => $convocatoria->monto ?? '',
            'monto_literal' => $convocatoria->monto_literal ?? '',
            'plazo_propuesta_dias' => $convocatoria->plazo_propuesta_dias ?? '',
            'estado' => $convocatoria->estado ?? '',

            // Proponente / empresa
            'razon_social' => $proponente?->razon_social ?? '',
            'nombre_comercial' => $proponente?->nombre_comercial ?? '',
            'nit' => $proponente?->nit ?? '',
            'matricula_comercio' => $proponente?->matricula_comercio ?? '',
            'direccion_proponente' => $proponente?->direccion ?? '',
            'ciudad_proponente' => $proponente?->ciudad ?? '',
            'pais_proponente' => $proponente?->pais ?? '',
            'telefono_proponente' => $proponente?->telefono ?? '',
            'correo_proponente' => $proponente?->correo ?? '',
            'tipo_organizacion' => $proponente?->tipo_organizacion ?? '',

            // Representante legal
            'nombre_representante' => $representante?->nombres ?? '',
            'apellido_representante' => $representante?->apellido_paterno ?? '',
            'apellido_materno_representante' => $representante?->apellido_materno ?? '',
            'ci_representante' => trim(($representante?->ci ?? '') . ' ' . ($representante?->ci_expedido ?? '')),
            'direccion_representante' => $representante?->direccion ?? '',
            'telefono_representante' => $representante?->telefono ?? '',
            'correo_representante' => $representante?->correo ?? '',
            'profesion_representante' => $representante?->profesion ?? '',
        ];

        foreach ($valoresDirectos as $campo => $valor) {
            $processor->setValue($campo, $this->limpiarValor($valor));
        }

        // Mantiene compatibilidad con campos registrados en la tabla plantilla_campos
        $this->reemplazarCamposCatalogados($processor, $convocatoria);

        // Reemplazos extra por si alguna plantilla tiene variables partidas con espacios raros
        $this->reemplazarVariablesRotas($processor, $valoresDirectos);

        $nombreArchivo = $documentoModelo->codigo_modelo . '_' . $convocatoria->id_convocatoria . '_' . time() . '.docx';

        $directorioGenerados = storage_path('app/generados');

        if (!is_dir($directorioGenerados)) {
            mkdir($directorioGenerados, 0755, true);
        }

        $rutaDestino = $directorioGenerados . DIRECTORY_SEPARATOR . $nombreArchivo;

        $processor->saveAs($rutaDestino);

        return DocumentoGenerado::create([
            'id_convocatoria' => $convocatoria->id_convocatoria,
            'id_documento_modelo' => $documentoModelo->id_documento_modelo,
            'nombre_archivo' => $nombreArchivo,
            'ruta_archivo' => 'generados/' . $nombreArchivo,
            'fecha_generacion' => now(),
            'generado_por' => auth()->user()->name ?? 'sistema',
        ]);
    }

    private function reemplazarCamposCatalogados(TemplateProcessor $processor, Convocatoria $convocatoria): void
    {
        $valores = [
            'entidades' => $convocatoria->entidad?->toArray() ?? [],
            'convocatorias' => $convocatoria->toArray(),
            'proponentes' => $convocatoria->proponente?->toArray() ?? [],
            'personas' => $convocatoria->proponente?->representanteLegal?->toArray() ?? [],
        ];

        $campos = PlantillaCampo::all();

        foreach ($campos as $campo) {
            $tabla = $campo->tabla_origen;
            $columna = $campo->campo_origen;
            $valor = $valores[$tabla][$columna] ?? '';

            $processor->setValue($campo->nombre_campo, $this->limpiarValor($valor));
        }
    }

    private function reemplazarVariablesRotas(TemplateProcessor $processor, array $valores): void
    {
        foreach ($valores as $campo => $valor) {
            $valor = $this->limpiarValor($valor);

            // Algunas plantillas tienen variables escritas como "$ {razon_social}"
            $processor->setValue('$ {' . $campo . '}', $valor);
            $processor->setValue('$' . "\n" . '{' . $campo . '}', $valor);
            $processor->setValue('$ ' . "\n" . '{' . $campo . '}', $valor);
        }
    }

    private function limpiarValor($valor): string
    {
        if ($valor === null) {
            return '';
        }

        return trim((string) $valor);
    }

    private function formatearFecha($fecha): string
    {
        if (!$fecha) {
            return '';
        }

        try {
            return \Carbon\Carbon::parse($fecha)->format('d/m/Y');
        } catch (\Throwable $e) {
            return (string) $fecha;
        }
    }
}