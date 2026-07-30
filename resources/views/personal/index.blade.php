@extends('layouts.app')

@section('title', 'Personal')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Personal registrado</h3>
        <p class="text-sm text-slate-500">
            Personas registradas para participar en las propuestas.
        </p>
    </div>

    <a href="/personal/create" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Nuevo personal
    </a>
</div>

<div id="loading" class="bg-white border rounded-xl p-6 text-slate-500">
    Cargando personal...
</div>

<div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-xl p-5">
    No se pudo cargar el personal registrado.
</div>

<div id="tablaContainer" class="hidden bg-white rounded-xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                <th class="text-left px-5 py-3">Nombre completo</th>
                <th class="text-left px-5 py-3">CI</th>
                <th class="text-left px-5 py-3">Teléfono</th>
                <th class="text-left px-5 py-3">Correo</th>
                <th class="text-left px-5 py-3">Profesión</th>
                <th class="text-left px-5 py-3">Dirección</th>
            </tr>
        </thead>

        <tbody id="personalBody"></tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const personalBody = document.getElementById('personalBody');

    try {
        const response = await fetch('/api/personas');
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || 'No se pudo cargar el personal.');
        }

        const personas = Array.isArray(data) ? data : data.data ?? [];

        loading.classList.add('hidden');
        tablaContainer.classList.remove('hidden');

        if (personas.length === 0) {
            personalBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-5 py-6 text-center text-slate-500">
                        No hay personal registrado todavía.
                    </td>
                </tr>
            `;
            return;
        }

        personalBody.innerHTML = personas.map(persona => {
            const nombreCompleto = [
                persona.nombres,
                persona.apellido_paterno,
                persona.apellido_materno
            ].filter(Boolean).join(' ');

            const ciCompleto = [
                persona.ci,
                persona.expedido
            ].filter(Boolean).join(' ');

            return `
                <tr class="border-t">
                    <td class="px-5 py-3 font-medium text-slate-800">
                        ${nombreCompleto || 'Sin nombre'}
                    </td>

                    <td class="px-5 py-3">
                        ${ciCompleto || '-'}
                    </td>

                    <td class="px-5 py-3">
                        ${persona.telefono ?? '-'}
                    </td>

                    <td class="px-5 py-3">
                        ${persona.correo ?? '-'}
                    </td>

                    <td class="px-5 py-3">
                        ${persona.profesion ?? '-'}
                    </td>

                    <td class="px-5 py-3">
                        ${persona.direccion ?? '-'}
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