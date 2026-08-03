@extends('layouts.app')

@section('title', 'Nueva persona')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-emerald-950 via-slate-900 to-teal-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-emerald-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-emerald-300 text-sm font-medium mb-2">
                    Registro de persona
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Nueva persona
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Registre personas en la población general. Luego podrán asignarse como personal de una empresa.
                </p>
            </div>

            <a href="/personal" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver al listado
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-6xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Datos de la persona</h4>
            <p class="text-sm text-slate-500 mt-1">
                Complete la información principal de la persona.
            </p>
        </div>

        <form id="personalForm" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nombres</label>
                <input 
                    name="nombres" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                    placeholder="Sandra Irene" 
                    required
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido paterno</label>
                <input 
                    name="apellido_paterno" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                    placeholder="Rodríguez"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Apellido materno</label>
                <input 
                    name="apellido_materno" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                    placeholder="Callisaya"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Cédula de identidad</label>
                <input 
                    name="ci" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                    placeholder="4791992"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Expedido</label>
                <select 
                    name="expedido" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                >
                    <option value="">Seleccione</option>
                    <option value="LP">LP</option>
                    <option value="CB">CB</option>
                    <option value="SC">SC</option>
                    <option value="OR">OR</option>
                    <option value="PT">PT</option>
                    <option value="CH">CH</option>
                    <option value="TJ">TJ</option>
                    <option value="BN">BN</option>
                    <option value="PD">PD</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                <input 
                    name="telefono" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                    placeholder="73008644"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                <input 
                    name="correo" 
                    type="email" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                    placeholder="correo@empresa.com"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Profesión</label>
                <input 
                    name="profesion" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                    placeholder="Auditor financiero"
                >
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Dirección</label>
                <textarea 
                    name="direccion" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" 
                    rows="2" 
                    placeholder="Dirección de la persona"
                ></textarea>
            </div>

            <div class="md:col-span-2">
                <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>
            </div>

            <div class="md:col-span-2 flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="/personal" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center">
                    Cancelar
                </a>

                <button 
                    type="submit" 
                    id="btnGuardar" 
                    class="bg-emerald-600 text-white px-5 py-3 rounded-2xl hover:bg-emerald-500 shadow-lg shadow-emerald-950/20 font-semibold transition"
                >
                    Guardar persona
                </button>
            </div>
        </form>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('personalForm');
    const btnGuardar = document.getElementById('btnGuardar');
    const mensaje = document.getElementById('mensaje');

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

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const data = {
            nombres: convertirMayusculas(form.nombres.value),
            apellido_paterno: convertirMayusculas(form.apellido_paterno.value),
            apellido_materno: convertirMayusculas(form.apellido_materno.value),
            ci: convertirMayusculas(form.ci.value),
            expedido: convertirMayusculas(form.expedido.value),
            telefono: convertirMayusculas(form.telefono.value),
            correo: form.correo.value.trim().toLowerCase(),
            profesion: convertirMayusculas(form.profesion.value),
            direccion: convertirMayusculas(form.direccion.value),
        };

        btnGuardar.disabled = true;
        btnGuardar.textContent = 'Guardando...';

        try {
            const response = await fetch('/api/personas', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();

            if (!response.ok) {
                console.error(result);

                let errores = '';

                if (result.errors) {
                    errores = Object.values(result.errors).flat().join('<br>');
                }

                throw new Error(errores || result.message || 'No se pudo guardar el personal.');
            }

            mostrarMensaje('Personal registrado correctamente. Redirigiendo...', 'success');

            setTimeout(() => {
                window.location.href = '/personal';
            }, 900);

        } catch (error) {
            mostrarMensaje(error.message, 'error');
        } finally {
            btnGuardar.disabled = false;
            btnGuardar.textContent = 'Guardar personal';
        }
    });
});

    function convertirMayusculas(valor) {
        return valor ? valor.trim().toUpperCase() : valor;
    }

    const camposMayusculas = document.querySelectorAll(
        'input[type="text"], textarea, select'
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
</script>
@endsection