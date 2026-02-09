@extends('layouts.restaurateur')

@section('header')
    Mon Profil
@endsection

@section('content')
    <div class="max-w-5xl mx-auto py-8 space-y-6">
        <div class="bg-white rounded-2xl shadow-card p-6">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Informations personnelles</h2>
                <a href="{{ route('restaurant.profile') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-500">Retour</a>
            </div>

            <form class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700" for="name">Nom complet</label>
                    <input id="name" type="text" value="{{ Auth::user()->name ?? '' }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700" for="email">Adresse email</label>
                    <input id="email" type="email" value="{{ Auth::user()->email ?? '' }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700" for="phone">Téléphone</label>
                    <input id="phone" type="tel" placeholder="+33 6 12 34 56 78" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700" for="city">Ville</label>
                    <input id="city" type="text" placeholder="Paris" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm">
                </div>

                <div class="md:col-span-2 flex justify-end gap-3">
                    <button type="button" class="px-6 py-3 rounded-lg text-gray-700 hover:bg-gray-100 font-bold transition">Annuler</button>
                    <button type="button" class="bg-brand-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-brand-600 transition shadow-lg shadow-brand-500/20">Enregistrer</button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-card p-6">
            <h2 class="text-xl font-bold text-gray-900">Sécurité</h2>

            <form class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700" for="current_password">Mot de passe actuel</label>
                    <input id="current_password" type="password" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700" for="new_password">Nouveau mot de passe</label>
                    <input id="new_password" type="password" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700" for="confirm_password">Confirmer le mot de passe</label>
                    <input id="confirm_password" type="password" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm">
                </div>

                <div class="md:col-span-2 flex justify-end">
                    <button type="button" class="bg-gray-900 text-white px-8 py-3 rounded-lg font-bold hover:bg-gray-800 transition">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
@endsection
