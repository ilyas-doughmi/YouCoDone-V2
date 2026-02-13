@extends('layouts.restaurateur')

@section('header')
    Mes Réservations
@endsection

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-900">Réservations à venir</h2>
        <div class="flex gap-2">
            <button class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg font-bold text-sm hover:bg-gray-200 transition">Toutes</button>
            <button class="bg-brand-50 text-brand-500 px-4 py-2 rounded-lg font-bold text-sm">Validées</button>
            <button class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg font-bold text-sm hover:bg-gray-200 transition">En attente</button>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-card overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                    <th class="p-6">Client</th>
                    <th class="p-6">Restaurant</th>
                    <th class="p-6">Date & Heure</th>
                    <th class="p-6">Couverts</th>
                    <th class="p-6">Statut</th>
                    <th class="p-6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($reservations as $reservation)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 font-bold">
                                {{ substr($reservation->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $reservation->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $reservation->user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-6 text-gray-500 font-medium">{{ $reservation->restaurant->nom }}</td>
                    <td class="p-6 text-gray-900">
                        <div class="font-semibold">{{ \Carbon\Carbon::parse($reservation->date)->format('d M, Y') }}</div>
                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($reservation->heure)->format('H:i') }}</div>
                    </td>
                    <td class="p-6 text-gray-500">{{ $reservation->nombre_personnes }} pers.</td>
                    <td class="p-6">
                        @if($reservation->status === 'confirme')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                <i class="ph-bold ph-check-circle"></i> Confirmée
                            </span>
                        @elseif($reservation->status === 'en_attente')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                                En attente
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">
                                Refusée
                            </span>
                        @endif
                    </td>
                    <td class="p-6 text-right space-x-2">
                        @if($reservation->status === 'confirme' && $reservation->transaction_id)
                            <form action="{{ route('payment.refund', $reservation->id) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment refuser cette réservation et rembourser le client ?');">
                                @csrf
                                <button type="submit" class="inline-flex items-center gap-2 bg-red-50 text-red-600 px-3 py-2 rounded-lg text-sm font-bold hover:bg-red-100 transition" title="Refuser et Rembourser">
                                    <i class="ph-bold ph-arrow-u-up-left"></i> Refuser & Rembourser
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
