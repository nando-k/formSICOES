@extends('layouts.app')

@section('title', 'Nueva convocatoria')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-amber-950 via-slate-900 to-orange-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-amber-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-amber-300 text-sm font-medium mb-2">
                    Registro de proceso
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Nueva convocatoria
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Complete la información principal del proceso de contratación. Puede seleccionar una entidad existente o crearla desde esta misma pantalla.
                </p>
            </div>

            <a href="/convocatorias" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver al listado
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-6xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Datos de la convocatoria</h4>
            <p class="text-sm text-slate-500 mt-1">
                Complete los campos necesarios para generar documentos desde plantillas Word.
            </p>
        </div>

        <form id="convocatoriaForm" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

            <div class="md:col-span-2 bg-amber-50/60 border border-amber-100 rounded-3xl p-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
                    <div>
                        <h4 class="font-bold text-slate-900">Entidad convocante</h4>
                        <p class="text-sm text-slate-500">
                            Seleccione una entidad existente o registre una nueva para esta convocatoria.
                        </p>
                    </div>

                    <label class="flex items-center gap-2 text-sm font-semibold text-amber-800">
                        <input id="crearEntidadCheck" type="checkbox" class="rounded border-amber-300">
                        Crear nueva entidad
                    </label>
                </div>

                <div id="bloqueEntidadExistente">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Entidad existente</label>
                    <select name="id_entidad" id="id_entidad" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                        <option value="">Cargando entidades...</option>
                    </select>
                </div>

                <div id="bloqueNuevaEntidad" class="hidden grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre de la entidad</label>
                        <input name="nueva_nombre_entidad" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="GOBIERNO AUTÓNOMO MUNICIPAL DE LA PAZ">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Dirección</label>
                        <textarea name="nueva_direccion" rows="2" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="Dirección de la entidad"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Ciudad</label>
                        <input name="nueva_ciudad" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="LA PAZ">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                        <input name="nueva_telefono" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="2240000">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                        <input name="nueva_correo" type="email" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="contacto@entidad.gob.bo">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Persona de contacto</label>
                        <input name="nueva_contacto" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="NOMBRE DEL CONTACTO">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Cargo del contacto</label>
                        <input name="nueva_cargo_contacto" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="RESPONSABLE DE CONTRATACIONES">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Empresa / Proponente</label>
                <select name="id_proponente" id="id_proponente" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                    <option value="">Cargando empresas...</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">CITE</label>
                <input name="cite" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="CITE CIDSAF 094/2023">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Número de convocatoria</label>
                <input name="numero_convocatoria" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="CH LP - 085/2023">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">CUCE</label>
                <input name="cuce" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="23-1404-00-1345364-1-1">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Estado</label>
                <select name="estado" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                    <option value="Borrador">Borrador</option>
                    <option value="En revisión">En revisión</option>
                    <option value="Finalizada">Finalizada</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Objeto de contratación</label>
                <textarea name="objeto" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" rows="3" placeholder="Servicio de auditoría externa..."></textarea>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Lugar de entrega</label>
                <textarea name="lugar_entrega" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" rows="2" placeholder="Dirección donde se entrega la propuesta"></textarea>
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
                <input name="plazo_propuesta_dias" type="number" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="60">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Monto Bs.</label>
                <input name="monto" type="number" step="0.01" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="41500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Monto literal</label>
                <input name="monto_literal" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="CUARENTA Y UN MIL QUINIENTOS 00/100 BOLIVIANOS">
            </div>

            <div class="md:col-span-2">
                <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>
            </div>

            <div class="md:col-span-2 flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="/convocatorias" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center">
                    Cancelar
                </a>

                <button type="submit" id="btnGuardar" class="bg-amber-600 text-white px-5 py-3 rounded-2xl hover:bg-amber-500 shadow-lg shadow-amber-950/20 font-semibold transition">
                    Guardar convocatoria
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
    const entidadSelect = document.getElementById('id_entidad');
    const proponenteSelect = document.getElementById('id_proponente');
    const params = new URLSearchParams(window.location.search);
    const entidadPreseleccionada = params.get('entidad');
    const crearEntidadCheck = document.getElementById('crearEntidadCheck');
    const bloqueEntidadExistente = document.getElementById('bloqueEntidadExistente');
    const bloqueNuevaEntidad = document.getElementById('bloqueNuevaEntidad');

    const camposMayusculas = document.querySelectorAll(
        'input[type="text"], textarea'
    );

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

    crearEntidadCheck.addEventListener('change', () => {
        if (crearEntidadCheck.checked) {
            bloqueEntidadExistente.classList.add('hidden');
            bloqueNuevaEntidad.classList.remove('hidden');
            entidadSelect.value = '';
        } else {
            bloqueEntidadExistente.classList.remove('hidden');
            bloqueNuevaEntidad.classList.add('hidden');
        }
    });

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

    await cargarEntidades();
    await cargarProponentes();

    if (entidadPreseleccionada) {
        entidadSelect.value = entidadPreseleccionada;
    }
});

