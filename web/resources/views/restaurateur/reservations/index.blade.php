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
                {{-- Example Row --}}
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">JD</div>
                            <div>
                                <p class="font-bold text-gray-900">Jean Dupont</p>
                                <p class="text-xs text-gray-500">jean@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-6 text-gray-500">Le Petit Bistro</td>
                    <td class="p-6 text-gray-900 font-medium">
                        <div>12 Oct, 2023</div>
                        <div class="text-sm text-gray-500">19:30</div>
                    </td>
                    <td class="p-6 text-gray-500">4 pers.</td>
                    <td class="p-6">
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                            Confirmée
                        </span>
                    </td>
                    <td class="p-6 text-right space-x-2">
                        <button class="w-8 h-8 rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200 flex items-center justify-center transition" title="Détails">
                            <i class="ph-bold ph-eye"></i>
                        </button>
                        <button class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition" title="Annuler">
                            <i class="ph-bold ph-x"></i>
                        </button>
                    </td>
                </tr>
                {{-- End Example Row --}}
                
                {{-- Example Grid Row --}}
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">MA</div>
                            <div>
                                <p class="font-bold text-gray-900">Marie Albert</p>
                                <p class="text-xs text-gray-500">marie@example.com</p>
                            </div>
                        </div>
                    </td>
                    <td class="p-6 text-gray-500">Le Petit Bistro</td>
                    <td class="p-6 text-gray-900 font-medium">
                        <div>12 Oct, 2023</div>
                        <div class="text-sm text-gray-500">20:00</div>
                    </td>
                    <td class="p-6 text-gray-500">2 pers.</td>
                    <td class="p-6">
                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold border border-yellow-200">
                            En attente
                        </span>
                    </td>
                    <td class="p-6 text-right space-x-2">
                         <button class="w-8 h-8 rounded-full bg-green-50 text-green-600 hover:bg-green-100 flex items-center justify-center transition" title="Accepter">
                            <i class="ph-bold ph-check"></i>
                        </button>
                        <button class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition" title="Refuser">
                            <i class="ph-bold ph-x"></i>
                        </button>
                    </td>
                </tr>
                 {{-- End Example Grid Row --}}

            </tbody>
        </table>
    </div>
@endsection
