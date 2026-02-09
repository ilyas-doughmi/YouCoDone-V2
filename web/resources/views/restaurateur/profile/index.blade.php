@extends('layouts.restaurateur')

@section('header')
    Profile
@endsection

@section('content')

@auth
@php($user = Auth::user())

<div class="py-8">
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-1">
            <div class="bg-white rounded-2xl shadow-card p-6">
                <div class="flex items-center gap-4">
                    <img
                        src="https://ui-avatars.com/api/?name={{ $user->name }}&background=FF4F18&color=fff"
                        class="w-16 h-16 rounded-2xl border-2 border-white shadow"
                        alt="Avatar"
                    >
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        <div class="mt-2 inline-flex items-center gap-2 text-xs font-semibold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">
                            <i class="ph ph-check-circle"></i>
                            Compte vérifié
                        </div>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <i class="ph ph-buildings text-brand-500"></i>
                        <span>Restaurateur</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <i class="ph ph-calendar text-brand-500"></i>
                        <span>Inscrit le {{ $user->created_at?->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <i class="ph ph-map-pin text-brand-500"></i>
                        <span>Ville non renseignée</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <a href="{{ route('restaurants.index') }}" class="flex items-center justify-center gap-2 rounded-xl bg-brand-500 text-white px-4 py-2 text-sm font-semibold hover:bg-brand-600 transition">
                        <i class="ph ph-fork-knife"></i>
                        Mes restaurants
                    </a>
                    <a href="{{ route('reservations.index') }}" class="flex items-center justify-center gap-2 rounded-xl bg-gray-100 text-gray-700 px-4 py-2 text-sm font-semibold hover:bg-gray-200 transition">
                        <i class="ph ph-calendar-check"></i>
                        Réservations
                    </a>
                </div>
            </div>
        </div>

        <div class="xl:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-card p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Informations personnelles</h3>
                    <a href="{{ url('/restaurateur/profile/edit') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-500">Modifier</a>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Nom complet</p>
                        <p class="mt-2 text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Adresse email</p>
                        <p class="mt-2 text-sm font-semibold text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Téléphone</p>
                        <p class="mt-2 text-sm font-semibold text-gray-500">Non renseigné</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400">Adresse</p>
                        <p class="mt-2 text-sm font-semibold text-gray-500">Non renseignée</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-card p-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Sécurité du compte</h3>
                    <a href="{{ url('/restaurateur/profile/edit') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-500">Gérer</a>
                </div>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                            <i class="ph ph-shield-check"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Mot de passe</p>
                            <p class="text-sm text-gray-500">Dernière mise à jour récente</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                            <i class="ph ph-bell"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Notifications</p>
                            <p class="text-sm text-gray-500">Activées par défaut</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-card p-6">
                <h3 class="text-lg font-bold text-gray-900">Actions rapides</h3>
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('restaurants.create') }}" class="group rounded-2xl border border-gray-100 p-4 hover:border-brand-500 hover:shadow-card transition">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                            <i class="ph ph-plus-circle"></i>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-gray-900">Ajouter un restaurant</p>
                        <p class="text-xs text-gray-500">Créez une nouvelle fiche</p>
                    </a>
                    <a href="{{ route('reservations.index') }}" class="group rounded-2xl border border-gray-100 p-4 hover:border-brand-500 hover:shadow-card transition">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                            <i class="ph ph-calendar-check"></i>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-gray-900">Voir les réservations</p>
                        <p class="text-xs text-gray-500">Suivez vos demandes</p>
                    </a>
                    <a href="{{ route('restaurateur.dashboard') }}" class="group rounded-2xl border border-gray-100 p-4 hover:border-brand-500 hover:shadow-card transition">
                        <div class="w-10 h-10 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                            <i class="ph ph-chart-line-up"></i>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-gray-900">Accéder au dashboard</p>
                        <p class="text-xs text-gray-500">Vue d’ensemble rapide</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth

@endsection

