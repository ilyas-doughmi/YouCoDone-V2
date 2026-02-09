<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = restaurant::where('userId', Auth::id())
            ->where('isDeleted', false)
            ->latest()
            ->get();
        return view('restaurateur.restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('restaurateur.restaurants.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'cuisine' => 'required',
            'capacity' => 'required|integer|min:1',
            'description' => 'required',
            'photos' => 'nullable|array|max:3',
            'photos.*' => 'image|mimes:jpeg,jpg,png|max:4096',
        ]);
        $firstImagePath = null;

        $restaurant = restaurant::create([
            'nom' => $request->name,
            'description' => $request->description,
            'userId' => Auth::user()->id,
            'categorie' => $request->cuisine,
            'localisation' => $request->address,
            'capacite' => $request->capacity,
            'isActive' => true,
            'isDeleted' => false,
            'image' => '', 
        ]);

        if ($request->hasFile('photos')) {
            $files = $request->file('photos');
            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('restaurants', 'public');
                    if ($path) {
                        $restaurant->images()->create(['url' => $path]);
                        if ($firstImagePath === null) {
                            $firstImagePath = $path;
                        }
                    }
                }
            }
        }

        if ($firstImagePath) {
            $restaurant->update(['image' => $firstImagePath]);
        }
        return redirect()->route('restaurants.index');
    }


    public function show(string $id)
    {
        $restaurant = restaurant::where('id', $id)
            ->where('userId', Auth::id())
            ->where('isDeleted', false)
            ->with(['menus.plat'])
            ->firstOrFail();
        return view('restaurateur.restaurants.show', compact('restaurant'));
    }

    public function storeMenu(Request $request, string $restaurantId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $restaurant = restaurant::where('id', $restaurantId)
            ->where('userId', Auth::id())
            ->where('isDeleted', false)
            ->firstOrFail();

        $restaurant->menus()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('restaurants.show', $restaurant->id)
            ->with('status', 'Menu ajouté.');
    }

    public function storePlat(Request $request, string $menuId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:4096',
        ]);

        $menu = \App\Models\menu::where('id', $menuId)
            ->whereHas('restaurant', function($q){
                $q->where('userId', Auth::id())->where('isDeleted', false);
            })
            ->firstOrFail();

        $plat = $menu->plat()->create([
            'name' => $request->name,
            'description' => $request->description,
            'prix' => $request->prix,
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            if ($file && $file->isValid()) {
                $path = $file->store('plats', 'public');
                if ($path) {
                    $plat->images()->create(['url' => $path]);
                }
            }
        }

        return redirect()->route('restaurants.show', $menu->restaurantId)
            ->with('status', 'Plat ajouté.');
    }


    public function edit(string $id)
    {
        $restaurant = restaurant::where('id', $id)
            ->where('userId', Auth::id())
            ->where('isDeleted', false)
            ->firstOrFail();
        return view('restaurateur.restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'cuisine' => 'required',
            'capacity' => 'required|integer|min:1',
            'description' => 'required',
            'photos' => 'nullable|array|max:3',
            'photos.*' => 'image|mimes:jpeg,jpg,png|max:4096',
        ]);

        $restaurant = restaurant::where('id', $id)
            ->where('userId', Auth::id())
            ->where('isDeleted', false)
            ->firstOrFail();

        $restaurant->update([
            'nom' => $request->name,
            'description' => $request->description,
            'categorie' => $request->cuisine,
            'localisation' => $request->address,
            'capacite' => $request->capacity,
            'isActive' => $request->boolean('isActive', $restaurant->isActive),
        ]);

        $firstImagePath = null;
        if ($request->hasFile('photos')) {
            $files = $request->file('photos');
            foreach ($files as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('restaurants', 'public');
                    if ($path) {
                        $restaurant->images()->create(['url' => $path]);
                        if ($firstImagePath === null) {
                            $firstImagePath = $path;
                        }
                    }
                }
            }
        }

        if ($firstImagePath) {
            $restaurant->update(['image' => $firstImagePath]);
        }

        return redirect()->route('restaurants.index')->with('status', 'Restaurant mis à jour.');
    }

    public function destroy(string $id)
    {
        $restaurant = restaurant::where('id', $id)
            ->where('userId', Auth::id())
            ->where('isDeleted', false)
            ->firstOrFail();

        $restaurant->update([
            'isDeleted' => true,
            'isActive' => false,
        ]);

        return redirect()->route('restaurants.index')->with('status', 'Restaurant supprimé.');
    }
}
