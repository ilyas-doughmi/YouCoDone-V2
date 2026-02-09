@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Favorites Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Mes Restaurants Favoris') }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Retrouvez ici tous les restaurants que vous aimez.') }}
                        </p>
                    </header>
                    
                    <div class="mt-6">
                        @if($user->favoris->isEmpty())
                            <p class="text-gray-500 italic">{{ __('Vous n\'avez pas encore de favoris.') }} <a href="{{ route('client.restaurants.index') }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Explorer le catalogue</a></p>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($user->favoris as $restaurant)
                                    <div class="border border-gray-200 rounded-xl p-4 flex gap-4 items-start hover:shadow-md transition bg-gray-50">
                                        <div class="w-20 h-20 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                             @if($restaurant->image)
                                                <img src="{{ asset('storage/' . $restaurant->image) }}" class="w-full h-full object-cover">
                                             @else
                                                <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400&q=80" class="w-full h-full object-cover">
                                             @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-bold text-gray-900 truncate text-lg">{{ $restaurant->nom }}</h3>
                                            <p class="text-sm text-gray-500 truncate mb-2">{{ $restaurant->categorie }}</p>
                                            <a href="{{ route('client.restaurants.show', $restaurant->id) }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-800">
                                                Voir la carte &rarr;
                                            </a>
                                        </div>
                                        <form action="{{ route('client.restaurants.favorite', $restaurant->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-red-500 hover:text-red-700 p-2 bg-white rounded-full shadow-sm hover:shadow">
                                               <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                                  <path d="m11.645 20.91-.007-.003-.022-.012a15.247 15.247 0 0 1-.383-.218 25.18 25.18 0 0 1-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0 1 12 5.052 5.5 5.5 0 0 1 16.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 0 1-4.244 3.17 15.247 15.247 0 0 1-.383.219l-.022.012-.007.004-.003.001a.752.752 0 0 1-.704 0l-.003-.001Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
