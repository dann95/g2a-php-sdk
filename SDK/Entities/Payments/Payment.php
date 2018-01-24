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

    /**
     * @return mixed
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @return mixed
     */
    public function getUserOrderId()
    {
        return $this->userOrderId;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getRefundedAmount()
    {
        return $this->refundedAmount;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }
}
