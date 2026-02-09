<?php

namespace App;

use App\Models\restaurant;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $restaurants = self::getAllRestaurants();
        $stats = self::getStats();
        return view('admin.restaurants.index', compact('restaurants', 'stats'));
    }

    public function destroy(restaurant $restaurant)
    {
        $restaurant->isDeleted = true;
        $restaurant->isActive = false;
        $restaurant->save();

        return redirect()->route('admin.restaurants.index')->with('status', 'Restaurant deleted successfully.');
    }

    public static function getAllRestaurants()
    {
        return restaurant::where('isDeleted', false)
            ->with('user')
            ->orderByDesc('id')
            ->get();
    }

    public static function getStats()
    {
        return [
            'active' => restaurant::where('isDeleted', false)->where('isActive', true)->count(),
        ];
    }
}
