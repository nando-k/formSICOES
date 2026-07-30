@extends('layouts.app')

@section('title', 'Propuestas')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-cyan-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-cyan-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-cyan-300 text-sm font-medium mb-2">
                    Flujo documental
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Propuestas
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Módulo de apoyo para organizar el proceso de generación documental de propuestas de auditoría.
                </p>
            </div>

            <a href="/formularios/generar" class="bg-cyan-500 text-white px-5 py-3 rounded-2xl hover:bg-cyan-400 shadow-lg shadow-cyan-950/30 font-semibold text-center">
                Generar documentos
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100">
                <h4 class="font-bold text-slate-900">Flujo de trabajo</h4>
                <p class="text-sm text-slate-500 mt-1">
                    Siga estos pasos para generar documentos Word desde datos registrados.
                </p>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="/empresas/create" class="group border border-slate-200 rounded-3xl p-5 hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-11 h-11 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center font-black mb-4">
                        1
                    </div>

                    <p class="font-bold text-slate-900">Registrar empresa</p>
                    <p class="text-sm text-slate-500 mt-1">
                        Datos del proponente que participará en la convocatoria.
                    </p>
                </a>

                <a href="/entidades/create" class="group border border-slate-200 rounded-3xl p-5 hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-11 h-11 rounded-2xl bg-purple-50 text-purple-700 flex items-center justify-center font-black mb-4">
                        2
                    </div>

                    <p class="font-bold text-slate-900">Registrar entidad</p>
                    <p class="text-sm text-slate-500 mt-1">
                        Datos de la institución o entidad convocante.
                    </p>
                </a>

                <a href="/convocatorias/create" class="group border border-slate-200 rounded-3xl p-5 hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center font-black mb-4">
                        3
                    </div>

                    <p class="font-bold text-slate-900">Crear convocatoria</p>
                    <p class="text-sm text-slate-500 mt-1">
                        Relaciona empresa, entidad y datos del proceso.
                    </p>
                </a>

                <a href="/formularios/generar" class="group rounded-3xl p-5 bg-gradient-to-br from-emerald-500 to-teal-500 text-white hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="w-11 h-11 rounded-2xl bg-white/20 text-white flex items-center justify-center font-black mb-4">
                        4
                    </div>

                    <p class="font-bold">Generar documento Word</p>
                    <p class="text-sm text-emerald-50 mt-1">
                        Selecciona una plantilla y genera el archivo final.
                    </p>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100">
                <h4 class="font-bold text-slate-900">Acciones rápidas</h4>
                <p class="text-sm text-slate-500 mt-1">
                    Acceda a las funciones principales.
                </p>
            </div>

            <div class="p-6 space-y-3 text-sm">
                <a href="/formularios/generar" class="block bg-emerald-600 text-white text-center px-4 py-3 rounded-2xl hover:bg-emerald-500 font-semibold shadow-lg shadow-emerald-950/20">
                    Generar documento
                </a>

                <a href="/documentos" class="block border border-slate-200 text-center px-4 py-3 rounded-2xl hover:bg-slate-50 font-medium">
                    Ver documentos generados
                </a>

                <a href="/convocatorias" class="block border border-slate-200 text-center px-4 py-3 rounded-2xl hover:bg-slate-50 font-medium">
                    Ver convocatorias
                </a>
            </div>

            <div class="mx-6 mb-6 text-xs text-slate-600 bg-slate-50 border border-slate-100 rounded-2xl p-4">
                El sistema genera documentos Word usando los datos registrados de la convocatoria y las plantillas disponibles.
            </div>
        </div>

    </div>

</div>
@endsection