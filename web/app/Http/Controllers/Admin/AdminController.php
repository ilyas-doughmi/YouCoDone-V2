<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\restaurant;

class AdminController extends Controller
{
    public function index()
    {
        $restaurants = self::getAllRestaurants();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function destroy(restaurant $restaurant)
    {
        $restaurant->isDeleted = true;
        $restaurant->isActive = false;
        $restaurant->save();

        return redirect()
            ->route('admin.restaurants.index')
            ->with('status', 'Restaurant deleted successfully.');
    }

    protected static function getAllRestaurants()
    {
        return restaurant::where('isDeleted', false)
            ->with('user')
            ->orderByDesc('id')
            ->get();
    }
}
