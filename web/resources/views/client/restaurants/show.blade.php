@extends('layouts.client')

@section('content')
<div class="relative h-[60vh] min-h-[500px] w-full overflow-hidden">
    @if($restaurant->image)
        <img src="{{ asset('storage/' . $restaurant->image) }}" class="w-full h-full object-cover">
    @else
        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200&q=80" class="w-full h-full object-cover">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
    
    <div class="absolute bottom-0 left-0 w-full p-8 lg:p-16">
        <div class="max-w-7xl mx-auto reveal active">
            <div class="flex items-center gap-3 mb-6">
                <span class="inline-flex items-center bg-brand-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg shadow-brand-500/20">
                    {{ $restaurant->categorie }}
                </span>
                <span class="inline-flex items-center bg-white/20 backdrop-blur-md text-white border border-white/20 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                    <i class="ph-fill ph-star text-yellow-400 mr-1"></i> 4.5
                </span>
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-extrabold text-white mb-6 tracking-tight">{{ $restaurant->nom }}</h1>
            
            <div class="flex flex-wrap items-center gap-8 text-white/90 font-medium text-lg">
                <span class="flex items-center gap-2 backdrop-blur-sm bg-black/10 px-4 py-2 rounded-full border border-white/10">
                    <i class="ph-fill ph-map-pin text-brand-500"></i> {{ $restaurant->localisation }}
                </span>
                <span class="flex items-center gap-2 backdrop-blur-sm bg-black/10 px-4 py-2 rounded-full border border-white/10">
                    <i class="ph-fill ph-users text-brand-500"></i> {{ $restaurant->capacite }} Places
                </span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-6 lg:px-8 py-16 -mt-10 relative z-10">
    <div class="grid lg:grid-cols-3 gap-12">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] p-10 shadow-float border border-gray-100 mb-12 reveal">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-3">
                    <i class="ph-duotone ph-info text-brand-500 text-3xl"></i> À propos
                </h2>
                <p class="text-gray-600 leading-loose text-lg">{{ $restaurant->description }}</p>
                
                @if($restaurant->images && $restaurant->images->count() > 0)
                <div class="mt-8 flex gap-4 overflow-x-auto pb-4 hide-scroll">
                    @foreach($restaurant->images as $img)
                        <img src="{{ asset('storage/' . $img->url) }}" class="h-32 w-48 object-cover rounded-xl shadow-md hover:scale-105 transition duration-300">
                    @endforeach
                </div>
                @endif
            </div>

            <h2 class="text-3xl font-extrabold mb-10 flex items-center gap-4 text-gray-900">
                <span class="w-12 h-12 rounded-2xl bg-brand-500 flex items-center justify-center text-white shadow-lg shadow-brand-500/30">
                    <i class="ph-bold ph-book-open"></i>
                </span>
                Menus & Carte
            </h2>

            <div class="space-y-12">
                @forelse($restaurant->menus as $menu)
                    <div class="reveal">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $menu->name }}</h3>
                            <div class="h-px bg-gray-200 flex-1 ml-6"></div>
                        </div>
                        
                        <div class="grid gap-6">
                            @forelse($menu->plat as $plat)
                                <div class="group bg-white rounded-3xl p-4 border border-gray-100 shadow-sm hover:shadow-card hover:border-brand-500/30 transition duration-300 flex flex-col sm:flex-row gap-6">
                                    <div class="w-full sm:w-32 h-32 rounded-2xl overflow-hidden bg-gray-100 flex-shrink-0 relative">
                                         @if($plat->images->isNotEmpty())
                                            <img src="{{ asset('storage/' . $plat->images->first()->url) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                         @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-50">
                                                <i class="ph-duotone ph-image text-3xl"></i>
                                            </div>
                                         @endif
                                         <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition duration-300"></div>
                                    </div>
                                    
                                    <div class="flex-1 py-2">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="text-xl font-bold text-gray-900 group-hover:text-brand-500 transition">{{ $plat->name }}</h4>
                                            <span class="text-xl font-extrabold text-brand-500">{{ $plat->prix }}<span class="text-sm font-normal text-gray-400 ml-1">MAD</span></span>
                                        </div>
                                        <p class="text-gray-500 leading-relaxed">{{ $plat->description }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 bg-surface rounded-2xl border border-dashed border-gray-200">
                                    <p class="text-gray-400 font-medium">Aucun plat dans ce menu.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-gray-50 rounded-[3rem]">
                        <i class="ph-duotone ph-scroll text-4xl text-gray-300 mb-4 inline-block"></i>
                        <p class="text-gray-500 font-medium">Aucun menu disponible pour le moment.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar Actions -->
        <div>
            <div class="bg-white rounded-[2rem] p-8 shadow-card sticky top-32 border border-gray-100 reveal">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-14 h-14 rounded-full bg-gray-900 text-white flex items-center justify-center text-2xl font-bold shadow-lg">
                        <i class="ph-fill ph-chef-hat"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-bold uppercase tracking-wider">Restaurateur</p>
                        <p class="text-lg font-bold text-gray-900">{{ $restaurant->user->name ?? 'Partenaire YouCo' }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <form action="{{ route('client.restaurants.favorite', $restaurant->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-4 rounded-xl flex items-center justify-center gap-2 font-bold transition duration-300 border-2 {{ Auth::user()->favoris->contains($restaurant->id) ? 'border-red-500 bg-red-50 text-red-500 hover:bg-red-100' : 'border-gray-100 bg-white text-gray-600 hover:border-gray-200 hover:bg-gray-50' }}">
                            <i class="{{ Auth::user()->favoris->contains($restaurant->id) ? 'ph-fill' : 'ph-bold' }} ph-heart text-xl"></i>
                            {{ Auth::user()->favoris->contains($restaurant->id) ? 'Retirer des favoris' : 'Ajouter aux favoris' }}
                        </button>
                    </form>

                    <button class="w-full bg-brand-500 hover:bg-brand-600 text-white py-4 rounded-xl font-bold shadow-xl shadow-brand-500/30 transition duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-2 group">
                        <span>Réserver une table</span>
                        <i class="ph-bold ph-calendar-check text-xl group-hover:scale-110 transition"></i>
                    </button>
                    
                    <p class="text-center text-xs text-gray-400 mt-4">Aucun frais de réservation</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
