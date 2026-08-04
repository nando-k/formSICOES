@extends('layouts.app')

@section('title', 'Entidades')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-purple-950 via-slate-900 to-indigo-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-purple-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-purple-300 text-sm font-medium mb-2">
                    Entidades convocantes
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Entidades
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Administre las instituciones o entidades convocantes utilizadas en los procesos de contratación.
                </p>
            </div>

            <a href="/entidades/create" class="bg-purple-500 text-white px-5 py-3 rounded-2xl hover:bg-purple-400 shadow-lg shadow-purple-950/30 font-semibold text-center">
                Nueva entidad
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando entidades...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudieron cargar las entidades.
    </div>

    <div id="tablaContainer" class="hidden bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h4 class="font-bold text-slate-900">Listado de entidades</h4>
                <p class="text-sm text-slate-500">Instituciones cargadas desde la API.</p>
            </div>

            <span id="totalEntidades" class="text-sm bg-purple-50 text-purple-700 px-3 py-1 rounded-full font-medium">
                0 registros
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="text-left px-6 py-4">Entidad</th>
                        <th class="text-left px-6 py-4">Ciudad</th>
                        <th class="text-left px-6 py-4">Teléfono</th>
                        <th class="text-left px-6 py-4">Correo</th>
                        <th class="text-left px-6 py-4">Contacto</th>
                        <th class="text-left px-6 py-4">Acción</th>
                    </tr>
                </thead>

                <tbody id="entidadesBody"></tbody>
            </table>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const entidadesBody = document.getElementById('entidadesBody');
    const totalEntidades = document.getElementById('totalEntidades');

    try {
        const response = await fetch('/api/entidades');
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || 'No se pudieron cargar las entidades.');
        }

        const entidades = Array.isArray(data) ? data : data.data ?? [];

        loading.classList.add('hidden');
        tablaContainer.classList.remove('hidden');

        totalEntidades.textContent = `${entidades.length} registro${entidades.length === 1 ? '' : 's'}`;

        if (entidades.length === 0) {
            entidadesBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                        No hay entidades registradas todavía.
                    </td>
                </tr>
            `;
            return;
        }

        entidadesBody.innerHTML = entidades.map(entidad => {
            const nombre = entidad.nombre_entidad ?? 'Entidad sin nombre';
            const inicial = nombre.trim().charAt(0).toUpperCase();

            return `
                <tr class="border-t border-slate-100 hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-purple-50 text-purple-700 flex items-center justify-center font-bold">
                                ${inicial}
                            </div>

                            <div>
                                <p class="font-semibold text-slate-900">
                                    ${nombre}
                                </p>

                                <p class="text-xs text-slate-500">
                                    ${entidad.direccion ?? 'Sin dirección registrada'}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        ${entidad.ciudad ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        ${entidad.telefono ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        ${entidad.correo ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        ${entidad.contacto ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        <a href="/convocatorias/create?entidad=${entidad.id_entidad}" class="inline-flex px-3 py-2 rounded-xl bg-purple-600 text-white hover:bg-purple-500 text-sm font-semibold">
                            Crear convocatoria
                        </a>
                    </td>
                </tr>
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