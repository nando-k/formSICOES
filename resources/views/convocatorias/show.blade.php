@extends('layouts.app')

@section('title', 'Detalle de convocatoria')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-amber-950 via-slate-900 to-orange-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-amber-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-amber-300 text-sm font-medium mb-2">
                    Personal de la convocatoria
                </p>

                <h3 id="tituloConvocatoria" class="text-2xl font-bold text-white">
                    Detalle de convocatoria
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Seleccione las personas que participarán específicamente en esta convocatoria.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a id="btnGenerarDocumento" href="#" class="bg-amber-500 text-white px-5 py-3 rounded-2xl hover:bg-amber-400 shadow-lg shadow-amber-950/30 font-semibold text-center">
                    Generar Word
                </a>

                <a href="/convocatorias" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                    Volver al listado
                </a>
            </div>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando convocatoria...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudo cargar la convocatoria.
    </div>

    <div id="contenido" class="hidden space-y-6">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h4 class="font-bold text-slate-900">Datos de la convocatoria</h4>
                    <p class="text-sm text-slate-500">Información principal del proceso de contratación.</p>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">
                    <div>
                        <p class="text-slate-500 mb-1">Número de convocatoria</p>
                        <p id="numeroConvocatoria" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">CITE</p>
                        <p id="cite" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">CUCE</p>
                        <p id="cuce" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Estado</p>
                        <p id="estado" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Fecha presentación</p>
                        <p id="fechaPresentacion" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Fecha apertura</p>
                        <p id="fechaApertura" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Hora apertura</p>
                        <p id="horaApertura" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Monto</p>
                        <p id="monto" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-slate-500 mb-1">Objeto</p>
                        <p id="objeto" class="font-semibold text-slate-900">-</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-slate-500 mb-1">Lugar de entrega</p>
                        <p id="lugarEntrega" class="font-semibold text-slate-900">-</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h4 class="font-bold text-slate-900">Vinculación</h4>
                    <p class="text-sm text-slate-500">Entidad y empresa asociada.</p>
                </div>

                <div class="p-6 space-y-5 text-sm">
                    <div>
                        <p class="text-slate-500 mb-1">Entidad convocante</p>
                        <p id="entidad" class="font-bold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Empresa / Proponente</p>
                        <p id="proponente" class="font-bold text-slate-900">-</p>
                    </div>

                    <div>
                        <p class="text-slate-500 mb-1">Personal disponible de la empresa</p>
                        <p id="personalEmpresaTotal" class="font-bold text-amber-700">0 personas</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                    <div>
                        <h4 class="font-bold text-slate-900">Personal seleccionado para la convocatoria</h4>
                        <p class="text-sm text-slate-500">
                            Personas que participarán específicamente en este proceso.
                        </p>
                    </div>

                    <span id="totalPersonal" class="text-sm bg-amber-50 text-amber-700 px-3 py-1 rounded-full font-medium">
                        0 registros
                    </span>
                </div>

                <div id="personalConvocatoria" class="divide-y divide-slate-100"></div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100">
                    <h4 class="font-bold text-slate-900">Agregar participante</h4>
                    <p class="text-sm text-slate-500">
                        Seleccione una persona del personal de la empresa.
                    </p>
                </div>

                <form id="asignarForm" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Persona</label>
                        <select id="personaSelect" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                            <option value="">Cargando personal...</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Cargo</label>
                        <select id="cargoSelect" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                            <option value="">Cargando cargos...</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Orden de firma</label>
                        <input id="ordenFirma" type="number" min="1" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition" placeholder="1">
                    </div>

                    <label class="flex items-center gap-2 text-sm text-slate-700">
                        <input id="esFirmante" type="checkbox" class="rounded border-slate-300">
                        Es firmante
                    </label>

                    <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>

                    <button type="submit" id="btnAsignar" class="w-full bg-amber-600 text-white px-5 py-3 rounded-2xl hover:bg-amber-500 shadow-lg shadow-amber-950/20 font-semibold transition">
                        Agregar a convocatoria
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const convocatoriaId = Number(@json($id));

    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const contenido = document.getElementById('contenido');

    const personaSelect = document.getElementById('personaSelect');
    const cargoSelect = document.getElementById('cargoSelect');
    const asignarForm = document.getElementById('asignarForm');
    const btnAsignar = document.getElementById('btnAsignar');
    const mensaje = document.getElementById('mensaje');

    const personalConvocatoria = document.getElementById('personalConvocatoria');
    const totalPersonal = document.getElementById('totalPersonal');

    let convocatoriaActual = null;
    let cargos = [];

    document.getElementById('btnGenerarDocumento').href = `/formularios/generar?convocatoria=${convocatoriaId}`;

    function nombreCompleto(persona) {
        return [
            persona?.nombres,
            persona?.apellido_paterno,
            persona?.apellido_materno
        ].filter(Boolean).join(' ');
    }

    function mostrarMensaje(texto, tipo = 'info') {
        mensaje.className = 'rounded-2xl p-4 text-sm border';

        if (tipo === 'error') {
            mensaje.classList.add('bg-red-50', 'text-red-700', 'border-red-200');
        } else if (tipo === 'success') {
            mensaje.classList.add('bg-green-50', 'text-green-700', 'border-green-200');
        } else {
            mensaje.classList.add('bg-blue-50', 'text-blue-700', 'border-blue-200');
        }

        mensaje.innerHTML = texto;
    }

    async function obtenerJson(url) {
        const response = await fetch(url);
        const data = await response.json();

        if (!response.ok) {
            console.error(data);

            let errores = '';

            if (data.errors) {
                errores = Object.values(data.errors).flat().join('<br>');
            }

            throw new Error(errores || data.message || 'No se pudieron cargar los datos.');
        }

        return Array.isArray(data) ? data : data.data ?? data;
    }

    async function cargarCargos() {
        cargos = await obtenerJson('/api/cargos');

        cargoSelect.innerHTML = '<option value="">Seleccione un cargo</option>';

        cargos.forEach(cargo => {
            cargoSelect.innerHTML += `
                <option value="${cargo.id_cargo}">
                    ${cargo.nombre_cargo ?? 'Cargo sin nombre'}
                </option>
            `;
        });
    }

    function obtenerNombreCargo(idCargo) {
        const cargo = cargos.find(item => Number(item.id_cargo) === Number(idCargo));
        return cargo?.nombre_cargo ?? 'Sin cargo';
    }

    function cargarPersonalEmpresaSelect(convocatoria) {
        const personalEmpresa = convocatoria.proponente?.personal ?? [];
        const personalSeleccionado = convocatoria.personas ?? [];

        document.getElementById('personalEmpresaTotal').textContent =
            `${personalEmpresa.length} persona${personalEmpresa.length === 1 ? '' : 's'}`;

        personaSelect.innerHTML = '<option value="">Seleccione una persona</option>';

        const idsSeleccionados = personalSeleccionado.map(persona => Number(persona.id_persona));

        const disponibles = personalEmpresa.filter(persona => {
            return !idsSeleccionados.includes(Number(persona.id_persona));
        });

        if (disponibles.length === 0) {
            personaSelect.innerHTML = '<option value="">No hay personal disponible para agregar</option>';
            return;
        }

        disponibles.forEach(persona => {
            const nombre = nombreCompleto(persona) || 'Persona sin nombre';
            const ci = persona.ci ? ` - CI: ${persona.ci}` : '';
            const cargoEmpresa = obtenerNombreCargo(persona.pivot?.id_cargo);

            personaSelect.innerHTML += `
                <option value="${persona.id_persona}" data-cargo="${persona.pivot?.id_cargo ?? ''}">
                    ${nombre}${ci} · ${cargoEmpresa}
                </option>
            `;
        });
    }

    function pintarConvocatoria(convocatoria) {
        convocatoriaActual = convocatoria;

        document.getElementById('tituloConvocatoria').textContent =
            convocatoria.numero_convocatoria ?? 'Detalle de convocatoria';

        document.getElementById('numeroConvocatoria').textContent =
            convocatoria.numero_convocatoria ?? '-';

        document.getElementById('cite').textContent =
            convocatoria.cite ?? '-';

        document.getElementById('cuce').textContent =
            convocatoria.cuce ?? '-';

        document.getElementById('estado').textContent =
            convocatoria.estado ?? '-';

        document.getElementById('fechaPresentacion').textContent =
            convocatoria.fecha_presentacion ?? '-';

        document.getElementById('fechaApertura').textContent =
            convocatoria.fecha_apertura ?? '-';

        document.getElementById('horaApertura').textContent =
            convocatoria.hora_apertura ?? '-';

        document.getElementById('monto').textContent =
            convocatoria.monto ? `Bs. ${convocatoria.monto}` : '-';

        document.getElementById('objeto').textContent =
            convocatoria.objeto ?? '-';

        document.getElementById('lugarEntrega').textContent =
            convocatoria.lugar_entrega ?? '-';

        document.getElementById('entidad').textContent =
            convocatoria.entidad?.nombre_entidad ?? 'Sin entidad';

        document.getElementById('proponente').textContent =
            convocatoria.proponente?.razon_social ??
            convocatoria.proponente?.nombre_comercial ??
            'Sin empresa';

        const personal = convocatoria.personas ?? [];

        totalPersonal.textContent = `${personal.length} registro${personal.length === 1 ? '' : 's'}`;

        if (personal.length === 0) {
            personalConvocatoria.innerHTML = `
                <div class="px-6 py-8 text-center text-slate-500">
                    Todavía no hay personal seleccionado para esta convocatoria.
                </div>
            `;
        } else {
            personalConvocatoria.innerHTML = personal.map(persona => {
                const nombre = nombreCompleto(persona) || 'Persona sin nombre';
                const cargo = obtenerNombreCargo(persona.pivot?.id_cargo);
                const firmante = persona.pivot?.es_firmante ? 'Firmante' : 'No firmante';
                const orden = persona.pivot?.orden_firma ?? '-';

                return `
                    <div class="p-6 hover:bg-slate-50 transition">
                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center font-black">
                                    ${(persona.nombres ?? 'P').charAt(0)}
                                </div>

                                <div>
                                    <p class="font-bold text-slate-900">${nombre}</p>
                                    <p class="text-sm text-slate-500">${persona.profesion ?? 'Sin profesión'} · ${cargo}</p>
                                    <p class="text-xs text-slate-400 mt-1">CI: ${persona.ci ?? '-'}</p>
                                </div>
                            </div>

                            <div class="flex gap-2 flex-wrap">
                                <span class="text-xs px-3 py-1 rounded-full bg-slate-50 text-slate-700 border border-slate-200">
                                    ${firmante}
                                </span>

                                <span class="text-xs px-3 py-1 rounded-full bg-amber-50 text-amber-700 border border-amber-100">
                                    Orden: ${orden}
                                </span>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        cargarPersonalEmpresaSelect(convocatoria);
    }

    async function cargarConvocatoria() {
        const convocatoria = await obtenerJson(`/api/convocatorias/${convocatoriaId}`);

        pintarConvocatoria(convocatoria);

        loading.classList.add('hidden');
        contenido.classList.remove('hidden');
    }

    personaSelect.addEventListener('change', () => {
        const selectedOption = personaSelect.options[personaSelect.selectedIndex];
        const cargoEmpresa = selectedOption?.dataset?.cargo;

        if (cargoEmpresa) {
            cargoSelect.value = cargoEmpresa;
        }
    });

    asignarForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const personaId = personaSelect.value;
        const cargoId = cargoSelect.value;
        const ordenFirma = document.getElementById('ordenFirma').value;
        const esFirmante = document.getElementById('esFirmante').checked;

        if (!personaId) {
            mostrarMensaje('Debe seleccionar una persona.', 'error');
            return;
        }

        btnAsignar.disabled = true;
        btnAsignar.textContent = 'Agregando...';

        try {
            const response = await fetch('/api/convocatoria-personal', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    id_convocatoria: convocatoriaId,
                    id_persona: personaId,
                    id_cargo: cargoId || null,
                    es_firmante: esFirmante,
                    orden_firma: ordenFirma || null,
                }),
            });

            const result = await response.json();

            if (!response.ok) {
                console.error(result);

                let errores = '';

                if (result.errors) {
                    errores = Object.values(result.errors).flat().join('<br>');
                }

                throw new Error(errores || result.message || 'No se pudo agregar el personal.');
            }

            mostrarMensaje('Personal agregado correctamente a la convocatoria.', 'success');

            asignarForm.reset();

            await cargarConvocatoria();

        } catch (error) {
            mostrarMensaje(error.message, 'error');
        } finally {
            btnAsignar.disabled = false;
            btnAsignar.textContent = 'Agregar a convocatoria';
        }
    });

    try {
        await cargarCargos();
        await cargarConvocatoria();

    } catch (e) {
        console.error(e);
        loading.classList.add('hidden');
        error.classList.remove('hidden');
        error.textContent = e.message;
    }
});
</script>
@endsection