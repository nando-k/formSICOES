@extends('layouts.app')

@section('title', 'Generar documento')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-950 via-slate-900 to-teal-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-emerald-300 text-sm font-medium mb-2">
                    Generación automática
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Generar documento Word
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Seleccione una convocatoria y una plantilla para generar un documento Word con datos reales del sistema.
                </p>
            </div>

            <a href="/documentos" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Ver historial
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100">
                <h4 class="font-bold text-slate-900">Datos para generar documento</h4>
                <p class="text-sm text-slate-500 mt-1">
                    Seleccione el modelo y la convocatoria que alimentará la plantilla Word.
                </p>
            </div>

            <form class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Modelo de documento</label>
                    <select id="documentoModelo" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        <option value="">Cargando modelos...</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Convocatoria</label>
                    <select id="convocatoria" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        <option value="">Cargando convocatorias...</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Observación</label>
                    <textarea class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" rows="3" placeholder="Observación opcional para el documento generado"></textarea>
                </div>

                <div class="md:col-span-2">
                    <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>
                </div>

                <div class="md:col-span-2 flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="/formularios" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center">
                        Cancelar
                    </a>

                    <button type="button" id="btnGenerar" class="bg-emerald-600 text-white px-5 py-3 rounded-2xl hover:bg-emerald-500 shadow-lg shadow-emerald-950/20 font-semibold transition">
                        Generar documento
                    </button>
                </div>
            </form>
        </div>

        <div class="rounded-3xl border border-emerald-100 bg-gradient-to-br from-white to-emerald-50 p-6 shadow-sm">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-11 h-11 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-black shadow-lg shadow-emerald-950/20">
                    ✓
                </div>

                <div>
                    <h3 class="font-bold text-slate-900">Funcionamiento</h3>
                    <p class="text-xs text-slate-500">
                        Flujo de generación Word
                    </p>
                </div>
            </div>

            <p class="text-sm text-slate-600 leading-relaxed mb-5">
                El sistema toma los datos registrados de la convocatoria, la entidad y el proponente, y los inserta automáticamente en la plantilla seleccionada.
            </p>

            <div class="space-y-3">
                <div class="flex items-center gap-3 rounded-2xl bg-white border border-emerald-100 px-4 py-3">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">1</span>
                    <span class="text-sm text-slate-700">Seleccionar modelo</span>
                </div>

                <div class="flex items-center gap-3 rounded-2xl bg-white border border-emerald-100 px-4 py-3">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">2</span>
                    <span class="text-sm text-slate-700">Seleccionar convocatoria</span>
                </div>

                <div class="flex items-center gap-3 rounded-2xl bg-white border border-emerald-100 px-4 py-3">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">3</span>
                    <span class="text-sm text-slate-700">Generar documento Word</span>
                </div>

                <div class="flex items-center gap-3 rounded-2xl bg-white border border-emerald-100 px-4 py-3">
                    <span class="w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">4</span>
                    <span class="text-sm text-slate-700">Descargar archivo final</span>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const documentoModelo = document.getElementById('documentoModelo');
    const convocatoria = document.getElementById('convocatoria');
    const btnGenerar = document.getElementById('btnGenerar');
    const mensaje = document.getElementById('mensaje');

    async function cargarModelos() {
        const response = await fetch('/api/documentos-modelo');
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || 'No se pudieron cargar los modelos.');
        }

        const modelos = Array.isArray(data) ? data : data.data ?? [];

        documentoModelo.innerHTML = '<option value="">Seleccione un modelo</option>';

        modelos.forEach(modelo => {
            documentoModelo.innerHTML += `
                <option value="${modelo.id_documento_modelo}">
                    ${modelo.codigo_modelo ?? 'Modelo'} - ${modelo.nombre_modelo ?? 'Sin nombre'}
                </option>
            `;
        });
    }

    async function cargarConvocatorias() {
        const response = await fetch('/api/convocatorias');
        const data = await response.json();

        if (!response.ok) {
            console.error(data);
            throw new Error(data.message || 'No se pudieron cargar las convocatorias.');
        }

        const convocatorias = Array.isArray(data) ? data : data.data ?? [];

        convocatoria.innerHTML = '<option value="">Seleccione una convocatoria</option>';

        if (convocatorias.length === 0) {
            convocatoria.innerHTML = '<option value="">No hay convocatorias registradas</option>';
            return;
        }

        convocatorias.forEach(item => {
            const entidad = item.entidad?.nombre_entidad ?? 'Sin entidad';

            convocatoria.innerHTML += `
                <option value="${item.id_convocatoria}">
                    ${item.numero_convocatoria ?? 'Sin número'} - ${entidad}
                </option>
            `;
        });
    }

    function mostrarMensaje(texto, tipo = 'info') {
        mensaje.classList.remove(
            'hidden',
            'bg-green-50',
            'text-green-700',
            'border-green-200',
            'bg-red-50',
            'text-red-700',
            'border-red-200',
            'bg-blue-50',
            'text-blue-700',
            'border-blue-200'
        );

        mensaje.classList.add('border');

        if (tipo === 'error') {
            mensaje.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
        } else if (tipo === 'success') {
            mensaje.classList.add('bg-green-50', 'text-green-700', 'border-green-200');
        } else {
            mensaje.classList.add('bg-blue-50', 'text-blue-700', 'border-blue-200');
        }

        mensaje.innerHTML = texto;
    }

    btnGenerar.addEventListener('click', async () => {
        const convocatoriaId = convocatoria.value;
        const documentoModeloId = documentoModelo.value;

        if (!convocatoriaId || !documentoModeloId) {
            mostrarMensaje('Debe seleccionar un modelo y una convocatoria.', 'error');
            return;
        }

        btnGenerar.disabled = true;
        btnGenerar.textContent = 'Generando...';

        try {
            const response = await fetch(`/api/convocatorias/${convocatoriaId}/generar/${documentoModeloId}`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                }
            });

            const result = await response.json();

            if (!response.ok) {
                console.error(result);
                throw new Error(result.message || 'No se pudo generar el documento.');
            }

            const documentoGeneradoId = result.id_documento_generado;

            mostrarMensaje(`
                <strong>Documento generado correctamente.</strong><br>
                Archivo: ${result.nombre_archivo ?? 'Archivo generado'}<br>
                Ruta: ${result.ruta_archivo ?? 'Sin ruta registrada'}

                <div class="mt-4 flex gap-3 flex-wrap">
                    <a href="/documentos/${documentoGeneradoId}"
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-2xl hover:bg-blue-500">
                        Ver detalle
                    </a>

                    <a href="/documentos/${documentoGeneradoId}/descargar"
                       class="inline-block bg-emerald-600 text-white px-4 py-2 rounded-2xl hover:bg-emerald-500">
                        Descargar Word
                    </a>

                    <a href="/documentos"
                       class="inline-block bg-slate-800 text-white px-4 py-2 rounded-2xl hover:bg-slate-700">
                        Ver historial
                    </a>
                </div>
            `, 'success');

        } catch (error) {
            mostrarMensaje(error.message, 'error');
        } finally {
            btnGenerar.disabled = false;
            btnGenerar.textContent = 'Generar documento';
        }
    });

    try {
        await cargarModelos();
        await cargarConvocatorias();
    } catch (error) {
        console.error(error);
        mostrarMensaje('No se pudieron cargar los datos desde la API.', 'error');
    }
});
</script>
@endsection