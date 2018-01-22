<?php


namespace G2A\Crypto;


class Crypto
{
    /**
     * @param $apiHash
     * @param $merchantEmail
     * @param $apiSecret
     * @return string
     */
    public function authorizationHeader($apiHash, $merchantEmail, $apiSecret)
    {
        return hash('sha256', $apiHash.$merchantEmail.$apiSecret);
    }

    /**
     * @param $userOrderId
     * @param $amount
     * @param $currency
     * @param $ApiSecret
     * @return string
     */
    public function payment($userOrderId, $amount, $currency, $ApiSecret)
    {
        return hash('sha256', $userOrderId.number_format($amount, 2).$currency.$ApiSecret);
    }

    /**
     * @param $transactionId
     * @param $userOrderId
     * @param $amount
     * @param $apiSecret
     * @return string
     */
    public function notification($transactionId, $userOrderId, $amount, $apiSecret)
    {
        return hash('sha256', $transactionId.$userOrderId.$amount.$apiSecret);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return (new static())->$name(... $arguments);
    }

}