@extends('layouts.app')

@section('title', 'Generar documentos')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-1">Seleccionar formularios</h3>
        <p class="text-sm text-slate-500 mb-6">
            Seleccione los documentos que desea generar para la propuesta.
        </p>

        <div class="space-y-3">
            @php
                $formularios = [
                    'Carta de presentación de la propuesta técnica',
                    'Identificación del proponente',
                    'Declaración jurada',
                    'Declaración de integridad del proponente',
                    'Declaración de independencia del proponente',
                    'Carta de presentación de la propuesta económica',
                ];
            @endphp

            @foreach ($formularios as $formulario)
                <label class="flex items-center gap-3 border rounded-lg p-4 hover:bg-slate-50 cursor-pointer">
                    <input type="checkbox" checked class="w-4 h-4">
                    <span>{{ $formulario }}</span>
                </label>
            @endforeach
        </div>

        <div class="flex justify-end mt-6">
            <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                Generar documentos
            </button>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-4">Resumen de propuesta</h3>

        <div class="space-y-4 text-sm">
            <div>
                <p class="text-slate-500">Empresa</p>
                <p class="font-medium">CIDSAF S.R.L.</p>
            </div>

            <div>
                <p class="text-slate-500">Entidad</p>
                <p class="font-medium">Caja Nacional de Salud</p>
            </div>

            <div>
                <p class="text-slate-500">Convocatoria</p>
                <p class="font-medium">CH LP - 085/2023</p>
            </div>

            <div>
                <p class="text-slate-500">CUCE</p>
                <p class="font-medium">23-1404-00-1345364-1-1</p>
            </div>

            <div>
                <p class="text-slate-500">Monto</p>
                <p class="font-medium">Bs. 41.500</p>
            </div>

            <div>
                <p class="text-slate-500">Estado</p>
                <span class="inline-block px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700">
                    Borrador
                </span>
            </div>
        </div>
    </div>

</div>
@endsection