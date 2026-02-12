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
        
   }
}
