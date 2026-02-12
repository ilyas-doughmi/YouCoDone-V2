<?php
namespace App\Services;

use App\Interfaces\PaymentInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;

class PayPalService implements PaymentInterface
{
    protected $provider;

    public function __construct()
    {
        $this->provider = new PayPalClient();
        $this->provider->setApiCredentials(Config('paypal'));
    }
}