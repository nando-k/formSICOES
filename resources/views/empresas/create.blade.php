@extends('layouts.app')

@section('title', 'Nueva empresa')

@section('content')
<div class="bg-white rounded-xl shadow-sm border p-6 max-w-5xl">
    <h3 class="text-lg font-semibold mb-1">Datos de la empresa</h3>
    <p class="text-sm text-slate-500 mb-6">
        Registre la información del proponente que será utilizada en los formularios.
    </p>

    <form id="empresaForm" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Razón social</label>
            <input name="razon_social" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="CONSULTORA INTEGRAL DE SERVICIOS DE AUDITORIA Y FINANZAS - CIDSAF S.R.L.">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Nombre comercial</label>
            <input name="nombre_comercial" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="CIDSAF S.R.L.">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Tipo de organización</label>
            <select name="tipo_organizacion" class="w-full border rounded-lg px-3 py-2">
                <option value="">Seleccione una opción</option>
                <option value="Sociedad de Responsabilidad Limitada">Sociedad de Responsabilidad Limitada</option>
                <option value="Sociedad Accidental">Sociedad Accidental</option>
                <option value="Profesional Independiente">Profesional Independiente</option>
                <option value="Otra">Otra</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">NIT</label>
            <input name="nit" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="406312025">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Matrícula de comercio</label>
            <input name="matricula_comercio" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="406312025">
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Dirección</label>
            <textarea name="direccion" class="w-full border rounded-lg px-3 py-2" rows="2" placeholder="Calle República Dominicana Nro. 1900, Zona Miraflores"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Ciudad</label>
            <input name="ciudad" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="La Paz">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">País</label>
            <input name="pais" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="Bolivia">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Teléfono</label>
            <input name="telefono" type="text" class="w-full border rounded-lg px-3 py-2" placeholder="2243214 - 73008644">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Correo electrónico</label>
            <input name="correo" type="email" class="w-full border rounded-lg px-3 py-2" placeholder="cidsaf.srl@gmail.com">
        </div>

        <div class="md:col-span-2 flex justify-end gap-3 pt-4">
            <a href="/empresas" class="px-4 py-2 rounded-lg border">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Guardar empresa
            </button>
        </div>
    </form>

    <div id="mensaje" class="hidden mt-5 rounded-lg p-4 text-sm border"></div>
</div>

<script>
document.getElementById('empresaForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const mensaje = document.getElementById('mensaje');

    const data = {
        razon_social: form.razon_social.value,
        nombre_comercial: form.nombre_comercial.value,
        nit: form.nit.value,
        matricula_comercio: form.matricula_comercio.value,
        direccion: form.direccion.value,
        ciudad: form.ciudad.value,
        pais: form.pais.value,
        telefono: form.telefono.value,
        correo: form.correo.value,
        tipo_organizacion: form.tipo_organizacion.value,
    };

    try {
        const response = await fetch('/api/proponentes', {
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
                errores = Object.values(result.errors)
                    .flat()
                    .join(' ');
            }

            throw new Error(result.message || errores || 'No se pudo guardar la empresa.');
        }

        mensaje.className = 'mt-5 rounded-lg p-4 text-sm border bg-green-50 text-green-700 border-green-200';
        mensaje.textContent = 'Empresa guardada correctamente. Redirigiendo...';

        setTimeout(() => {
            window.location.href = '/empresas';
        }, 1000);

    } catch (error) {
        mensaje.className = 'mt-5 rounded-lg p-4 text-sm border bg-red-50 text-red-700 border-red-200';
        mensaje.textContent = error.message;
    }
});
</script>
@endsection