@extends('layouts.app')

@section('title', 'Convocatorias')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-amber-950 via-slate-900 to-orange-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-amber-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-amber-300 text-sm font-medium mb-2">
                    Procesos de contratación
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Convocatorias
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Administre las convocatorias disponibles y genere documentos Word relacionados.
                </p>
            </div>

            <a href="/convocatorias/create" class="bg-amber-500 text-white px-5 py-3 rounded-2xl hover:bg-amber-400 shadow-lg shadow-amber-950/30 font-semibold text-center">
                Nueva convocatoria
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando convocatorias...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudieron cargar las convocatorias.
    </div>

    <div id="tablaContainer" class="hidden bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h4 class="font-bold text-slate-900">Listado de convocatorias</h4>
                <p class="text-sm text-slate-500">Datos cargados desde la API.</p>
            </div>

            <span id="totalConvocatorias" class="text-sm bg-amber-50 text-amber-700 px-3 py-1 rounded-full font-medium">
                0 registros
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="text-left px-6 py-4">Convocatoria</th>
                        <th class="text-left px-6 py-4">Entidad</th>
                        <th class="text-left px-6 py-4">Empresa</th>
                        <th class="text-left px-6 py-4">Objeto</th>
                        <th class="text-left px-6 py-4">CUCE</th>
                        <th class="text-left px-6 py-4">Apertura</th>
                        <th class="text-left px-6 py-4">Estado</th>
                        <th class="text-left px-6 py-4">Acción</th>
                    </tr>
                </thead>

                <tbody id="convocatoriasBody"></tbody>
            </table>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const convocatoriasBody = document.getElementById('convocatoriasBody');
    const totalConvocatorias = document.getElementById('totalConvocatorias');

    function obtenerEstadoClase(estado) {
        const valor = (estado ?? '').toLowerCase();

        if (valor === 'borrador') {
            return 'bg-yellow-50 text-yellow-700 border-yellow-200';
        }

        if (valor === 'activa' || valor === 'en revisión') {
            return 'bg-green-50 text-green-700 border-green-200';
        }

        if (valor === 'cerrada' || valor === 'finalizada') {
            return 'bg-red-50 text-red-700 border-red-200';
        }

        return 'bg-slate-50 text-slate-700 border-slate-200';
    }

    try {
        const response = await fetch('/api/convocatorias');
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || 'No se pudieron cargar las convocatorias.');
        }

        const convocatorias = Array.isArray(data) ? data : data.data ?? [];

        loading.classList.add('hidden');
        tablaContainer.classList.remove('hidden');

        totalConvocatorias.textContent = `${convocatorias.length} registro${convocatorias.length === 1 ? '' : 's'}`;

        if (convocatorias.length === 0) {
            convocatoriasBody.innerHTML = `
                <tr>
                    <td colspan="8" class="px-6 py-8 text-center text-slate-500">
                        No hay convocatorias registradas todavía.
                    </td>
                </tr>
            `;
            return;
        }

        convocatoriasBody.innerHTML = convocatorias.map(item => {
            const entidad = item.entidad?.nombre_entidad ?? 'Sin entidad';
            const proponente = item.proponente?.razon_social ?? item.proponente?.nombre_comercial ?? 'Sin proponente';
            const estado = item.estado ?? 'Sin estado';
            const estadoClase = obtenerEstadoClase(estado);

            return `
                <tr class="border-t border-slate-100 hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <p class="font-semibold text-slate-900">
                            ${item.numero_convocatoria ?? 'Sin número'}
                        </p>
                        <p class="text-xs text-slate-500">
                            ${item.cite ?? 'Sin CITE'}
                        </p>
                    </td>

                    <td class="px-6 py-4">
                        ${entidad}
                    </td>

                    <td class="px-6 py-4">
                        ${proponente}
                    </td>

                    <td class="px-6 py-4 max-w-xs">
                        <span class="line-clamp-2">
                            ${item.objeto ?? 'Sin objeto'}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        ${item.cuce ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        ${item.fecha_apertura ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium border ${estadoClase}">
                            ${estado}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <a href="/formularios/generar" class="inline-flex px-3 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-sm">
                            Generar
                        </a>
                    </td>
                </tr>
            `;
        }).join('');

    } catch (e) {
        console.error(e);
        loading.classList.add('hidden');
        error.classList.remove('hidden');
    }
});
</script>
@endsection