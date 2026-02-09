<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Restaurants</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-2">
                    <div class="bg-indigo-600 text-white p-1.5 rounded-lg">
                        <i class="ph-bold ph-gear text-xl"></i>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-gray-900">AdminPanel</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-sm text-right hidden sm:block">
                        <p class="font-medium text-gray-900">Administrateur</p>
                        <p class="text-xs text-gray-500">Super Admin</p>
                    </div>
                    <div class="h-10 w-10 bg-gray-200 rounded-full border-2 border-white shadow-sm flex items-center justify-center overflow-hidden">
                        <i class="ph-fill ph-user text-gray-400 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Vue d'ensemble</h1>
                <p class="mt-1 text-gray-500">Gérez les restaurants et surveillez l'activité de la plateforme.</p>
            </div>
            
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5 min-w-[250px]">
                <div class="h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <i class="ph-duotone ph-storefront text-2xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Restaurants Actifs</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['active'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        @if(session('status'))
            <div class="mb-8 flex items-center gap-3 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm animate-fade-in-down">
                <i class="ph-fill ph-check-circle text-emerald-500 text-xl"></i>
                <p class="text-sm font-medium text-emerald-800">{{ session('status') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-[1.5rem] shadow-xl shadow-gray-100/50 border border-gray-200 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <i class="ph-duotone ph-list-dashes text-indigo-500"></i>
                    Liste des Restaurants
                </h2>
                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">
                    Total: {{ count($restaurants) }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500 font-semibold">
                            <th class="px-8 py-4">ID</th>
                            <th class="px-8 py-4">Restaurant</th>
                            <th class="px-8 py-4">Propriétaire</th>
                            <th class="px-8 py-4 text-center">Statut</th>
                            <th class="px-8 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($restaurants as $restaurant)
                            <tr class="hover:bg-gray-50/80 transition-colors duration-200 group">
                                <td class="px-8 py-4 text-gray-400 font-mono text-xs">
                                    #{{ str_pad($restaurant->id, 4, '0', STR_PAD_LEFT) }}
                                </td>
                                
                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-indigo-200">
                                            {{ substr($restaurant->nom, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $restaurant->nom }}</p>
                                            <p class="text-xs text-gray-400">Cuisine {{ $restaurant->categorie ?? 'Générale' }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-8 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="h-6 w-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 text-xs">
                                            <i class="ph-bold ph-user"></i>
                                        </div>
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ optional($restaurant->user)->name ?? '—' }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-8 py-4 text-center">
                                    @if($restaurant->isActive)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                            <span class="relative flex h-2 w-2">
                                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                              <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                            </span>
                                            Actif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500 border border-gray-200">
                                            <span class="h-2 w-2 rounded-full bg-gray-400"></span>
                                            Inactif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-8 py-4 text-right">
                                    <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce restaurant ?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="group/btn flex items-center justify-center w-8 h-8 rounded-lg bg-white border border-gray-200 text-gray-400 hover:bg-red-50 hover:text-red-600 hover:border-red-100 transition-all shadow-sm">
                                            <i class="ph-bold ph-trash text-lg"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="h-16 w-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="ph-duotone ph-storefront text-3xl text-gray-300"></i>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900">Aucun restaurant trouvé</h3>
                                        <p class="text-gray-500 text-sm mt-1">La base de données est vide pour le moment.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                <p class="text-xs text-gray-500">Affichage de tous les résultats</p>
                <div class="flex gap-1">
                    <button class="px-3 py-1 rounded-md border border-gray-200 bg-white text-xs font-medium text-gray-400 cursor-not-allowed">Précédent</button>
                    <button class="px-3 py-1 rounded-md border border-gray-200 bg-white text-xs font-medium text-gray-400 cursor-not-allowed">Suivant</button>
                </div>
            </div>
        </div>
    </main>

</body>
</html>