<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Interfaces\PaymentInterface;

class PaymentController extends Controller
{
   public function pay(Request $request,PaymentInterface $paymentService)
   {
        $request->validate([
            'reservation_id' => 'required|exists:reservation,id',
        ]);

        $reservation = Reservation::findOrfail($request->reservation_id);

        if ($reservation->status === 'confirme') {
            return back()->with('error', 'Already payed');
        }
        $amount = $reservation->nombre_personnes * 10.00;

        $paymentUrl = $paymentService->pay($amount,['reservation_id' => $reservation->id]);


        if($paymentUrl){
            return redirect($paymentUrl);
        }

        return back()->with('error', 'Error in payement');
   }

   public function success(Request $request,PaymentInterface $paymentService)
   {
     // soon :)
   }

   public function cancel()
   {
     return redirect()->route('client.restaurants.index')->with('error','paymenet cancel');
   }
}
