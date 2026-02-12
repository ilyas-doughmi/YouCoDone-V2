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

    public function pay(float $amount, array $data)
    {
        try{
            $this->provider->getAccessToken();
            $response = $this->provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('payment.success', ['reservation_id' => $data['reservation_id']]),
                    "cancel_url" => route('payment.cancel'),
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => config('paypal.currency','EUR'),
                            "value" => number_format($amount, 2, '.', '')
                        ],
                        "custom_id" => $data['reservation_id'] ?? null
                    ]
                ]
            ]);

            if(isset($response['id']) && $response['status'] == 'CREATED') {
                foreach($response['links'] as $link) {
                    if($link['rel'] === 'approve'){
                        return $link['href'];    
                    }
                }
            }

            Log::error('error in creating payment', $response);
            return null;
            
        }catch(\Exception $e){
            Log::error('error in payment: ' . $e->getMessage());
            return null;
        }
    }

    public function execute($request)
     {
        try{

        $this->provider->getAccessToken();
        $token = $request->input('token');
        $response = $this->provider->capturePaymentOrder($token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return $response['purchase_units'][0]['payments']['captures'][0]['id'] ?? true;
        }
        
        Log::error('problem getting paypal:',$response);
        return false;
        
        }catch(\Exception $e){
            Log::error('problem in exceptions' . $e->getMessage());
            return false;
        }
     }

   public function refund(string $transactionId)
   {
        try {
           $response =  $this->provider->refundCapturedPayment(
                $transactionId,
                $transactionId . '-' . time(),
                number_format(0,2),
                'refund'
            );

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                return true;
            }

            Log::error('problem in refund', $response);
            return false;

        }catch(\Exception $e){
            Log::error('Exception Refund PayPal: ' . $e->getMessage());
            return false;
        }
   }
}