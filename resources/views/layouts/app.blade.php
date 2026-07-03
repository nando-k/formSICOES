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
                <p class="text-xs text-slate-400">Gestión de propuestas</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="/dashboard" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Dashboard
                </a>
                <a href="/empresas" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Empresas
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
                <a href="/propuestas/generar" class="block px-4 py-2 rounded-lg hover:bg-slate-800">
                    Generar documentos
                </a>
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