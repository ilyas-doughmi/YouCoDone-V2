@extends('layouts.client')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8 flex items-center gap-3">
        <i class="ph-duotone ph-ticket text-brand-500"></i>
        Mes Réservations
    </h1>

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if($reservations->isEmpty())
            <div class="text-center py-20">
                <i class="ph-duotone ph-calendar-slash text-6xl text-gray-300 mb-4 inline-block"></i>
                <h3 class="text-lg font-medium text-gray-900">Aucune réservation</h3>
                <p class="text-gray-500">Vous n'avez pas encore réservé de table.</p>
                <a href="{{ route('client.restaurants.index') }}" class="mt-4 inline-flex items-center text-brand-600 hover:text-brand-700 font-bold">
                    Découvrir les restaurants &rarr;
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase tracking-wider text-gray-500">
                            <th class="p-6 font-semibold">Restaurant</th>
                            <th class="p-6 font-semibold">Date & Heure</th>
                            <th class="p-6 font-semibold">Invités</th>
                            <th class="p-6 font-semibold">Statut</th>
                            <th class="p-6 font-semibold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($reservations as $reservation)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="p-6">
                                <div class="font-bold text-gray-900">{{ $reservation->restaurant->nom }}</div>
                            </td>
                            <td class="p-6">
                                <div class="text-gray-700">
                                    <i class="ph-bold ph-calendar-blank text-brand-500 mr-1"></i>
                                    {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                                </div>
                                <div class="text-sm text-gray-500 mt-1">
                                    <i class="ph-bold ph-clock text-gray-400 mr-1"></i>
                                    {{ \Carbon\Carbon::parse($reservation->heure)->format('H:i') }}
                                </div>
                            </td>
                            <td class="p-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $reservation->nombre_personnes }} pers.
                                </span>
                            </td>
                            <td class="p-6">
                                @if($reservation->status === 'en_attente')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">
                                        <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                                        En attente de paiement
                                    </span>
                                @elseif($reservation->status === 'confirme')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                        <i class="ph-bold ph-check-circle"></i> Confirmée
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">
                                        Refusée
                                    </span>
                                @endif
                            </td>
                            <td class="p-6 text-right">
                                @if($reservation->status === 'en_attente')
                                    <form action="{{ route('payment.pay') }}" method="POST" class="flex flex-col gap-2">
                                        @csrf
                                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                        
                                        <button type="submit" name="payment_method" value="paypal" class="inline-flex items-center justify-center gap-2 bg-[#0070BA] hover:bg-[#003087] text-white px-5 py-2.5 rounded-xl font-bold transition shadow-lg shadow-blue-500/20 transform hover:-translate-y-0.5 w-full">
                                            <i class="ph-fill ph-paypal-logo text-lg"></i>
                                            PayPal
                                        </button>

                                        <button type="submit" name="payment_method" value="stripe" class="inline-flex items-center justify-center gap-2 bg-[#635BFF] hover:bg-[#4B45C6] text-white px-5 py-2.5 rounded-xl font-bold transition shadow-lg shadow-indigo-500/20 transform hover:-translate-y-0.5 w-full">
                                            <i class="ph-bold ph-credit-card text-lg"></i>
                                            Stripe
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm italic">Aucune action</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
