<?php


namespace G2A\Checkout;


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
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $currency;
    /**
     * @var mixed
     */
    private $orderId;

    /**
     * Cart constructor.
     * @param $successUrl
     * @param $failUrl
     */
    public function __construct($orderId, $successUrl, $failUrl, $currency = 'USD')
    {
        $this->surl = $successUrl;
        $this->furl = $failUrl;
        $this->currency = $currency;
        $this->orderId = $orderId;
    }

    /**
     * @param Item $item
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
    public function setAddress(Address $address)
    {
        $this->address = $address;
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
            'items' => $items
        ];

        return $result;
    }
}