@extends('layouts.app')

@section('title', 'Formularios y plantillas')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Formularios disponibles</h3>
        <p class="text-sm text-slate-500">
            Seleccione los modelos que serán usados para generar documentos.
        </p>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nueva plantilla
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
    @php
        $formularios = [
            [
                'codigo' => 'Modelo Nº 3',
                'nombre' => 'Carta de presentación de la propuesta técnica',
                'descripcion' => 'Documento principal para presentar formalmente la propuesta técnica.',
                'estado' => 'Activo'
            ],
            [
                'codigo' => 'Modelo Nº 4',
                'nombre' => 'Identificación del proponente',
                'descripcion' => 'Formulario con los datos generales de la empresa proponente.',
                'estado' => 'Activo'
            ],
            [
                'codigo' => 'Modelo Nº 5',
                'nombre' => 'Declaración jurada',
                'descripcion' => 'Documento legal donde el proponente declara el cumplimiento de requisitos.',
                'estado' => 'Activo'
            ],
            [
                'codigo' => 'Modelo Nº 7',
                'nombre' => 'Declaración de integridad del proponente',
                'descripcion' => 'Formulario de integridad firmado por los participantes de la propuesta.',
                'estado' => 'Activo'
            ],
            [
                'codigo' => 'Modelo Nº 8',
                'nombre' => 'Declaración de independencia',
                'descripcion' => 'Documento donde se declara independencia respecto a la entidad convocante.',
                'estado' => 'Activo'
            ],
            [
                'codigo' => 'Modelo Nº 11',
                'nombre' => 'Carta de presentación de la propuesta económica',
                'descripcion' => 'Carta donde se presenta el monto económico ofertado.',
                'estado' => 'Activo'
            ],
        ];
    @endphp

    @foreach ($formularios as $formulario)
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <div class="flex justify-between items-start gap-3 mb-4">
                <div>
                    <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
                        {{ $formulario['codigo'] }}
                    </span>
                    <h4 class="font-semibold mt-3 leading-snug">
                        {{ $formulario['nombre'] }}
                    </h4>
                </div>

                <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">
                    {{ $formulario['estado'] }}
                </span>
            </div>

            <p class="text-sm text-slate-500 mb-5">
                {{ $formulario['descripcion'] }}
            </p>

            <div class="flex justify-end gap-2">
                <a href="/formularios/preview" class="px-3 py-2 text-sm rounded-lg border hover:bg-slate-50">
                    Vista previa
                </a>
                <button class="px-3 py-2 text-sm rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                    Usar plantilla
                </button>
            </div>
        </div>
    @endforeach
</div>
@endsection