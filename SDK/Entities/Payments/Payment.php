<?php

namespace G2A\Entities\Payments;

use G2A\Entities\AbstractEntity;


class Payment extends AbstractEntity
{

    private $transactionId;
    private $userOrderId;
    private $amount;
    private $currency;
    private $status;
    private $createdAt;
    private $refundedAmount;
    private $customer;
    private $items;

    public function refund($amount)
    {
        return $this->sdk
            ->payments()
            ->refund($this, $amount);
    }
}