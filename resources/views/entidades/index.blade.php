@extends('layouts.app')

@section('title', 'Entidades')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Entidades registradas</h3>
        <p class="text-sm text-slate-500">Instituciones o entidades convocantes cargadas desde la API.</p>
    </div>

    <a href="/entidades/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nueva entidad
    </a>
</div>

<div id="loading" class="bg-white border rounded-xl p-6 text-slate-500">
    Cargando entidades...
</div>

<div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-xl p-5">
    No se pudieron cargar las entidades.
</div>

<div id="tablaContainer" class="hidden bg-white rounded-xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                <th class="text-left px-5 py-3">Entidad</th>
                <th class="text-left px-5 py-3">Ciudad</th>
                <th class="text-left px-5 py-3">Teléfono</th>
                <th class="text-left px-5 py-3">Correo</th>
                <th class="text-left px-5 py-3">Contacto</th>
                <th class="text-left px-5 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody id="entidadesBody"></tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const entidadesBody = document.getElementById('entidadesBody');

    try {
        const response = await fetch('/api/entidades');
        const data = await response.json();
        const entidades = Array.isArray(data) ? data : data.data ?? [];

        loading.classList.add('hidden');
        tablaContainer.classList.remove('hidden');

        if (entidades.length === 0) {
            entidadesBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-5 py-6 text-center text-slate-500">
                        No hay entidades registradas.
                    </td>
                </tr>
            `;
            return;
        }

        entidadesBody.innerHTML = entidades.map(entidad => `
            <tr class="border-t">
                <td class="px-5 py-3 font-medium">${entidad.nombre_entidad ?? '-'}</td>
                <td class="px-5 py-3">${entidad.ciudad ?? '-'}</td>
                <td class="px-5 py-3">${entidad.telefono ?? '-'}</td>
                <td class="px-5 py-3">${entidad.correo ?? '-'}</td>
                <td class="px-5 py-3">${entidad.contacto ?? '-'}</td>
                <td class="px-5 py-3 space-x-2">
                    <a href="#" class="text-blue-600 hover:underline">Editar</a>
                    <a href="#" class="text-slate-600 hover:underline">Ver</a>
                </td>
            </tr>
        `).join('');

    } catch (e) {
        loading.classList.add('hidden');
        error.classList.remove('hidden');
        console.error(e);
    }
});
</script>
@endsection