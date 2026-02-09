<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('restaurateur.reservations.index');
    }

    public function store(StoreReservationRequest $request)
    {
        // soon :)
    }
}
