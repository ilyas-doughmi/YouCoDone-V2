<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Horaire;
use App\Models\Reservation;
use App\Models\restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ReservationController extends Controller
{
    public function index()
    {
        return view('restaurateur.reservations.index');
    }

    public function store(StoreReservationRequest $request)
    {
        $data = $request->validated();
        $restaurant = restaurant::findOrFail($data['restaurant_id']);
        $date = Carbon::parse($data['date']);
        $jourActual = $date->format('l');

        $horaire = Horaire::where('restaurantId', $restaurant->id)
                            ->where('jour', $jourActual)
                            ->first();

        if(!$horaire || $horaire->status == 'fermé') {
            return back()->withErrors(['date' => "restaurant is closed $jourActual "])->withInput();
        }

        if($data['heure'] < $horaire->heure_ouverture || $data['heure'] > $horaire->heure_ouverture)
        {
            return back()->withErrors(['heure' => "reservation time need to be from {$horaire->heure_ouverture} à {$horaire->heure_fermeture}"]);
        } 

        $reservationsExistantes = Reservation::where('restaurant_id', $restaurant->id)
            ->where('date', $data['date'])
            ->where('heure', $data['heure'])
            ->sum('nombre_personnes');

        if (($reservationsExistantes + $data['nombre_personnes']) > $restaurant->capacite) {
             return back()->withErrors(['nombre_personnes' => "no place"])->withInput();
        }


        Reservation::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $data['restaurant_id'],
            'date' => $data['date'],
            'heure' => $data['heure'],
            'nombre_personnes' => $data['nombre_personnes'],
            'status' => 'en_attente'
        ]);

        return redirect()->route('client.restaurants.show', $restaurant->id)
            ->with('success', 'reservation done');

    }
}
