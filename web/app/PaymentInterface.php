<?php

namespace App;

interface PaymentInterface
{
    public function pay(float $amount, array $data);

    public function execute($request);
}
