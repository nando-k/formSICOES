@extends('layouts.app')

@section('title', 'Personal de la empresa')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-950 via-slate-900 to-teal-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-emerald-300 text-sm font-medium mb-2">
                    Personal de la empresa
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Personal de la empresa
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Administre la población general de personas que luego podrá asignarse como personal de una empresa.
                </p>
            </div>

            <a href="/personal/create" class="bg-emerald-500 text-white px-5 py-3 rounded-2xl hover:bg-emerald-400 shadow-lg shadow-emerald-950/30 font-semibold text-center">
                Nueva persona
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando personal...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudo cargar el personal registrado.
    </div>

    <div id="tablaContainer" class="hidden bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
            <div>
                <h4 class="font-bold text-slate-900">Población general de personas</h4>
                <p class="text-sm text-slate-500">Personas registradas disponibles para asignarse a empresas.</p>
            </div>

            <span id="totalPersonal" class="text-sm bg-emerald-50 text-emerald-700 px-3 py-1 rounded-full font-medium">
                0 registros
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="text-left px-6 py-4">Nombre completo</th>
                        <th class="text-left px-6 py-4">CI</th>
                        <th class="text-left px-6 py-4">Teléfono</th>
                        <th class="text-left px-6 py-4">Correo</th>
                        <th class="text-left px-6 py-4">Profesión</th>
                        <th class="text-left px-6 py-4">Dirección</th>
                    </tr>
                </thead>

                <tbody id="personalBody"></tbody>
            </table>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const personalBody = document.getElementById('personalBody');
    const totalPersonal = document.getElementById('totalPersonal');

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

        totalPersonal.textContent = `${personas.length} registro${personas.length === 1 ? '' : 's'}`;

        if (personas.length === 0) {
            personalBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-slate-500">
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

            const inicial = (persona.nombres ?? 'P').trim().charAt(0).toUpperCase();

            return `
                <tr class="border-t border-slate-100 hover:bg-slate-50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">
                                ${inicial}
                            </div>

                            <div>
                                <p class="font-semibold text-slate-900">
                                    ${nombreCompleto || 'Sin nombre'}
                                </p>

                                <p class="text-xs text-slate-500">
                                    ${persona.profesion ?? 'Sin profesión registrada'}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        ${ciCompleto || '-'}
                    </td>

                    <td class="px-6 py-4">
                        ${persona.telefono ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        ${persona.correo ?? '-'}
                    </td>

                    <td class="px-6 py-4">
                        ${persona.profesion ?? '-'}
                    </td>

                    <td class="px-6 py-4 max-w-xs">
                        <span class="line-clamp-2">
                            ${persona.direccion ?? '-'}
                        </span>
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