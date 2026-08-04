@extends('layouts.app')

@section('title', 'Editar convocatoria')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-amber-950 via-slate-900 to-orange-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-amber-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-amber-300 text-sm font-medium mb-2">
                    Actualización de proceso
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Editar convocatoria
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Modifique la información principal del proceso de contratación.
                </p>
            </div>

            <a href="/convocatorias" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver al listado
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando convocatoria...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudo cargar la convocatoria.
    </div>

    <div id="formContainer" class="hidden bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-6xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Datos de la convocatoria</h4>
            <p class="text-sm text-slate-500 mt-1">
                Actualice los campos necesarios para la generación documental.
            </p>
        </div>

        <form id="convocatoriaForm" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Entidad convocante</label>
                <select name="id_entidad" id="id_entidad" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                    <option value="">Cargando entidades...</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Empresa / Proponente</label>
                <select name="id_proponente" id="id_proponente" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                    <option value="">Cargando empresas...</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">CITE</label>
                <input name="cite" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Número de convocatoria</label>
                <input name="numero_convocatoria" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">CUCE</label>
                <input name="cuce" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                <select name="estado" id="estado" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                    <option value="BORRADOR">Borrador</option>
                    <option value="EN REVISIÓN">En revisión</option>
                    <option value="FINALIZADA">Finalizada</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Objeto de contratación</label>
                <textarea name="objeto" rows="3" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"></textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Lugar de entrega</label>
                <textarea name="lugar_entrega" rows="2" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de presentación</label>
                <input name="fecha_presentacion" type="date" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Fecha de apertura</label>
                <input name="fecha_apertura" type="date" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Hora de apertura</label>
                <input name="hora_apertura" type="time" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Plazo de validez en días</label>
                <input name="plazo_propuesta_dias" type="number" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Monto Bs.</label>
                <input name="monto" type="number" step="0.01" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Monto literal</label>
                <input name="monto_literal" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
            </div>

            <div class="md:col-span-2">
                <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>
            </div>

            <div class="md:col-span-2 flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="/convocatorias" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center">
                    Cancelar
                </a>

                <button type="submit" id="btnGuardar" class="bg-amber-600 text-white px-5 py-3 rounded-2xl hover:bg-amber-500 shadow-lg shadow-amber-950/20 font-semibold transition">
                    Guardar cambios
                </button>
            </div>
        </form>
    </div>

</div>

<script>
function convertirMayusculas(valor) {
    return valor ? valor.trim().toUpperCase() : valor;
}

