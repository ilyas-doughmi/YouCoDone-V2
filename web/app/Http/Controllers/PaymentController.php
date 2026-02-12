<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Interfaces\PaymentInterface;

class PaymentController extends Controller
{
   public function pay(Request $request)
   {
        $request->validate([
            'reservation_id' => 'required|exists:reservation,id',
            'payment_method' => 'required|in:paypal,stripe',
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        if ($reservation->status === 'confirme') {
            return back()->with('error', 'Already paid');
        }

        $amount = $reservation->nombre_personnes * 10.00;

        if ($request->payment_method === 'stripe') {
            $paymentService = new \App\Services\StripeService();
        } else {
            $paymentService = new \App\Services\PayPalService();
        }

        $paymentUrl = $paymentService->pay($amount, ['reservation_id' => $reservation->id]);

        if ($paymentUrl) {
            return redirect($paymentUrl);
        }

        return back()->with('error', 'Error in payment initiation');
   }

   public function success(Request $request)
   {
        if ($request->has('session_id')) {
            $paymentService = new \App\Services\StripeService();
        } else {
            $paymentService = new \App\Services\PayPalService();
        }

        $transactionId = $paymentService->execute($request);

        if ($transactionId) {
            $reservation = Reservation::find($request->reservation_id);
            if ($reservation) {
                $reservation->update([
                    'status' => 'confirme',
                    'transaction_id' => is_string($transactionId) ? $transactionId : null
                ]);
                return redirect()->route('client.reservations.index')->with('success', 'Paiement réussi ! Votre réservation est confirmée.');
            }
        }

        return redirect()->route('client.reservations.index')->with('error', 'Le paiement a échoué ou a été annulé.');
   }

   public function cancel()
   {
     return redirect()->route('client.reservations.index')->with('error', 'Paiement annulé.');
   }

   public function refund($id)
   {
        $reservation = Reservation::findOrFail($id);

        if (!$reservation->transaction_id) {
             return back()->with('error', 'Aucune transaction trouvée pour cette réservation.');
        }

        $transactionId = $reservation->transaction_id;
        $isStripe = str_starts_with($transactionId, 'pi_') || str_starts_with($transactionId, 'ch_');
        
        if ($isStripe) {
            $paymentService = new \App\Services\StripeService();
        } else {
            $paymentService = new \App\Services\PayPalService();
        }

        if ($paymentService->refund($transactionId)) {
            $reservation->update(['status' => 'refuse']);
            return back()->with('success', 'Réservation refusée et remboursement effectué avec succès.');
        }

        return back()->with('error', 'Échec du remboursement.');
   }


}
