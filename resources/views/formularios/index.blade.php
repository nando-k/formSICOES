@extends('layouts.app')

@section('title', 'Formularios y plantillas')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Formularios disponibles</h3>
        <p class="text-sm text-slate-500">
            Modelos cargados desde la base de datos.
        </p>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nueva plantilla
    </button>
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

        if (!response.ok) {
            throw new Error('Error al cargar documentos modelo');
        }

        const data = await response.json();
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

        grid.innerHTML = formularios.map(formulario => `
            <div class="bg-white rounded-xl shadow-sm border p-5">
                <div class="flex justify-between items-start gap-3 mb-4">
                    <div>
                        <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
                            ${formulario.codigo_modelo ?? formulario.codigo ?? 'Modelo'}
                        </span>

                        <h4 class="font-semibold mt-3 leading-snug">
                            ${formulario.nombre_modelo ?? formulario.nombre ?? 'Formulario sin nombre'}
                        </h4>
                    </div>

                    <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">
                        Activo
                    </span>
                </div>

                <p class="text-sm text-slate-500 mb-5">
                    ${formulario.descripcion ?? 'Sin descripción registrada.'}
                </p>

                <div class="flex justify-end gap-2">
                    <a href="/formularios/preview" class="px-3 py-2 text-sm rounded-lg border hover:bg-slate-50">
                        Vista previa
                    </a>

                    <a href="/formularios/generar" class="px-3 py-2 text-sm rounded-lg bg-slate-900 text-white hover:bg-slate-800">
                        Usar plantilla
                    </a>
                </div>
            </div>
        `).join('');

    } catch (e) {
        loading.classList.add('hidden');
        error.classList.remove('hidden');
        console.error(e);
    }
});
</script>
@endsection