@extends('layouts.app')

@section('title', 'Detalle del documento')

@section('content')
<div class="mb-5">
    <a href="/documentos" class="text-sm text-blue-600 hover:underline">
        ← Volver al historial
    </a>
</div>

<div id="loading" class="bg-white border rounded-xl p-6 text-slate-500">
    Cargando detalle del documento...
</div>

<div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-xl p-5">
    No se pudo cargar el detalle del documento.
</div>

<div id="detalle" class="hidden space-y-5">
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <div class="flex justify-between items-start gap-4">
            <div>
                <h3 id="nombreArchivo" class="text-xl font-semibold text-slate-800">
                    Documento generado
                </h3>
                <p id="rutaArchivo" class="text-sm text-slate-500 mt-1"></p>
            </div>

            <a id="btnDescargar" href="#" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Descargar Word
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h4 class="font-semibold mb-4 text-slate-700">Información del documento</h4>

            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-slate-500">Modelo</p>
                    <p id="modelo" class="font-medium text-slate-800">-</p>
                </div>

                <div>
                    <p class="text-slate-500">Fecha de generación</p>
                    <p id="fecha" class="font-medium text-slate-800">-</p>
                </div>

                <div>
                    <p class="text-slate-500">Generado por</p>
                    <p id="generadoPor" class="font-medium text-slate-800">-</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h4 class="font-semibold mb-4 text-slate-700">Convocatoria relacionada</h4>

            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-slate-500">Número de convocatoria</p>
                    <p id="numeroConvocatoria" class="font-medium text-slate-800">-</p>
                </div>

                <div>
                    <p class="text-slate-500">CUCE</p>
                    <p id="cuce" class="font-medium text-slate-800">-</p>
                </div>

                <div>
                    <p class="text-slate-500">Objeto</p>
                    <p id="objeto" class="font-medium text-slate-800">-</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const documentoId = @json($id);

    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const detalle = document.getElementById('detalle');

    try {
        const response = await fetch(`/api/documentos-generados/${documentoId}`);
        const documento = await response.json();

        if (!response.ok) {
            console.error(documento);
            throw new Error(documento.message || 'No se pudo cargar el documento.');
        }

        const id = documentoId;

        document.getElementById('nombreArchivo').textContent = documento.nombre_archivo ?? 'Documento generado';
        document.getElementById('rutaArchivo').textContent = documento.ruta_archivo ?? 'Sin ruta registrada';

        document.getElementById('modelo').textContent =
            documento.documento_modelo?.nombre_modelo ??
            documento.documentoModelo?.nombre_modelo ??
            'Sin modelo';

        document.getElementById('fecha').textContent = documento.fecha_generacion ?? '-';
        document.getElementById('generadoPor').textContent = documento.generado_por ?? '-';

        document.getElementById('numeroConvocatoria').textContent =
            documento.convocatoria?.numero_convocatoria ?? '-';

        document.getElementById('cuce').textContent =
            documento.convocatoria?.cuce ?? '-';

        document.getElementById('objeto').textContent =
            documento.convocatoria?.objeto ?? '-';

        document.getElementById('btnDescargar').href = `/documentos/${id}/descargar`;

        loading.classList.add('hidden');
        detalle.classList.remove('hidden');

    } catch (e) {
        console.error(e);
        loading.classList.add('hidden');
        error.classList.remove('hidden');
    }
});
</script>
@endsection