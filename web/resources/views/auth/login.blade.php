@extends('layouts.guest')

@section('content')
    <div class="flex min-h-screen w-full">

        <div class="hidden lg:flex w-1/2 bg-gray-900 relative items-center justify-center overflow-hidden">
            <img src="https://plus.unsplash.com/premium_photo-1723120606335-b0ed14dd561a?q=80&w=1074&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60">
            <div class="relative z-10 p-12 text-white max-w-lg">
                <div class="mb-6 w-12 h-12 bg-brand-500 rounded-xl flex items-center justify-center rotate-3">
                    <i class="ph-bold ph-fork-knife text-2xl"></i>
                </div>
                <h2 class="text-4xl font-bold mb-4">Bon retour parmi nous.</h2>
                <p class="text-gray-300 text-lg">Connectez-vous pour gérer vos réservations ou découvrir de nouvelles saveurs.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 bg-white">
            
            <div class="w-full max-w-md">
                <div class="text-center mb-10">
                    <a href="/" class="inline-flex items-center gap-2 mb-2">
                        <span class="text-2xl font-bold tracking-tight text-gray-900">YouCo'<span class="text-brand-500">Done</span>.</span>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900 mt-4">Connexion</h1>
                    <p class="text-sm text-gray-500 mt-2">Pas encore de compte ? <a href="{{ route('register') }}" class="font-semibold text-brand-500 hover:text-brand-600 transition">Inscrivez-vous</a></p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block font-medium text-sm text-gray-700 font-semibold">{{ __('Email') }}</label>
                        <input id="email" class="block mt-2 w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-brand-500 focus:ring-brand-500 transition-all duration-200" 
                                      type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="exemple@email.com" />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block font-medium text-sm text-gray-700 font-semibold">{{ __('Mot de passe') }}</label>

                        <input id="password" class="block mt-2 w-full px-4 py-3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-brand-500 focus:ring-brand-500 transition-all duration-200"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" placeholder="••••••••" />

                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-brand-500 shadow-sm focus:ring-brand-500 w-4 h-4" name="remember">
                            <span class="ms-2 text-sm text-gray-500">{{ __('Se souvenir de moi') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-brand-500 hover:text-brand-600 transition" href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        @endif
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-full shadow-sm text-sm font-bold text-white bg-brand-500 hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all duration-300 shadow-lg shadow-brand-500/30 transform hover:-translate-y-0.5">
                            {{ __('Se connecter') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection