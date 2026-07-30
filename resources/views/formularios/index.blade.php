@extends('layouts.app')

@section('title', 'Formularios y plantillas')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Formularios y plantillas disponibles</h3>
        <p class="text-sm text-slate-500">
            Modelos Word registrados en el sistema para generar documentos.
        </p>
    </div>

    <a href="/formularios/generar" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
        Generar documento
    </a>
</div>

<div id="loading" class="bg-white border rounded-xl p-6 text-slate-500">
    Cargando formularios...
</div>

<div id="formularios-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 hidden"></div>

<div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-xl p-5">
    No se pudieron cargar los formularios desde la API.
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
                <div class="bg-white rounded-xl border p-6 text-slate-500">
                    No hay formularios registrados.
                </div>
            `;
            return;
        }

        grid.innerHTML = formularios.map(formulario => {
            const activo = formulario.activo === true || formulario.activo === 1;

            const estadoTexto = activo ? 'Activo' : 'Inactivo';
            const estadoClase = activo
                ? 'bg-green-100 text-green-700'
                : 'bg-red-100 text-red-700';

            return `
                <div class="bg-white rounded-xl shadow-sm border p-5 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start gap-3 mb-4">
                            <div>
                                <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
                                    ${formulario.codigo_modelo ?? 'Modelo'}
                                </span>

                                <h4 class="font-semibold mt-3 leading-snug text-slate-800">
                                    ${formulario.nombre_modelo ?? 'Formulario sin nombre'}
                                </h4>
                            </div>

                            <span class="text-xs px-2 py-1 rounded-full ${estadoClase}">
                                ${estadoTexto}
                            </span>
                        </div>

                        <p class="text-sm text-slate-500 mb-4">
                            ${formulario.descripcion ?? 'Plantilla Word disponible para generar documentos.'}
                        </p>

                        <div class="text-xs text-slate-400 border rounded-lg p-3 bg-slate-50 mb-5">
                            Archivo base:
                            <span class="font-medium text-slate-600">
                                ${formulario.archivo_template ?? 'Sin archivo registrado'}
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="/formularios/generar" class="px-3 py-2 text-sm rounded-lg bg-slate-900 text-white hover:bg-slate-800">
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