@extends('layouts.restaurateur')

@section('header')
    Mes Restaurants
@endsection

@section('content')
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Liste de vos établissements</h2>
            <p class="text-sm text-gray-500">Gérez vos restaurants, statuts et informations.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="px-4 py-2 rounded-lg bg-gray-100 text-gray-600 text-sm font-semibold hover:bg-gray-200 transition">Tous</button>
            <button class="px-4 py-2 rounded-lg bg-brand-50 text-brand-600 text-sm font-semibold">Actifs</button>
            <a href="{{ route('restaurants.create') }}" class="bg-brand-500 text-white px-4 py-2 rounded-lg font-bold text-sm hover:bg-brand-600 transition flex items-center gap-2">
                <i class="ph-bold ph-plus"></i> Ajouter
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @forelse ($restaurants as $restaurant)
            <div class="bg-white rounded-3xl shadow-card border border-gray-100 overflow-hidden">
                <div class="relative h-44">
                    <img src="{{ $restaurant->image ? asset('storage/'.$restaurant->image) : 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?auto=format&fit=crop&w=1200&q=80' }}" alt="Restaurant" class="w-full h-full object-cover">
                    @if($restaurant->isActive)
                        <span class="absolute top-4 left-4 bg-emerald-100 text-emerald-700 px-3 py-1 rounded-full text-xs font-bold border border-emerald-200">Actif</span>
                    @else
                        <span class="absolute top-4 left-4 bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">Inactif</span>
                    @endif
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $restaurant->nom }}</h3>
                            <p class="text-sm text-gray-500">{{ $restaurant->localisation }} · {{ ucfirst($restaurant->categorie) }}</p>
                        </div>
                        <span class="text-sm text-gray-500">{{ $restaurant->capacite }} couverts</span>
                    </div>

                    <div class="mt-4 flex items-center gap-2 text-xs text-gray-500">
                        <i class="ph ph-map-pin"></i>
                        {{ $restaurant->localisation }}
                    </div>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('restaurants.show', $restaurant->id) }}" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200">Voir</a>
                        <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="px-4 py-2 rounded-lg bg-brand-500 text-white text-sm font-semibold hover:bg-brand-600">Éditer</a>
                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" onsubmit="return confirm('Supprimer ce restaurant ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 rounded-lg bg-red-50 text-red-600 text-sm font-semibold hover:bg-red-100">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
@endsection
