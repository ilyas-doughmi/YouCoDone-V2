@extends('layouts.restaurateur')

@section('header')
    Modifier le restaurant
@endsection

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-3xl shadow-card border border-gray-100">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Informations générales</h2>

        <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2 md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom du restaurant</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $restaurant->nom) }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm" required>
                </div>

                <div class="space-y-2 md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700">Adresse complète</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $restaurant->localisation) }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm" required>
                </div>

                <div class="space-y-2">
                    <label for="cuisine" class="block text-sm font-medium text-gray-700">Type de cuisine</label>
                    <select name="cuisine" id="cuisine" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm bg-white">
                        <option value="italienne" {{ old('cuisine', $restaurant->categorie) === 'italienne' ? 'selected' : '' }}>Italienne</option>
                        <option value="francaise" {{ old('cuisine', $restaurant->categorie) === 'francaise' ? 'selected' : '' }}>Française</option>
                        <option value="japonaise" {{ old('cuisine', $restaurant->categorie) === 'japonaise' ? 'selected' : '' }}>Japonaise</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label for="capacity" class="block text-sm font-medium text-gray-700">Capacité</label>
                    <input type="number" name="capacity" id="capacity" min="1" value="{{ old('capacity', $restaurant->capacite) }}" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm" required>
                </div>
            </div>

            <div class="mt-6 space-y-2">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm">{{ old('description', $restaurant->description) }}</textarea>
            </div>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="hours" class="block text-sm font-medium text-gray-700">Horaires</label>
                    <input type="text" name="hours" id="hours" placeholder="Ex: Lun-Dim 12:00-23:00" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-500 focus:ring-1 focus:ring-brand-500 shadow-sm">
                </div>
            </div>

            <div class="mt-8">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900">Photos du restaurant</h3>
                    <span class="text-xs text-gray-400">Table photos</span>
                </div>
                <div class="mt-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div class="text-sm text-gray-600">Choisissez le nombre de photos (1 à 3 max).</div>
                    <div class="flex items-center gap-3">
                        <label for="photo_count" class="text-sm font-semibold text-gray-700">Nombre de photos</label>
                        <select id="photo_count" class="px-3 py-2 rounded-lg border border-gray-200 text-sm">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 overflow-hidden rounded-2xl border border-gray-100">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                            <tr>
                                <th class="p-4">Photo</th>
                                <th class="p-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100" id="photo_rows">
                            <tr class="photo-row">
                                <td class="p-4">
                                    <input type="file" name="photos[]" class="w-full text-sm">
                                </td>
                                <td class="p-4 text-right">
                                    <button type="button" class="text-red-500 text-sm font-semibold hover:text-red-600 remove-photo">Supprimer</button>
                                </td>
                            </tr>
                            <tr class="photo-row">
                                <td class="p-4">
                                    <input type="file" name="photos[]" class="w-full text-sm">
                                </td>
                                <td class="p-4 text-right">
                                    <button type="button" class="text-red-500 text-sm font-semibold hover:text-red-600 remove-photo">Supprimer</button>
                                </td>
                            </tr>
                            <tr class="photo-row">
                                <td class="p-4">
                                    <input type="file" name="photos[]" class="w-full text-sm">
                                </td>
                                <td class="p-4 text-right">
                                    <button type="button" class="text-red-500 text-sm font-semibold hover:text-red-600 remove-photo">Supprimer</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="mt-2 text-xs text-gray-400">Formats recommandés : JPG, PNG.</p>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('restaurants.index') }}" class="px-6 py-3 rounded-lg text-gray-700 hover:bg-gray-100 font-bold transition">Annuler</a>
                <button type="submit" class="bg-brand-500 text-white px-8 py-3 rounded-lg font-bold hover:bg-brand-600 transition shadow-lg shadow-brand-500/20">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>

    <script>
        (function () {
            const maxPhotos = 3;
            const minPhotos = 1;
            const select = document.getElementById('photo_count');
            const rows = Array.from(document.querySelectorAll('.photo-row'));

            const updateRows = (count) => {
                rows.forEach((row, index) => {
                    const isVisible = index < count;
                    row.style.display = isVisible ? '' : 'none';
                    row.querySelectorAll('input').forEach((input) => {
                        if (!isVisible) {
                            input.value = '';
                        }
                    });
                });
            };

            select.addEventListener('change', (e) => {
                const value = Math.min(maxPhotos, Math.max(minPhotos, Number(e.target.value) || minPhotos));
                updateRows(value);
            });

            document.querySelectorAll('.remove-photo').forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    const current = Number(select.value) || minPhotos;
                    if (current > minPhotos && index < current) {
                        select.value = String(current - 1);
                        updateRows(current - 1);
                    }
                });
            });

            updateRows(Number(select.value));
        })();
    </script>
@endsection
