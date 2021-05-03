<?php

declare(strict_types=1);

namespace Ctrlc\Order\Services;

interface PaymentServiceContract
{
    public function getProviderId();
    public function createCustomer();
    public function updateCustomer();
    public function getCustomer();

    public function createPayment();
    public function updatePayment();
    public function getPayment();
}
