@extends('layouts.app')

@section('title', 'Nueva empresa')

@section('content')
<div class="space-y-6">

    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-950 via-slate-900 to-cyan-900 p-7 shadow-xl">
        <div class="absolute -right-16 -top-16 w-64 h-64 rounded-full bg-cyan-400/20 blur-3xl"></div>

        <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div>
                <p class="text-cyan-300 text-sm font-medium mb-2">
                    Registro de proponente
                </p>

                <h3 class="text-2xl font-bold text-white">
                    Nueva empresa
                </h3>

                <p class="text-slate-300 mt-2 max-w-2xl">
                    Registre la información del proponente que será utilizada en convocatorias, propuestas y documentos generados.
                </p>
            </div>

            <a href="/empresas" class="bg-white/10 text-white px-5 py-3 rounded-2xl hover:bg-white/20 border border-white/10 text-center">
                Volver al listado
            </a>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden max-w-6xl">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="font-bold text-slate-900">Datos de la empresa</h4>
            <p class="text-sm text-slate-500 mt-1">
                Complete los campos principales del proponente.
            </p>
        </div>

        <form id="empresaForm" class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Razón social</label>
                <input 
                    name="razon_social" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" 
                    placeholder="CONSULTORA INTEGRAL DE SERVICIOS DE AUDITORIA Y FINANZAS - CIDSAF S.R.L."
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Nombre comercial</label>
                <input 
                    name="nombre_comercial" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" 
                    placeholder="CIDSAF S.R.L."
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Tipo de organización</label>
                <select 
                    name="tipo_organizacion" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition"
                >
                    <option value="">Seleccione una opción</option>
                    <option value="Sociedad de Responsabilidad Limitada">Sociedad de Responsabilidad Limitada</option>
                    <option value="Sociedad Accidental">Sociedad Accidental</option>
                    <option value="Profesional Independiente">Profesional Independiente</option>
                    <option value="Otra">Otra</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">NIT</label>
                <input 
                    name="nit" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" 
                    placeholder="406312025"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Matrícula de comercio</label>
                <input 
                    name="matricula_comercio" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" 
                    placeholder="406312025"
                >
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-slate-700 mb-1">Dirección</label>
                <textarea 
                    name="direccion" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" 
                    rows="2" 
                    placeholder="Calle República Dominicana Nro. 1900, Zona Miraflores"
                ></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Ciudad</label>
                <input 
                    name="ciudad" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" 
                    placeholder="La Paz"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">País</label>
                <input 
                    name="pais" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" 
                    placeholder="Bolivia"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Teléfono</label>
                <input 
                    name="telefono" 
                    type="text" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" 
                    placeholder="2243214 - 73008644"
                >
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Correo electrónico</label>
                <input 
                    name="correo" 
                    type="email" 
                    class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition" 
                    placeholder="cidsaf.srl@gmail.com"
                >
            </div>

            <div class="md:col-span-2">
                <div id="mensaje" class="hidden rounded-2xl p-4 text-sm border"></div>
            </div>

            <div class="md:col-span-2 flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-slate-100">
                <a href="/empresas" class="px-5 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 text-center">
                    Cancelar
                </a>

                <button 
                    type="submit" 
                    id="btnGuardar"
                    class="bg-cyan-600 text-white px-5 py-3 rounded-2xl hover:bg-cyan-500 shadow-lg shadow-cyan-950/20 font-semibold transition"
                >
                    Guardar empresa
                </button>
            </div>
        </form>
    </div>

</div>

<script>
document.getElementById('empresaForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const mensaje = document.getElementById('mensaje');
    const btnGuardar = document.getElementById('btnGuardar');

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

    btnGuardar.disabled = true;
    btnGuardar.textContent = 'Guardando...';

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
                    .join('<br>');
            }

            throw new Error(result.message || errores || 'No se pudo guardar la empresa.');
        }

        mensaje.className = 'rounded-2xl p-4 text-sm border bg-green-50 text-green-700 border-green-200';
        mensaje.innerHTML = 'Empresa guardada correctamente. Redirigiendo...';

        setTimeout(() => {
            window.location.href = '/empresas';
        }, 900);

    } catch (error) {
        mensaje.className = 'rounded-2xl p-4 text-sm border bg-red-50 text-red-700 border-red-200';
        mensaje.innerHTML = error.message;
    } finally {
        btnGuardar.disabled = false;
        btnGuardar.textContent = 'Guardar empresa';
    }
});
</script>
@endsection