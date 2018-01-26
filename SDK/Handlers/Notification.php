<?php

namespace G2A\Handlers;

class Notification extends AbstractHandler
{
    /**
     * @param array $notification
     *
     * @return bool
     */
    public function check(array $notification)
    {
        return $this->validate($notification);
    }

    /**
     * @return bool
     */
    public function checkFromGlobals()
    {
        return $this->validate($_POST);
    }

    /**
     * @param array $notification
     *
     * @return bool
     */
    private function validate(array $notification)
    {
        return isset($notification['hash'], $notification['transactionId'], $notification['userOrderId'], $notification['amount'])
            && $this->sdk->crypto()->notification($notification['transactionId'], $notification['userOrderId'], $notification['amount'], $this->sdk->credentials()->getSecret()) == $notification['hash'];
    }
}
