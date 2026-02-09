<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Restaurateur') - YouCo\'Done</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { 50: '#fff7ed', 500: '#FF4F18', 600: '#E03E0B', 900: '#1a1a1a' },
                        surface: '#F8F9FC',
                        sidebar: '#FFFFFF'
                    },
                    fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
                    boxShadow: { 'card': '0 4px 20px -2px rgba(0, 0, 0, 0.05)' }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hide-scroll::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-surface text-gray-900 antialiased h-screen flex overflow-hidden">

    @include('components.restaurateur-sidebar')

    <main class="flex-1 flex flex-col h-full relative overflow-y-auto hide-scroll">
        
        <header class="h-20 flex items-center justify-between px-8 bg-surface/90 backdrop-blur-md sticky top-0 z-10">
            <h1 class="text-2xl font-bold text-gray-900 hidden lg:block">@yield('header', 'Tableau de bord')</h1>
            
            <div class="lg:hidden text-brand-500 font-bold">YouCo'Done</div>

            <div class="flex items-center gap-4">
                <span class="text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Restaurateur' }}</span>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Restaurateur' }}&background=FF4F18&color=fff" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
            </div>
        </header>

        <div class="px-8 pb-12">
            @yield('content')
        </div>

    </main>

</body>
</html>