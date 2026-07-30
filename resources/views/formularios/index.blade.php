@extends('layouts.app')

@section('title', 'Formularios y plantillas')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-teal-950 via-slate-900 to-emerald-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-emerald-300 text-sm font-medium mb-2">
                    Plantillas Word
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Formularios y plantillas
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Modelos Word registrados en el sistema para generar documentos automáticamente desde convocatorias.
                </p>
            </div>

            <a href="/formularios/generar" class="bg-emerald-500 text-white px-5 py-3 rounded-2xl hover:bg-emerald-400 shadow-lg shadow-emerald-950/30 font-semibold text-center">
                Generar documento
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando formularios...
    </div>

    <div id="formularios-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 hidden"></div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudieron cargar los formularios desde la API.
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const grid = document.getElementById('formularios-grid');
    const error = document.getElementById('error');

    try {
        const response = await fetch('/api/documentos-modelo');
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || 'Error al cargar documentos modelo');
        }

        const formularios = Array.isArray(data) ? data : data.data ?? [];

        loading.classList.add('hidden');
        grid.classList.remove('hidden');

        if (formularios.length === 0) {
            grid.innerHTML = `
                <div class="bg-white rounded-3xl border border-slate-200 p-6 text-slate-500 shadow-sm">
                    No hay formularios registrados.
                </div>
            `;
            return;
        }

        grid.innerHTML = formularios.map(formulario => {
            const activo = formulario.activo === true || formulario.activo === 1;

            const estadoTexto = activo ? 'Activo' : 'Inactivo';
            const estadoClase = activo
                ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                : 'bg-red-50 text-red-700 border-red-200';

            return `
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between hover:shadow-lg hover:-translate-y-1 transition">
                    <div>
                        <div class="flex justify-between items-start gap-3 mb-5">
                            <div>
                                <span class="text-xs font-semibold text-teal-700 bg-teal-50 border border-teal-100 px-3 py-1 rounded-full">
                                    ${formulario.codigo_modelo ?? 'Modelo'}
                                </span>

                                <h4 class="font-bold mt-4 leading-snug text-slate-900 text-lg">
                                    ${formulario.nombre_modelo ?? 'Formulario sin nombre'}
                                </h4>
                            </div>

                            <span class="text-xs px-3 py-1 rounded-full border font-medium ${estadoClase}">
                                ${estadoTexto}
                            </span>
                        </div>

                        <p class="text-sm text-slate-500 mb-5 leading-relaxed">
                            ${formulario.descripcion ?? 'Plantilla Word disponible para generar documentos.'}
                        </p>

                        <div class="text-xs text-slate-500 border border-slate-100 rounded-2xl p-4 bg-slate-50 mb-5">
                            <p class="font-medium text-slate-700 mb-1">Archivo base</p>
                            <p class="break-all">
                                ${formulario.archivo_template ?? 'Sin archivo registrado'}
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="/formularios/generar?modelo=${formulario.id_documento_modelo}" class="px-4 py-3 text-sm rounded-2xl bg-slate-900 text-white hover:bg-slate-800 font-semibold">
                            Usar plantilla
                        </a>
                    </div>
                </div>
            `;
        }).join('');

    } catch (e) {
        loading.classList.add('hidden');
        error.classList.remove('hidden');
        console.error(e);
    }
});
</script>
@endsection