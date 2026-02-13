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
    <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-900 mb-6">Dernières Notifications</h3>
        
        @if($notifications->isEmpty())
            <div class="bg-white p-6 rounded-3xl shadow-card border border-gray-100 text-center">
                <p class="text-gray-500">Aucune nouvelle notification pour le moment.</p>
            </div>
        @else
            <div class="bg-white rounded-3xl shadow-card border border-gray-100 overflow-hidden">
                <div class="divide-y divide-gray-100">
                    @foreach($notifications as $notification)
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex justify-between items-start">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-500 flex items-center justify-center flex-shrink-0">
                                        <i class="ph-fill ph-bell-ringing"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $notification->data['message'] ?? 'Nouvelle notification' }}</h4>
                                        <p class="text-gray-500 text-sm mt-1">
                                            Client: <span class="font-medium text-gray-700">{{ $notification->data['client_name'] ?? 'Client' }}</span> • 
                                            Date: {{ $notification->data['date'] ?? '' }} à {{ $notification->data['heure'] ?? '' }} • 
                                            Personnes: {{ $notification->data['personnes'] ?? '' }}
                                        </p>
                                    </div>
                                </div>
                                <span class="text-xs font-medium text-gray-400 whitespace-nowrap">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    
@endsection