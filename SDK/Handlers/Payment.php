<?php

namespace G2A\Handlers;

use G2A\Checkout\Cart;
use G2A\Transformers\RefundTransformer;
use GuzzleHttp\Psr7\Request;
use G2A\Entities\Payments\Checkout;
use G2A\Transformers\PaymentTransformer;
use G2A\Transformers\CheckoutTransformer;

class Payment extends AbstractHandler
{
    /**
     * @param $id
     *
     * @return \G2A\Entities\AbstractEntity
     */
    public function find($id)
    {
        $request = new Request('get', $this->sdk->endpoints()->rest()."transactions/{$id}");
        $transformer = new PaymentTransformer(['id' => $id]);

        return $this->handleApiRequest($request, $transformer);
    }

    /**
     * @param Cart $cart
     *
     * @return Checkout
     */
    public function create(Cart $cart)
    {
        $sdk = $this->sdk;

        $o = $cart->__toCheckout();
        $o['api_hash'] = $sdk->credentials()->getHash();
        $o['hash'] = $sdk->crypto()->payment($o['order_id'], $o['amount'], $o['currency'], $sdk->credentials()->getSecret());

        $request = new Request('post',
            $this->sdk->endpoints()->quote().'createQuote',
            ['Content-Type' => 'application/x-www-form-urlencoded'],
            http_build_query($o)
        );

        return $this->handleApiRequest($request, (new CheckoutTransformer()));
    }

    /**
     * @param \G2A\Entities\Payments\Payment $payment
     * @param null                           $amount
     *
     * @return \G2A\Entities\AbstractEntity
     */
    public function refund(\G2A\Entities\Payments\Payment $payment, $amount = null)
    {
        $sdk = $this->sdk;
        $o = [
            'action' => 'refund',
            'amount' => $amount ?: $payment->getAmount(),
        ];
        $o['hash'] = $sdk->crypto()->refund($payment->getTransactionId(), $payment->getUserOrderId(), $payment->getAmount(), $o['amount'], $sdk->credentials()->getSecret());

        $request = new Request('put',
            $this->sdk->endpoints()->rest().'transactions/'.$payment->getTransactionId(),
            ['Content-Type' => 'application/x-www-form-urlencoded'],
            http_build_query($o)
        );

        return $this->handleApiRequest($request, (new RefundTransformer()));
    }
}
