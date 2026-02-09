@extends('layouts.restaurateur')

@section('header')
    <div class="flex items-center gap-2">
        <span class="text-gray-400 font-normal">Restaurant /</span>
        <span>Vue d'ensemble</span>
    </div>
@endsection

@section('content')
    <div class="py-8 space-y-8 max-w-7xl mx-auto">
        
        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-100/50 overflow-hidden border border-gray-100">
            <div class="p-8 md:p-10 flex flex-col lg:flex-row gap-8 items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-4 mb-2">
                        @if($restaurant->isActive)
                            <span class="bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full text-xs font-bold border border-emerald-100 flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Actif
                            </span>
                        @else
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold border border-gray-200">Inactif</span>
                        @endif
                        <span class="text-xs font-bold tracking-wider text-gray-400 uppercase">Cuisine {{ ucfirst($restaurant->categorie) }}</span>
                    </div>
                    
                    <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2">{{ $restaurant->nom }}</h1>
                    
                    <div class="flex items-center gap-2 text-gray-500 mb-6">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="font-medium">{{ $restaurant->localisation }}</span>
                    </div>

                    <p class="text-gray-600 leading-relaxed max-w-2xl bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        {{ $restaurant->description }}
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="group flex items-center gap-2 px-6 py-3 rounded-xl bg-gray-900 text-white text-sm font-bold hover:bg-gray-800 transition-all shadow-lg shadow-gray-900/20">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Modifier
                        </a>
                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" onsubmit="return confirm('Supprimer ce restaurant ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center gap-2 px-6 py-3 rounded-xl bg-white text-red-500 border border-red-100 text-sm font-bold hover:bg-red-50 hover:border-red-200 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 w-full lg:w-auto min-w-[300px]">
                    <div class="bg-blue-50 p-5 rounded-2xl border border-blue-100">
                        <p class="text-xs uppercase font-bold text-blue-400 mb-1">Capacité</p>
                        <p class="text-2xl font-black text-blue-900">{{ $restaurant->capacite }}</p>
                        <p class="text-xs text-blue-600">Couverts</p>
                    </div>
                    <div class="bg-purple-50 p-5 rounded-2xl border border-purple-100">
                        <p class="text-xs uppercase font-bold text-purple-400 mb-1">Horaires</p>
                        <p class="text-xl font-black text-purple-900">12h - 23h</p>
                        <p class="text-xs text-purple-600">Ouvert 7j/7</p>
                    </div>
                    <div class="col-span-2 bg-gray-50 p-5 rounded-2xl border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase font-bold text-gray-400 mb-1">Contact</p>
                            <p class="text-lg font-bold text-gray-900">+33 1 23 45 67 89</p>
                        </div>
                        <div class="h-10 w-10 bg-white rounded-full flex items-center justify-center shadow-sm text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <div class="xl:col-span-2 space-y-8">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        La Carte des Menus
                    </h3>
                    
                    <form action="{{ route('restaurants.menus.store', $restaurant->id) }}" method="POST" class="flex shadow-sm rounded-lg overflow-hidden">
                        @csrf
                        <input type="text" name="name" placeholder="Nouveau menu..." class="px-4 py-2 bg-white border border-r-0 border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 w-48" required>
                        <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-bold hover:bg-gray-800 transition-colors">
                            + Ajouter
                        </button>
                    </form>
                </div>

                @forelse ($restaurant->menus as $menu)
                    <div class="bg-white rounded-[1.5rem] border border-gray-100 shadow-card overflow-hidden">
                        <div class="px-6 py-4 bg-gray-50/50 border-b border-gray-100 flex items-center justify-between">
                            <h4 class="text-lg font-bold text-gray-800">{{ $menu->name ?? ('Menu #'.$menu->id) }}</h4>
                            <span class="bg-white px-3 py-1 rounded-full text-xs font-semibold text-gray-500 border border-gray-200 shadow-sm">
                                {{ $menu->plat->count() }} Plats
                            </span>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse ($menu->plat as $plat)
                                    <div class="group relative flex gap-4 p-3 bg-white rounded-2xl border border-gray-100 hover:border-brand-200 hover:shadow-lg hover:shadow-brand-500/10 transition-all duration-300">
                                        <div class="shrink-0 w-24 h-24 rounded-xl overflow-hidden bg-gray-100 relative">
                                            @if($plat->images->count())
                                                <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="{{ asset('storage/'.$plat->images->first()->url) }}" alt="{{ $plat->name }}">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-50">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="flex-1 min-w-0 flex flex-col justify-between py-1">
                                            <div>
                                                <div class="flex justify-between items-start gap-2">
                                                    <h5 class="font-bold text-gray-900 truncate pr-4">{{ $plat->name }}</h5>
                                                    <span class="shrink-0 font-bold text-brand-600 bg-brand-50 px-2 py-0.5 rounded-md text-sm border border-brand-100">
                                                        {{ $plat->prix }} DH
                                                    </span>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $plat->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-full text-center py-6">
                                        <p class="text-gray-400 italic text-sm">Ce menu est encore vide. Ajoutez de délicieux plats ! 😋</p>
                                    </div>
                                @endforelse
                            </div>

                            <div class="mt-6 pt-6 border-t border-dashed border-gray-200">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Ajouter un plat à ce menu</p>
                                <form action="{{ route('menus.plat.store', $menu->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                                    @csrf
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                                        <div class="md:col-span-4">
                                            <input type="text" name="name" placeholder="Nom du plat" class="w-full px-3 py-2 rounded-lg border-gray-200 text-sm focus:ring-brand-500 focus:border-brand-500" required>
                                        </div>
                                        <div class="md:col-span-2">
                                            <input type="number" name="prix" placeholder="Prix" class="w-full px-3 py-2 rounded-lg border-gray-200 text-sm focus:ring-brand-500 focus:border-brand-500" required>
                                        </div>
                                        <div class="md:col-span-6">
                                            <input type="text" name="description" placeholder="Description courte et appétissante" class="w-full px-3 py-2 rounded-lg border-gray-200 text-sm focus:ring-brand-500 focus:border-brand-500" required>
                                        </div>
                                        <div class="md:col-span-8">
                                            <label class="flex items-center gap-2 cursor-pointer w-full bg-white border border-gray-200 border-dashed rounded-lg px-3 py-1.5 hover:bg-gray-50 transition-colors">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                <span class="text-xs text-gray-500">Choisir une photo...</span>
                                                <input type="file" name="photo" class="hidden">
                                            </label>
                                        </div>
                                        <div class="md:col-span-4">
                                            <button type="submit" class="w-full px-3 py-2 rounded-lg bg-gray-900 text-white text-xs font-bold uppercase tracking-wider hover:bg-black transition-colors">
                                                Sauvegarder
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-[2rem] p-12 text-center border border-gray-100 shadow-sm">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">🍃</div>
                        <h3 class="text-lg font-bold text-gray-900">Aucun menu pour le moment</h3>
                        <p class="text-gray-500 mt-2">Commencez par créer votre premier menu ci-dessus.</p>
                    </div>
                @endforelse
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-[1.5rem] shadow-card p-6 border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center justify-between">
                        Galerie
                        <span class="text-xs font-normal text-gray-400">{{ $restaurant->images->count() }} photos</span>
                    </h3>
                    <div class="grid grid-cols-2 gap-2">
                        @forelse ($restaurant->images as $index => $image)
                            @if($index < 4) 
                            <div class="aspect-square rounded-xl overflow-hidden relative group">
                                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="{{ asset('storage/'.$image->url) }}" alt="Photo">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                            </div>
                            @endif
                        @empty
                            <div class="col-span-2 aspect-video rounded-xl bg-gray-50 border border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-xs">Aucune photo</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection