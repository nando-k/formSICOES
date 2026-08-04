@extends('layouts.app')

@section('title', 'Editar entidad')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-purple-950 via-slate-900 to-indigo-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-purple-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-purple-300 text-sm font-medium mb-2">
                    Actualización de entidad
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Editar entidad
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Modifique los datos de la institución o entidad convocante.
                </p>
            </div>

            <a href="/entidades" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver al listado
            </a>
        </div>
    </div>

    <div id="loading" class="bg-white border border-slate-200 rounded-3xl p-6 text-slate-500 shadow-sm">
        Cargando entidad...
    </div>

    <div id="error" class="hidden bg-red-50 border border-red-200 text-red-700 rounded-3xl p-5">
        No se pudo cargar la entidad.
    </div>

    <div id="formContainer" class="hidden bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-5xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Datos de la entidad</h4>
            <p class="text-sm text-slate-500 mt-1">
                Actualice la información registrada.
            </p>
        </div>

        <form id="entidadForm" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre de la entidad</label>
                <input name="nombre_entidad" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Dirección</label>
                <textarea name="direccion" rows="2" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Ciudad</label>
                <input name="ciudad" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                <input name="telefono" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                <input name="correo" type="email" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Persona de contacto</label>
                <input name="contacto" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Cargo del contacto</label>
                <input name="cargo_contacto" type="text" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">
            </div>

            <div class="md:col-span-2">
                <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>
            </div>

            <div class="md:col-span-2 flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="/entidades" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center">
                    Cancelar
                </a>

                <button type="submit" id="btnGuardar" class="bg-purple-600 text-white px-5 py-3 rounded-2xl hover:bg-purple-500 shadow-lg shadow-purple-950/20 font-semibold transition">
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
    const entidadId = @json($id);

    const loading = document.getElementById('loading');
    const error = document.getElementById('error');
    const formContainer = document.getElementById('formContainer');
    const form = document.getElementById('entidadForm');
    const mensaje = document.getElementById('mensaje');
    const btnGuardar = document.getElementById('btnGuardar');

    const inputNombre = form.querySelector('[name="nombre_entidad"]');
    const inputDireccion = form.querySelector('[name="direccion"]');
    const inputCiudad = form.querySelector('[name="ciudad"]');
    const inputTelefono = form.querySelector('[name="telefono"]');
    const inputCorreo = form.querySelector('[name="correo"]');
    const inputContacto = form.querySelector('[name="contacto"]');
    const inputCargoContacto = form.querySelector('[name="cargo_contacto"]');

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

    try {
        const response = await fetch(`/api/entidades/${entidadId}`, {
            headers: {
                'Accept': 'application/json',
            }
        });

        const result = await response.json();

        console.log('Respuesta API entidad:', result);

        if (!response.ok) {
            throw new Error(result.message || 'No se pudo cargar la entidad.');
        }

        const entidad = result.data ?? result.entidad ?? result;

        inputNombre.value = entidad.nombre_entidad ?? '';
        inputDireccion.value = entidad.direccion ?? '';
        inputCiudad.value = entidad.ciudad ?? '';
        inputTelefono.value = entidad.telefono ?? '';
        inputCorreo.value = entidad.correo ?? '';
        inputContacto.value = entidad.contacto ?? '';
        inputCargoContacto.value = entidad.cargo_contacto ?? '';

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
            nombre_entidad: convertirMayusculas(inputNombre.value),
            direccion: convertirMayusculas(inputDireccion.value),
            ciudad: convertirMayusculas(inputCiudad.value),
            telefono: convertirMayusculas(inputTelefono.value),
            correo: inputCorreo.value.trim().toLowerCase(),
            contacto: convertirMayusculas(inputContacto.value),
            cargo_contacto: convertirMayusculas(inputCargoContacto.value),
        };

        btnGuardar.disabled = true;
        btnGuardar.textContent = 'Guardando...';

        try {
            const response = await fetch(`/api/entidades/${entidadId}`, {
                method: 'PUT',
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

                throw new Error(errores || result.message || 'No se pudo actualizar la entidad.');
            }

            mostrarMensaje('Entidad actualizada correctamente. Redirigiendo...', 'success');

            setTimeout(() => {
                window.location.href = '/entidades';
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