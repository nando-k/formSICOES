@extends('layouts.app')

@section('title', 'Generar documentos')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-cyan-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-cyan-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-cyan-300 text-sm font-medium mb-2">
                    Redirección funcional
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Generar documentos de propuesta
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    La generación real de documentos se realiza desde el módulo de formularios y plantillas.
                </p>
            </div>

            <a href="/propuestas" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver a propuestas
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-4xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Continuar con la generación</h4>
            <p class="text-sm text-slate-500 mt-1">
                Seleccione una convocatoria y una plantilla Word desde la pantalla funcional.
            </p>
        </div>

        <div class="p-6">
            <div class="bg-cyan-50 border border-cyan-200 text-cyan-800 rounded-2xl p-5 mb-6 text-sm">
                Para continuar, presione el botón principal. El sistema lo llevará al módulo donde se genera el documento Word real y se registra en el historial.
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="/formularios/generar" class="bg-emerald-600 text-white px-5 py-3 rounded-2xl hover:bg-emerald-500 font-semibold text-center shadow-lg shadow-emerald-950/20">
                    Ir a generar documento
                </a>

                <a href="/documentos" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center font-medium">
                    Ver historial
                </a>

                <a href="/propuestas" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center font-medium">
                    Volver
                </a>
            </div>
        </div>
    </div>

</div>
@endsection