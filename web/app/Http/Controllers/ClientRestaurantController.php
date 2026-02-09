<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\restaurant;
use Illuminate\Support\Facades\Auth;

class ClientRestaurantController extends Controller
{
    public function index()
    {
        $restaurants = restaurant::where('isActive', true)
            ->where('isDeleted', false)
            ->latest()
            ->get();
        return view('client.restaurants.index', compact('restaurants'));
    }

    public function show(string $id)
    {
        $restaurant = restaurant::where('id', $id)
            ->where('isActive', true)
            ->where('isDeleted', false)
            ->with(['menus.plat', 'images'])
            ->firstOrFail();
            
        return view('client.restaurants.show', compact('restaurant'));
    }

    public function toggleFavorite(Request $request, string $id)
    {
        $restaurant = restaurant::findOrFail($id);
        $user = Auth::user();

        if ($user->favoris()->where('restaurantId', $id)->exists()) {
             $user->favoris()->detach($id);
             $message = 'Retiré des favoris.';
        } else {
             $user->favoris()->attach($id);
             $message = 'Ajouté aux favoris.';
        }

        return back()->with('status', $message);
    }
}
