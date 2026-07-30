@extends('layouts.app')

@section('title', 'Convocatorias')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Listado de convocatorias</h3>
        <p class="text-sm text-slate-500">
            Registre y administre las convocatorias disponibles.
        </p>
    </div>

    <a href="/convocatorias/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nueva convocatoria
    </a>
</div>

<div id="loading" class="bg-white border rounded-xl p-6 text-slate-500">
    Cargando convocatorias...
</div>

<div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-xl p-5">
    No se pudieron cargar las convocatorias.
</div>

<div id="tablaContainer" class="hidden bg-white rounded-xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                <th class="text-left px-5 py-3">Nro. Convocatoria</th>
                <th class="text-left px-5 py-3">Entidad</th>
                <th class="text-left px-5 py-3">Empresa / Proponente</th>
                <th class="text-left px-5 py-3">Objeto</th>
                <th class="text-left px-5 py-3">CUCE</th>
                <th class="text-left px-5 py-3">Fecha apertura</th>
                <th class="text-left px-5 py-3">Estado</th>
                <th class="text-left px-5 py-3">Acciones</th>
            </tr>
        </thead>

        <tbody id="convocatoriasBody"></tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const convocatoriasBody = document.getElementById('convocatoriasBody');

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

        if (convocatorias.length === 0) {
            convocatoriasBody.innerHTML = `
                <tr>
                    <td colspan="8" class="px-5 py-6 text-center text-slate-500">
                        No hay convocatorias registradas todavía.
                    </td>
                </tr>
            `;
            return;
        }

        convocatoriasBody.innerHTML = convocatorias.map(item => {
            const id = item.id_convocatoria;

            const entidad =
                item.entidad?.nombre_entidad ??
                'Sin entidad';

            const proponente =
                item.proponente?.razon_social ??
                item.proponente?.nombre_comercial ??
                'Sin proponente';

            const estado = item.estado ?? 'Sin estado';

            let estadoClase = 'bg-slate-100 text-slate-700';

            if (estado.toLowerCase() === 'borrador') {
                estadoClase = 'bg-yellow-100 text-yellow-700';
            }

            if (estado.toLowerCase() === 'activa') {
                estadoClase = 'bg-green-100 text-green-700';
            }

            if (estado.toLowerCase() === 'cerrada') {
                estadoClase = 'bg-red-100 text-red-700';
            }

            return `
                <tr class="border-t">
                    <td class="px-5 py-3 font-medium text-slate-800">
                        ${item.numero_convocatoria ?? 'Sin número'}
                    </td>

                    <td class="px-5 py-3">
                        ${entidad}
                    </td>

                    <td class="px-5 py-3">
                        ${proponente}
                    </td>

                    <td class="px-5 py-3 max-w-xs">
                        <span class="line-clamp-2">
                            ${item.objeto ?? 'Sin objeto'}
                        </span>
                    </td>

                    <td class="px-5 py-3">
                        ${item.cuce ?? '-'}
                    </td>

                    <td class="px-5 py-3">
                        ${item.fecha_apertura ?? '-'}
                    </td>

                    <td class="px-5 py-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${estadoClase}">
                            ${estado}
                        </span>
                    </td>

                    <td class="px-5 py-3 space-x-2">
                        <a href="/formularios/generar" class="text-green-600 hover:underline">
                            Generar documento
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