document.getElementById('convocatoriaForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const mensaje = document.getElementById('mensaje');
    const btnGuardar = document.getElementById('btnGuardar');
    const crearEntidadCheck = document.getElementById('crearEntidadCheck');

    function mostrarError(texto) {
        mensaje.className = 'rounded-2xl p-4 text-sm border bg-red-50 text-red-700 border-red-200';
        mensaje.innerHTML = texto;
    }

    async function crearEntidadNueva() {
        const entidadData = {
            nombre_entidad: convertirMayusculas(form.nueva_nombre_entidad.value),
            direccion: convertirMayusculas(form.nueva_direccion.value),
            ciudad: convertirMayusculas(form.nueva_ciudad.value),
            telefono: convertirMayusculas(form.nueva_telefono.value),
            correo: form.nueva_correo.value.trim().toLowerCase(),
            contacto: convertirMayusculas(form.nueva_contacto.value),
            cargo_contacto: convertirMayusculas(form.nueva_cargo_contacto.value),
        };

        if (!entidadData.nombre_entidad) {
            throw new Error('Debe escribir el nombre de la nueva entidad.');
        }

        const response = await fetch('/api/entidades', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(entidadData)
        });

        const result = await response.json();

        if (!response.ok) {
            console.error(result);

            let errores = '';

            if (result.errors) {
                errores = Object.values(result.errors).flat().join('<br>');
            }

            throw new Error(errores || result.message || 'No se pudo crear la entidad.');
        }

        return result;
    }

    btnGuardar.disabled = true;
    btnGuardar.textContent = 'Guardando...';

    try {
        let idEntidad = form.id_entidad.value;

        if (crearEntidadCheck.checked) {
            btnGuardar.textContent = 'Creando entidad...';
            const nuevaEntidad = await crearEntidadNueva();
            idEntidad = nuevaEntidad.id_entidad;
        }

        if (!idEntidad) {
            throw new Error('Debe seleccionar una entidad o crear una nueva.');
        }

        const data = {
            id_entidad: idEntidad,
            id_proponente: form.id_proponente.value,
            cite: convertirMayusculas(form.cite.value),
            numero_convocatoria: convertirMayusculas(form.numero_convocatoria.value),
            cuce: convertirMayusculas(form.cuce.value),
            objeto: convertirMayusculas(form.objeto.value),
            lugar_entrega: convertirMayusculas(form.lugar_entrega.value),
            fecha_presentacion: form.fecha_presentacion.value,
            fecha_apertura: form.fecha_apertura.value,
            hora_apertura: form.hora_apertura.value,
            plazo_propuesta_dias: form.plazo_propuesta_dias.value,
            monto: form.monto.value,
            monto_literal: convertirMayusculas(form.monto_literal.value),
            estado: convertirMayusculas(form.estado.value),
        };

        btnGuardar.textContent = 'Guardando convocatoria...';

        const response = await fetch('/api/convocatorias', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (!response.ok) {
            console.error(result);

            let errores = '';

            if (result.errors) {
                errores = Object.values(result.errors).flat().join('<br>');
            }

            throw new Error(errores || result.message || 'No se pudo guardar la convocatoria.');
        }

        mensaje.className = 'rounded-2xl p-4 text-sm border bg-green-50 text-green-700 border-green-200';
        mensaje.innerHTML = 'Convocatoria guardada correctamente. Redirigiendo...';

        setTimeout(() => {
            window.location.href = '/convocatorias';
        }, 900);

    } catch (error) {
        mostrarError(error.message);
    } finally {
        btnGuardar.disabled = false;
        btnGuardar.textContent = 'Guardar convocatoria';
    }
});
</script>
@endsection