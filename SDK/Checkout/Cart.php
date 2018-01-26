<?php

namespace G2A\Checkout;

use G2A\Exceptions\G2aException;

class Cart
{
    /**
     * @var array
     */
    private $items = [];

    /**
     * @var string
     */
    private $surl;

    /**
     * @var string
     */
    private $furl;


    private $billingAddress;

    private $shippingAddress;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var mixed
     */
    private $orderId;

    /**
     * @var RecurringPayment | null
     */
    private $subscription;

    /**
     * Cart constructor.
     *
     * @param $orderId
     * @param $successUrl
     * @param $failUrl
     * @param string                              $currency
     * @param \G2A\Checkout\RecurringPayment|null $subscription
     */
    public function __construct($orderId, $successUrl, $failUrl, $currency = 'USD', RecurringPayment $subscription = null)
    {
        $this->surl = $successUrl;
        $this->furl = $failUrl;
        $this->currency = $currency;
        $this->orderId = $orderId;
        $this->subscription = $subscription;
    }

    /**
     * @param Item $item
     *
     * @return $this
     */
    public function add(Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @param Address $address
     * @return $this
     */
    public function setShippingAddress(Address $address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

    /**
     * @param Address $address
     * @return $this
     */
    public function setBillingAddress(Address $address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    /**
     * @return array
     */
    public function __toCheckout()
    {
        $items = array_map(function ($i) {
            return $i->__toCart();
        }, $this->items);

        $result = [
            'order_id' => $this->orderId,
            'url_failure' => $this->furl,
            'url_ok' => $this->surl,
            'currency' => $this->currency,
            'amount' => array_reduce($items, function ($res, $item) {
                return $res += $item['amount'];
            }, 0),
            'items' => $items,
        ];

        if($this->billingAddress instanceof Address) {
            $result['addresses']['billing'] = $this->billingAddress->__toCart();
        }

        if($this->shippingAddress instanceof Address) {
            $result['addresses']['shipping'] = $this->shippingAddress->__toCart();
        }

        return $result;
    }

    /**
     * @return array
     *
     * @throws G2aException
     */
    public function __toRecurringCheckout()
    {
        if ($this->subscription instanceof RecurringPayment) {
            return $this->__toCheckout() + $this->subscription->__toCart();
        }

        throw new G2aException('No recurring payment was set to this cart!');
    }
}
