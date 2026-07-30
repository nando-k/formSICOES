<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Formularios</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-white hidden md:flex md:flex-col">
            <div class="px-6 py-5 border-b border-slate-700">
                <h1 class="text-lg font-bold">Auditoría</h1>
                <p class="text-xs text-slate-400">Gestión documental de propuestas</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="/dashboard" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Dashboard
                </a>

                <a href="/empresas" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Empresas
                </a>

                <a href="/entidades" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Entidades
                </a>

                <a href="/personal" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Personal
                </a>

                <a href="/convocatorias" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Convocatorias
                </a>

                <a href="/propuestas" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Propuestas
                </a>

                <a href="/formularios" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Formularios
                </a>

                <a href="/documentos" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Documentos
                </a>

                <div class="pt-4 mt-4 border-t border-slate-700">
                    <a href="/formularios/generar" class="block px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white font-medium">
                        Generar documentos
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Contenido -->
        <main class="flex-1">
            <header class="bg-white border-b border-slate-200 px-6 py-4">
                <h2 class="text-xl font-semibold">@yield('title', 'Sistema')</h2>
            </header>

            <section class="p-6">
                @yield('content')
            </section>
        </main>

    </div>

</body>
</html>