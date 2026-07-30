@extends('layouts.app')

@section('title', 'Documentos generados')

@section('content')
<div class="flex justify-between items-center mb-5">
    <div>
        <h3 class="text-lg font-semibold">Historial de documentos generados</h3>
        <p class="text-sm text-slate-500">
            Documentos generados desde las plantillas Word.
        </p>
    </div>

    <a href="/formularios/generar" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
        Generar nuevo
    </a>
</div>

<div id="loading" class="bg-white border rounded-xl p-6 text-slate-500">
    Cargando documentos generados...
</div>

<div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-xl p-5">
    No se pudieron cargar los documentos generados.
</div>

<div id="tablaContainer" class="hidden bg-white rounded-xl shadow-sm border overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500">
            <tr>
                <th class="text-left px-5 py-3">Documento</th>
                <th class="text-left px-5 py-3">Modelo</th>
                <th class="text-left px-5 py-3">Convocatoria</th>
                <th class="text-left px-5 py-3">Fecha</th>
                <th class="text-left px-5 py-3">Generado por</th>
                <th class="text-left px-5 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody id="documentosBody"></tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const tablaContainer = document.getElementById('tablaContainer');
    const documentosBody = document.getElementById('documentosBody');

    try {
        const response = await fetch('/api/documentos-generados');
        const data = await response.json();
        const documentos = Array.isArray(data) ? data : data.data ?? [];

        loading.classList.add('hidden');
        tablaContainer.classList.remove('hidden');

        if (documentos.length === 0) {
            documentosBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-5 py-6 text-center text-slate-500">
                        No hay documentos generados todavía.
                    </td>
                </tr>
            `;
            return;
        }

        documentosBody.innerHTML = documentos.map(documento => {
            const id = documento.id_documento_generado ?? documento.id;
            const modelo = documento.documento_modelo?.nombre_modelo ?? documento.documentoModelo?.nombre_modelo ?? 'Sin modelo';
            const convocatoria = documento.convocatoria?.numero_convocatoria ?? 'Sin convocatoria';

            return `
                <tr class="border-t">
                    <td class="px-5 py-3 font-medium">
                        ${documento.nombre_archivo ?? 'Documento generado'}
                    </td>
                    <td class="px-5 py-3">${modelo}</td>
                    <td class="px-5 py-3">${convocatoria}</td>
                    <td class="px-5 py-3">${documento.fecha_generacion ?? '-'}</td>
                    <td class="px-5 py-3">${documento.generado_por ?? '-'}</td>
                    <td class="px-5 py-3 space-x-2">
                        <a href="/documentos/${id}" class="text-blue-600 hover:underline">
                            Ver
                        </a>
                        <a href="/documentos/${id}/descargar" class="text-green-600 hover:underline">
                            Descargar
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