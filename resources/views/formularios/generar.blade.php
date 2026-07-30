@extends('layouts.app')

@section('title', 'Generar documento')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border p-6">
        <h3 class="text-lg font-semibold mb-1">Generar documento desde plantilla</h3>
        <p class="text-sm text-slate-500 mb-6">
            Seleccione la convocatoria y el modelo de documento que desea generar.
        </p>

        <form class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium mb-1">Modelo de documento</label>
                <select id="documentoModelo" class="w-full border rounded-lg px-3 py-2">
                    <option value="">Cargando modelos...</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Convocatoria</label>
                <select id="convocatoria" class="w-full border rounded-lg px-3 py-2">
                    <option value="">Cargando convocatorias...</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Observación</label>
                <textarea class="w-full border rounded-lg px-3 py-2" rows="3" placeholder="Observación opcional para el documento generado"></textarea>
            </div>

            <div class="md:col-span-2 flex justify-end gap-3 pt-4">
                <a href="/formularios" class="px-4 py-2 rounded-lg border">
                    Cancelar
                </a>

                <button type="button" id="btnGenerar" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Generar documento
                </button>
            </div>
        </form>

        <div id="mensaje" class="hidden mt-5 rounded-lg p-4 text-sm"></div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h3 class="font-semibold mb-4">Funcionamiento</h3>

        <div class="space-y-4 text-sm text-slate-600">
            <p>
                El sistema tomará los datos registrados de la convocatoria y los insertará en la plantilla Word seleccionada.
            </p>

            <div class="border rounded-lg p-4 bg-slate-50">
                <p class="font-medium text-slate-800 mb-2">Flujo:</p>
                <p>1. Seleccionar modelo</p>
                <p>2. Seleccionar convocatoria</p>
                <p>3. Generar documento</p>
                <p>4. Descargar archivo final</p>
            </div>

            <p class="text-xs text-slate-500">
                Esta pantalla consume datos reales desde la API y genera documentos Word desde las plantillas registradas.
            </p>
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
                       class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Ver detalle
                    </a>

                    <a href="/documentos/${documentoGeneradoId}/descargar"
                       class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Descargar Word
                    </a>

                    <a href="/documentos"
                       class="inline-block bg-slate-700 text-white px-4 py-2 rounded-lg hover:bg-slate-800">
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