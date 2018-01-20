<?php

namespace G2A\Entities\Payments;

use G2A\Entities\AbstractEntity;


//{
//    "transactionId": "eac61839-7db6-4cab-8ec3-9708c4676938",
//"userOrderId": "70001010467320",
//"amount": 10.0,
//"currency": "EUR",
//"status": "complete",
//"createdAt": "2015-02-20 01:21:35",
//"refundedAmount": 0,
//"customer": {
//    "firstName": "John",
//"lastName": "Doe",
//"address1": "",
//"address2": "",
//"postcode": "",
//"city": "Berlin",
//"country": "Germany"
//},
//"items": [
//{
//    "sku": "item-124896",
//    "name": "Test Payment Item",
//    "amount": 8.0,
//    "qty": 1
//},
//{
//    "sku": "fee-091",
//    "name": "Test Fee",
//    "amount": 2.0,
//    "qty": 1
//}
//]
//}


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