@extends('layouts.client')

@section('content')
<div class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
    <div class="flex justify-between items-end mb-12">
        <div>
            <span class="text-brand-500 font-bold tracking-wider uppercase text-sm">Découverte</span>
            <h2 class="text-4xl font-extrabold text-gray-900 mt-2">Tous les Restaurants</h2>
        </div>
        
        <div class="flex gap-2">
            <button class="px-4 py-2 rounded-full bg-surface border border-gray-200 text-sm font-semibold hover:border-brand-500 hover:text-brand-500 transition">
                <i class="ph-bold ph-sliders-horizontal mr-2"></i> Filtres
            </button>
        </div>
    </div>

    @if($restaurants->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-[3rem]">
            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                <i class="ph-duotone ph-storefront text-4xl text-gray-300"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Aucun restaurant trouvé</h3>
            <p class="text-gray-500 mt-2">Revenez plus tard pour découvrir de nouvelles adresses.</p>
        </div>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($restaurants as $restaurant)
                <div class="group reveal relative block h-full bg-white rounded-[2rem] border border-gray-100 shadow-card hover:shadow-float transition duration-500 transform hover:-translate-y-1">
                    <div class="relative h-64 rounded-t-[2rem] overflow-hidden">
                        @if($restaurant->image)
                            <img src="{{ asset('storage/' . $restaurant->image) }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-700" 
                                 alt="{{ $restaurant->nom }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-700" 
                                 alt="Default Restaurant Image">
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

                        <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                            <span class="bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide text-gray-800 flex items-center gap-1 shadow-sm">
                                <i class="ph-fill ph-map-pin text-brand-500"></i> {{ $restaurant->localisation }}
                            </span>
                            
                            <form action="{{ route('client.restaurants.favorite', $restaurant->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-10 h-10 bg-white/90 backdrop-blur-md rounded-full flex items-center justify-center transition duration-300 hover:scale-110 shadow-sm {{ Auth::user()->favoris->contains($restaurant->id) ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }}">
                                    <i class="{{ Auth::user()->favoris->contains($restaurant->id) ? 'ph-fill' : 'ph-bold' }} ph-heart text-xl"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <a href="{{ route('client.restaurants.show', $restaurant->id) }}" class="group-hover:text-brand-500 transition">
                                 <h3 class="text-2xl font-bold text-gray-900 line-clamp-1">{{ $restaurant->nom }}</h3>
                            </a>
                            <div class="flex items-center gap-1 bg-yellow-50 px-2 py-1 rounded-md text-xs font-bold text-yellow-600">
                                <i class="ph-fill ph-star text-yellow-400"></i> 4.5
                            </div>
                        </div>
                        
                        <p class="text-gray-500 text-sm mb-6 line-clamp-2 leading-relaxed">{{ $restaurant->description }}</p>
                        
                        <div class="flex items-center justify-between border-t border-gray-100 pt-4 mt-auto">
                            <span class="text-xs font-bold text-gray-500 uppercase tracking-wider bg-gray-50 px-3 py-1 rounded-full border border-gray-100">
                                {{ $restaurant->categorie }}
                            </span>
                            <a href="{{ route('client.restaurants.show', $restaurant->id) }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-900 group/link hover:text-brand-500 transition">
                                Voir la Carte <i class="ph-bold ph-arrow-right group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