document.addEventListener('DOMContentLoaded', async () => {
    const convocatoriaId = @json($id);

    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const formContainer = document.getElementById('formContainer');
    const form = document.getElementById('convocatoriaForm');
    const mensaje = document.getElementById('mensaje');
    const btnGuardar = document.getElementById('btnGuardar');

    const entidadSelect = document.getElementById('id_entidad');
    const proponenteSelect = document.getElementById('id_proponente');

    const camposMayusculas = document.querySelectorAll('input[type="text"], textarea');

    camposMayusculas.forEach(campo => {
        campo.classList.add('uppercase');

        campo.addEventListener('input', () => {
            const posicion = campo.selectionStart;
            campo.value = campo.value.toUpperCase();

            if (campo.setSelectionRange && posicion !== null) {
                campo.setSelectionRange(posicion, posicion);
            }
        });
    });

    function campo(nombre) {
        return form.querySelector(`[name="${nombre}"]`);
    }

    function mostrarMensaje(texto, tipo = 'error') {
        mensaje.className = 'rounded-2xl p-4 text-sm border';

        if (tipo === 'success') {
            mensaje.classList.add('bg-green-50', 'text-green-700', 'border-green-200');
        } else {
            mensaje.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
        }

        mensaje.innerHTML = texto;
        mensaje.classList.remove('hidden');
    }

    function fecha(valor) {
        if (!valor) {
            return '';
        }

        return String(valor).substring(0, 10);
    }

    function hora(valor) {
        if (!valor) {
            return '';
        }

        return String(valor).substring(0, 5);
    }

    async function cargarEntidades() {
        const response = await fetch('/api/entidades');
        const data = await response.json();
        const entidades = Array.isArray(data) ? data : data.data ?? [];

        entidadSelect.innerHTML = '<option value="">Seleccione una entidad</option>';

        entidades.forEach(entidad => {
            entidadSelect.innerHTML += `
                <option value="${entidad.id_entidad}">
                    ${entidad.nombre_entidad}
                </option>
            `;
        });
    }

    async function cargarProponentes() {
        const response = await fetch('/api/proponentes');
        const data = await response.json();
        const proponentes = Array.isArray(data) ? data : data.data ?? [];

        proponenteSelect.innerHTML = '<option value="">Seleccione una empresa</option>';

        proponentes.forEach(proponente => {
            proponenteSelect.innerHTML += `
                <option value="${proponente.id_proponente}">
                    ${proponente.razon_social ?? proponente.nombre_comercial ?? 'Empresa sin nombre'}
                </option>
            `;
        });
    }

    try {
        await cargarEntidades();
        await cargarProponentes();

        const response = await fetch(`/api/convocatorias/${convocatoriaId}`, {
            headers: {
                'Accept': 'application/json',
            }
        });

        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.message || 'No se pudo cargar la convocatoria.');
        }

        const convocatoria = result.data ?? result.convocatoria ?? result;

        entidadSelect.value = convocatoria.id_entidad ?? '';
        proponenteSelect.value = convocatoria.id_proponente ?? '';

        campo('cite').value = convocatoria.cite ?? '';
        campo('numero_convocatoria').value = convocatoria.numero_convocatoria ?? '';
        campo('cuce').value = convocatoria.cuce ?? '';
        campo('objeto').value = convocatoria.objeto ?? '';
        campo('lugar_entrega').value = convocatoria.lugar_entrega ?? '';
        campo('fecha_presentacion').value = fecha(convocatoria.fecha_presentacion);
        campo('fecha_apertura').value = fecha(convocatoria.fecha_apertura);
        campo('hora_apertura').value = hora(convocatoria.hora_apertura);
        campo('plazo_propuesta_dias').value = convocatoria.plazo_propuesta_dias ?? '';
        campo('monto').value = convocatoria.monto ?? '';
        campo('monto_literal').value = convocatoria.monto_literal ?? '';
        campo('estado').value = convocatoria.estado ?? 'BORRADOR';

        loading.classList.add('hidden');
        formContainer.classList.remove('hidden');

    } catch (e) {
        console.error(e);
        loading.classList.add('hidden');
        error.classList.remove('hidden');
        error.textContent = e.message;
    }

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const data = {
            id_entidad: entidadSelect.value,
            id_proponente: proponenteSelect.value,
            cite: convertirMayusculas(campo('cite').value),
            numero_convocatoria: convertirMayusculas(campo('numero_convocatoria').value),
            cuce: convertirMayusculas(campo('cuce').value),
            objeto: convertirMayusculas(campo('objeto').value),
            lugar_entrega: convertirMayusculas(campo('lugar_entrega').value),
            fecha_presentacion: campo('fecha_presentacion').value,
            fecha_apertura: campo('fecha_apertura').value,
            hora_apertura: campo('hora_apertura').value,
            plazo_propuesta_dias: campo('plazo_propuesta_dias').value,
            monto: campo('monto').value,
            monto_literal: convertirMayusculas(campo('monto_literal').value),
            estado: convertirMayusculas(campo('estado').value),
        };

        btnGuardar.disabled = true;
        btnGuardar.textContent = 'Guardando...';

        try {
            const response = await fetch(`/api/convocatorias/${convocatoriaId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (!response.ok) {
                let errores = '';

                if (result.errors) {
                    errores = Object.values(result.errors).flat().join('<br>');
                }

                throw new Error(errores || result.message || 'No se pudo actualizar la convocatoria.');
            }

            mostrarMensaje('Convocatoria actualizada correctamente. Redirigiendo...', 'success');

            setTimeout(() => {
                window.location.href = '/convocatorias';
            }, 900);

        } catch (error) {
            mostrarMensaje(error.message, 'error');
        } finally {
            btnGuardar.disabled = false;
            btnGuardar.textContent = 'Guardar cambios';
        }
    });
});
</script>
@endsection