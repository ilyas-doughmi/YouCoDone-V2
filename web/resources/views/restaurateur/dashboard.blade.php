@extends('layouts.restaurateur')

@section('header')
    Vue d'ensemble
@endsection

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Bonjour, {{ Auth::user()->name }} ! 👋</h2>
        <p class="text-gray-500 mt-1">Gérez vos établissements et vos réservations depuis cet espace.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-3xl shadow-card flex items-center gap-5 border border-gray-100">
            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-brand-500 flex items-center justify-center text-2xl">
                <i class="ph-fill ph-storefront"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Vos Restaurants</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $stats['total'] ?? 0 }}</h3> 
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-card flex items-center gap-5 border border-gray-100">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl">
                <i class="ph-fill ph-shield-check"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Actifs</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $stats['active'] ?? 0 }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl shadow-card flex items-center gap-5 border border-gray-100">
            <div class="w-14 h-14 rounded-2xl bg-gray-100 text-gray-600 flex items-center justify-center text-2xl">
                <i class="ph-fill ph-eye-slash"></i>
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Inactifs</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $stats['inactive'] ?? 0 }}</h3>
            </div>
        </div>
    </div>
    
@endsection