@extends('layouts.app')

@section('title', 'Nuevo personal')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6 max-w-5xl">
    <h3 class="text-lg font-semibold mb-1">Datos del personal</h3>
    <p class="text-sm text-slate-500 mb-6">
        Registre los datos de las personas que participarán en las propuestas.
    </p>

    <form id="personalForm" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium mb-1">Nombres</label>
            <input name="nombres" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Sandra Irene" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Apellido paterno</label>
            <input name="apellido_paterno" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Rodríguez">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Apellido materno</label>
            <input name="apellido_materno" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Callisaya">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Cédula de identidad</label>
            <input name="ci" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="4791992">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Expedido</label>
            <select name="expedido" class="w-full border rounded-lg px-3 py-2">
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
            <label class="block text-sm font-medium mb-1">Teléfono</label>
            <input name="telefono" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="73008644">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Correo electrónico</label>
            <input name="correo" type="email" class="w-full border rounded-lg px-3 py-2" placeholder="correo@empresa.com">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Profesión</label>
            <input name="profesion" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Auditor financiero">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Dirección</label>
            <textarea name="direccion" class="w-full border rounded-lg px-3 py-2" rows="2" placeholder="Dirección de la persona"></textarea>
        </div>

        <div class="md:col-span-2">
            <div id="mensaje" class="hidden rounded-lg p-4 text-sm"></div>
        </div>

        <div class="md:col-span-2 flex justify-end gap-3 pt-4">
            <a href="/personal" class="px-4 py-2 rounded-lg border">
                Cancelar
            </a>

            <button type="submit" id="btnGuardar" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Guardar personal
            </button>
        </div>
    </form>
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
            nombres: form.nombres.value,
            apellido_paterno: form.apellido_paterno.value,
            apellido_materno: form.apellido_materno.value,
            ci: form.ci.value,
            expedido: form.expedido.value,
            telefono: form.telefono.value,
            correo: form.correo.value,
            profesion: form.profesion.value,
            direccion: form.direccion.value,
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

            mostrarMensaje('Personal registrado correctamente.', 'success');

            setTimeout(() => {
                window.location.href = '/personal';
            }, 700);

        } catch (error) {
            mostrarMensaje(error.message, 'error');
        } finally {
            btnGuardar.disabled = false;
            btnGuardar.textContent = 'Guardar personal';
        }
    });
});
</script>
@endsection