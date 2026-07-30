@extends('layouts.app')

@section('title', 'Propuestas')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Propuestas</h3>
        <p class="text-sm text-slate-500">
            Módulo de apoyo para la generación documental de propuestas.
        </p>
    </div>

    <a href="/formularios/generar" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
        Generar documentos
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-2">Flujo de trabajo</h3>
        <p class="text-sm text-slate-500 mb-6">
            Para generar una propuesta documental, primero registre la empresa, entidad y convocatoria. Luego seleccione una plantilla Word y genere el documento final.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="/empresas/create" class="border rounded-xl p-5 hover:bg-slate-50">
                <p class="font-semibold text-slate-800">1. Registrar empresa</p>
                <p class="text-sm text-slate-500 mt-1">Datos del proponente.</p>
            </a>

            <a href="/entidades/create" class="border rounded-xl p-5 hover:bg-slate-50">
                <p class="font-semibold text-slate-800">2. Registrar entidad</p>
                <p class="text-sm text-slate-500 mt-1">Datos de la entidad convocante.</p>
            </a>

            <a href="/convocatorias/create" class="border rounded-xl p-5 hover:bg-slate-50">
                <p class="font-semibold text-slate-800">3. Crear convocatoria</p>
                <p class="text-sm text-slate-500 mt-1">Relaciona empresa, entidad y datos de contratación.</p>
            </a>

            <a href="/formularios/generar" class="border rounded-xl p-5 hover:bg-slate-50">
                <p class="font-semibold text-green-700">4. Generar documento Word</p>
                <p class="text-sm text-slate-500 mt-1">Selecciona convocatoria y plantilla.</p>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h3 class="font-semibold mb-4">Acciones rápidas</h3>

        <div class="space-y-3 text-sm">
            <a href="/formularios/generar" class="block bg-green-600 text-white text-center px-4 py-3 rounded-lg hover:bg-green-700">
                Generar documento
            </a>

            <a href="/documentos" class="block border text-center px-4 py-3 rounded-lg hover:bg-slate-50">
                Ver documentos generados
            </a>

            <a href="/convocatorias" class="block border text-center px-4 py-3 rounded-lg hover:bg-slate-50">
                Ver convocatorias
            </a>
        </div>

        <div class="mt-6 text-xs text-slate-500 bg-slate-50 border rounded-lg p-4">
            El sistema genera documentos Word usando los datos registrados de la convocatoria y las plantillas disponibles.
        </div>
    </div>
</div>
@endsection