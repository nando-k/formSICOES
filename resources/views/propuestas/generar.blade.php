@extends('layouts.app')

@section('title', 'Generar documentos')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6 max-w-4xl">
    <h3 class="text-lg font-semibold mb-1">Generar documentos de propuesta</h3>
    <p class="text-sm text-slate-500 mb-6">
        La generación de documentos se realiza desde el módulo de formularios, seleccionando una convocatoria y una plantilla Word.
    </p>

    <div class="bg-blue-50 border border-blue-200 text-blue-700 rounded-lg p-4 mb-6 text-sm">
        Para continuar, presione el botón siguiente y el sistema lo llevará a la pantalla funcional de generación de documentos.
    </div>

    <div class="flex gap-3">
        <a href="/formularios/generar" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
            Ir a generar documento
        </a>

        <a href="/documentos" class="px-5 py-2 rounded-lg border hover:bg-slate-50">
            Ver historial
        </a>

        <a href="/propuestas" class="px-5 py-2 rounded-lg border hover:bg-slate-50">
            Volver
        </a>
    </div>
</div>
@endsection