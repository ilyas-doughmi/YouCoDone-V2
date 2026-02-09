<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\AdminController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/restaurant/profile', function(){
        return view('restaurateur.profile.index');
    })->name('restaurant.profile');

    Route::middleware(['role:client'])->group(function () {
        Route::get('/catalogue', [App\Http\Controllers\ClientRestaurantController::class, 'index'])->name('client.restaurants.index');
        Route::get('/catalogue/{id}', [App\Http\Controllers\ClientRestaurantController::class, 'show'])->name('client.restaurants.show');
        Route::post('/catalogue/{id}/favorite', [App\Http\Controllers\ClientRestaurantController::class, 'toggleFavorite'])->name('client.restaurants.favorite');
    });
});

Route::middleware(['auth','role:restaurateur'])->group(function(){
    Route::get('/restaurant', function(){
        $userId = auth()->id();
        $total = \App\Models\restaurant::where('userId', $userId)->where('isDeleted', false)->count();
        $active = \App\Models\restaurant::where('userId', $userId)->where('isActive', true)->where('isDeleted', false)->count();
        $inactive = \App\Models\restaurant::where('userId', $userId)->where('isDeleted', false)->where('isActive', false)->count();
        $stats = [
            'total' => $total,
            'active' => $active,
            'inactive' => $inactive,
        ];
        return view('restaurateur.dashboard', compact('stats'));
    })->middleware(['auth', 'verified'])->name('restaurateur.dashboard');

    Route::resource('restaurants', App\Http\Controllers\RestaurantController::class);
    Route::post('/restaurants/{restaurant}/menus', [App\Http\Controllers\RestaurantController::class, 'storeMenu'])->name('restaurants.menus.store');
    Route::post('/menus/{menu}/plat', [App\Http\Controllers\RestaurantController::class, 'storePlat'])->name('menus.plat.store');
    Route::get('/reservations', [App\Http\Controllers\ReservationController::class, 'index'])->name('reservations.index');

});

Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/restaurants', [AdminController::class, 'index'])->name('restaurants.index');
    Route::delete('/restaurants/{restaurant}', [AdminController::class, 'destroy'])->name('restaurants.destroy');
});


require __DIR__.'/auth.php';
