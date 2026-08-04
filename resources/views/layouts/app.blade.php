<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Formularios</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-72 bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white hidden md:flex md:flex-col shadow-2xl">
            <div class="px-6 py-6 border-b border-white/10">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-400 to-cyan-500 flex items-center justify-center font-black text-slate-950 shadow-lg">
                        A
                    </div>

                    <div>
                        <h1 class="text-lg font-bold leading-tight">Auditoría</h1>
                        <p class="text-xs text-slate-400">Gestión documental</p>
                    </div>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1">
                <a href="/dashboard"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('dashboard') ? 'bg-white text-slate-900 shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>Inicio</span>
                </a>

                <a href="/empresas"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('empresas*') ? 'bg-white text-slate-900 shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>Empresas</span>
                </a>

                <a href="/entidades"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('entidades*') ? 'bg-white text-slate-900 shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>Entidades</span>
                </a>

                <a href="/personal"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('personal*') ? 'bg-white text-slate-900 shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>Personal</span>
                </a>

                <a href="/convocatorias"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('convocatorias*') ? 'bg-white text-slate-900 shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>Convocatorias</span>
                </a>

                <a href="/propuestas"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('propuestas*') ? 'bg-white text-slate-900 shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>Propuestas</span>
                </a>

                <a href="/formularios"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('formularios') ? 'bg-white text-slate-900 shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>Formularios</span>
                </a>

                <a href="/documentos"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->is('documentos*') ? 'bg-white text-slate-900 shadow-sm font-semibold' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}">
                    <span>Documentos</span>
                </a>

                <div class="pt-5 mt-5 border-t border-white/10">
                    <a href="/formularios/generar"
                       class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold shadow-lg shadow-emerald-950/40 hover:from-emerald-400 hover:to-teal-400 transition">
                        Generar documentos
                    </a>
                </div>
            </nav>

            <div class="px-6 py-5 border-t border-white/10">
                <div class="rounded-2xl bg-white/5 border border-white/10 p-4">
                    <p class="text-xs text-slate-400 mb-1">Estado del sistema</p>
                    <p class="text-sm font-semibold text-emerald-300">Operativo</p>
                </div>
            </div>
        </aside>

        <!-- Contenido -->
        <main class="flex-1 min-w-0">

            <!-- Body -->
            <section class="p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </section>

        </main>

    </div>

</body>
</html>