<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Horaire;
use App\Models\restaurant;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    }
}
