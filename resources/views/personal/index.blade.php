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

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="/personal/plantilla-csv" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                    Descargar plantilla CSV
                </a>

                <a href="/personal/exportar-csv" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                    Exportar personal CSV
                </a>

                <a href="/personal/create" class="bg-emerald-500 text-white px-5 py-3 rounded-2xl hover:bg-emerald-400 shadow-lg shadow-emerald-950/30 font-semibold text-center">
                    Nueva persona
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Importar personas desde CSV</h4>
            <p class="text-sm text-slate-500 mt-1">
                Descargue la plantilla, complete los datos en Excel y guarde el archivo como CSV UTF-8 antes de importarlo.
            </p>
        </div>

        <form id="importarForm" class="p-6 flex flex-col lg:flex-row gap-4 lg:items-end">
            <div class="flex-1">
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Archivo CSV
                </label>

                <label for="archivoCsv" class="block cursor-pointer">
                <div class="w-full border border-dashed border-emerald-300 bg-emerald-50/50 rounded-2xl px-5 py-4 hover:bg-emerald-50 transition">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <p class="font-semibold text-slate-800">
                                Seleccionar archivo CSV
                            </p>
                            <p id="nombreArchivoCsv" class="text-sm text-slate-500 mt-1">
                                Ningún archivo seleccionado
                            </p>
                        </div>

                        <span class="inline-flex justify-center px-4 py-2 rounded-xl bg-emerald-600 text-white font-semibold text-sm">
                            Buscar archivo
                        </span>
                    </div>
                </div>
            </label>

            <input 
                id="archivoCsv"
                name="archivo"
                type="file"
                accept=".csv,.txt"
                class="hidden"
            >

                <p class="text-xs text-slate-500 mt-2">
                    Columnas mínimas obligatorias: nombres y ci.
                </p>
            </div>

            <button 
                type="submit"
                id="btnImportar"
                class="bg-emerald-600 text-white px-5 py-3 rounded-2xl hover:bg-emerald-500 shadow-lg shadow-emerald-950/20 font-semibold transition"
            >
                Importar CSV
            </button>
        </form>

        <div id="mensajeImportacion" class="hidden mx-6 mb-6 rounded-2xl p-4 text-sm border"></div>
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
                        <th class="text-left px-6 py-4">Acción</th>
                    </tr>
                </thead>

                <tbody id="personalBody"></tbody>
            </table>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const personalBody = document.getElementById('personalBody');
    const totalPersonal = document.getElementById('totalPersonal');

    const importarForm = document.getElementById('importarForm');
    const archivoCsv = document.getElementById('archivoCsv');
    const btnImportar = document.getElementById('btnImportar');
    const mensajeImportacion = document.getElementById('mensajeImportacion');
    const nombreArchivoCsv = document.getElementById('nombreArchivoCsv');

    archivoCsv.addEventListener('change', function () {
        if (archivoCsv.files.length) {
            nombreArchivoCsv.textContent = archivoCsv.files[0].name;
        } else {
            nombreArchivoCsv.textContent = 'Ningún archivo seleccionado';
        }
    });

    function escapar(texto) {
        if (texto === null || texto === undefined) {
            return '';
        }

        return String(texto)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    }

    function mostrarMensajeImportacion(texto, tipo) {
        mensajeImportacion.className = 'mx-6 mb-6 rounded-2xl p-4 text-sm border';

        if (tipo === 'error') {
            mensajeImportacion.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
        } else if (tipo === 'success') {
            mensajeImportacion.classList.add('bg-green-50', 'text-green-700', 'border-green-200');
        } else {
            mensajeImportacion.classList.add('bg-blue-50', 'text-blue-700', 'border-blue-200');
        }

        mensajeImportacion.innerHTML = texto;
        mensajeImportacion.classList.remove('hidden');
    }

    async function cargarPersonal() {
        loading.classList.remove('hidden');
        error.classList.add('hidden');
        tablaContainer.classList.add('hidden');

        try {
            const response = await fetch('/api/personas', {
                headers: {
                    'Accept': 'application/json',
                }
            });

            const data = await response.json();

            if (!response.ok) {
                console.error(data);
                throw new Error(data.message || 'No se pudo cargar el personal.');
            }

            const personas = Array.isArray(data) ? data : data.data ?? [];

            loading.classList.add('hidden');
            tablaContainer.classList.remove('hidden');

            totalPersonal.textContent = personas.length + ' registro' + (personas.length === 1 ? '' : 's');

            if (personas.length === 0) {
                personalBody.innerHTML =
                    '<tr>' +
                        '<td colspan="7" class="px-6 py-8 text-center text-slate-500">' +
                            'No hay personal registrado todavía.' +
                        '</td>' +
                    '</tr>';
                return;
            }

            let html = '';

            personas.forEach(function (persona) {
                const nombreCompleto = [
                    persona.nombres,
                    persona.apellido_paterno,
                    persona.apellido_materno
                ].filter(Boolean).join(' ');

                const ciCompleto = [
                    persona.ci,
                    persona.ci_expedido
                ].filter(Boolean).join(' ');

                const inicial = (persona.nombres || 'P').trim().charAt(0).toUpperCase();

                html +=
                    '<tr class="border-t border-slate-100 hover:bg-slate-50 transition">' +
                        '<td class="px-6 py-4">' +
                            '<div class="flex items-center gap-3">' +
                                '<div class="w-10 h-10 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold">' +
                                    escapar(inicial) +
                                '</div>' +

                                '<div>' +
                                    '<p class="font-semibold text-slate-900">' +
                                        escapar(nombreCompleto || 'Sin nombre') +
                                    '</p>' +

                                    '<p class="text-xs text-slate-500">' +
                                        escapar(persona.profesion || 'Sin profesión registrada') +
                                    '</p>' +
                                '</div>' +
                            '</div>' +
                        '</td>' +

                        '<td class="px-6 py-4">' +
                            escapar(ciCompleto || '-') +
                        '</td>' +

                        '<td class="px-6 py-4">' +
                            escapar(persona.telefono || '-') +
                        '</td>' +

                        '<td class="px-6 py-4">' +
                            escapar(persona.correo || '-') +
                        '</td>' +

                        '<td class="px-6 py-4">' +
                            escapar(persona.profesion || '-') +
                        '</td>' +

                        '<td class="px-6 py-4 max-w-xs">' +
                            '<span class="line-clamp-2">' +
                                escapar(persona.direccion || '-') +
                            '</span>' +
                        '</td>' +

                        '<td class="px-6 py-4">' +
                            '<a href="/personal/' + escapar(persona.id_persona) + '/edit" class="inline-flex px-3 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800 text-sm font-semibold">' +
                                'Editar' +
                            '</a>' +
                        '</td>' +
                    '</tr>';
            });

            personalBody.innerHTML = html;

        } catch (e) {
            console.error(e);
            loading.classList.add('hidden');
            error.classList.remove('hidden');
        }
    }

    importarForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        if (!archivoCsv.files.length) {
            mostrarMensajeImportacion('Debe seleccionar un archivo CSV.', 'error');
            return;
        }

        const formData = new FormData();
        formData.append('archivo', archivoCsv.files[0]);

        btnImportar.disabled = true;
        btnImportar.textContent = 'Importando...';

        try {
            const response = await fetch('/api/personas-importar-csv', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const result = await response.json();

            if (!response.ok) {
                console.error(result);

                let errores = '';

                if (result.errors) {
                    errores = Object.values(result.errors).flat().join('<br>');
                }

                throw new Error(errores || result.message || 'No se pudo importar el archivo.');
            }

            let detalleErrores = '';

            if (result.errores && result.errores.length > 0) {
                let listaErrores = '';

                result.errores.forEach(function (item) {
                    listaErrores += '<li>' + escapar(item) + '</li>';
                });

                detalleErrores =
                    '<div class="mt-3">' +
                        '<p class="font-semibold">Observaciones:</p>' +
                        '<ul class="list-disc pl-5 mt-1 space-y-1">' +
                            listaErrores +
                        '</ul>' +
                    '</div>';
            }

            mostrarMensajeImportacion(
                '<strong>' + escapar(result.message || 'Importación finalizada.') + '</strong><br>' +
                'Personas creadas: ' + escapar(result.creados || 0) + '<br>' +
                'Filas omitidas: ' + escapar(result.omitidos || 0) +
                detalleErrores,
                'success'
            );

            importarForm.reset();
            nombreArchivoCsv.textContent = 'Ningún archivo seleccionado';

            await cargarPersonal();

        } catch (error) {
            mostrarMensajeImportacion(escapar(error.message), 'error');
        } finally {
            btnImportar.disabled = false;
            btnImportar.textContent = 'Importar CSV';
        }
    });

    cargarPersonal();
});
</script>
@endsection