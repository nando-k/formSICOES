@extends('layouts.app')

@section('title', 'Vista previa del documento')

@section('content')
<div class="grid grid-cols-1 xl:grid-cols-4 gap-6">

    <div class="xl:col-span-3">
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <div class="max-w-3xl mx-auto border bg-white p-10 shadow-sm min-h-[900px]">

                <div class="text-right text-sm mb-8">
                    <p>La Paz, 30 de junio de 2023</p>
                    <p class="font-semibold">CITE CIDSAF 094/2023</p>
                </div>

                <div class="mb-6 text-sm">
                    <p class="font-semibold">Señores:</p>
                    <p>CAJA NACIONAL DE SALUD</p>
                    <p>Presente.-</p>
                </div>

                <div class="mb-6 text-sm">
                    <p>
                        <span class="font-semibold">Ref.:</span>
                        CONVOCATORIA PÚBLICA CH LP – 085/2023
                        CUCE: 23-1404-00-1345364-1-1
                    </p>
                </div>

                <p class="mb-5 text-sm leading-7">
                    De nuestra consideración:
                </p>

                <p class="mb-5 text-sm leading-7 text-justify">
                    Adjunto a la presente, tenemos el agrado de presentar nuestra oferta de servicios
                    profesionales para efectuar la
                    <span class="font-semibold">
                        “AUDITORÍA EXTERNA DE LOS ESTADOS FINANCIEROS”
                    </span>.
                    En las siguientes páginas, les explicamos por qué consideramos que la
                    <span class="font-semibold">
                        CONSULTORA INTEGRAL DE SERVICIOS DE AUDITORIA Y FINANZAS – CIDSAF S.R.L.
                    </span>
                    es la empresa ideal para trabajar.
                </p>

                <ul class="list-disc pl-6 text-sm leading-7 mb-8">
                    <li>
                        Un equipo de trabajo local aplicando metodologías de auditoría requeridas.
                    </li>
                    <li>
                        Nuestro enfoque ayudará a manejar riesgos y mejorar los resultados.
                    </li>
                    <li>
                        Compromiso y dedicación para trabajar con la entidad convocante.
                    </li>
                </ul>

                <div class="mt-24 text-center text-sm">
                    <div class="border-t border-slate-400 w-80 mx-auto pt-2">
                        <p class="font-semibold">Lic. Aud. Sandra Irene Rodríguez Callisaya</p>
                        <p>REPRESENTANTE LEGAL</p>
                        <p>CONSULTORA INTEGRAL DE SERVICIOS</p>
                        <p>DE AUDITORIA Y FINANZAS – CIDSAF S.R.L.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="bg-white rounded-xl shadow-sm border p-5">
            <h3 class="font-semibold mb-4">Datos utilizados</h3>

            <div class="space-y-4 text-sm">
                <div>
                    <p class="text-slate-500">Entidad</p>
                    <p class="font-medium">Caja Nacional de Salud</p>
                </div>

                <div>
                    <p class="text-slate-500">Convocatoria</p>
                    <p class="font-medium">CH LP – 085/2023</p>
                </div>

                <div>
                    <p class="text-slate-500">CUCE</p>
                    <p class="font-medium">23-1404-00-1345364-1-1</p>
                </div>

                <div>
                    <p class="text-slate-500">Empresa</p>
                    <p class="font-medium">CIDSAF S.R.L.</p>
                </div>

                <div>
                    <p class="text-slate-500">Representante legal</p>
                    <p class="font-medium">Sandra Irene Rodríguez Callisaya</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-5">
            <h3 class="font-semibold mb-4">Acciones</h3>

            <div class="space-y-3">
                <button class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Generar Word
                </button>

                <button class="w-full bg-slate-900 text-white px-4 py-2 rounded-lg hover:bg-slate-800">
                    Descargar PDF
                </button>

                <a href="/formularios" class="block text-center w-full border px-4 py-2 rounded-lg hover:bg-slate-50">
                    Volver
                </a>
            </div>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm text-yellow-800">
            Esta vista es una simulación. Luego el backend reemplazará los campos automáticamente en una plantilla Word real.
        </div>
    </div>

</div>
@endsection