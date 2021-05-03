<?php declare(strict_types=1);

namespace Ctrlc\Order\Services;

class StripePayment implements PaymentServiceContract
{

    public function createCustomer()
    {
        // TODO: Implement createCustomer() method.
    }

    public function updateCustomer()
    {
        // TODO: Implement updateCustomer() method.
    }

    public function getCustomer()
    {
        // TODO: Implement getCustomer() method.
    }

    public function createPayment()
    {
        // TODO: Implement createPayment() method.
    }

    public function updatePayment()
    {
        // TODO: Implement updatePayment() method.
    }

    public function getPayment()
    {
        // TODO: Implement getPayment() method.
    }

    public function getProviderId()
    {
        return 'stripe';
    }
}
