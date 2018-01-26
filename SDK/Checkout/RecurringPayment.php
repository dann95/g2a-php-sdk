<?php

namespace G2A\Checkout;

class RecurringPayment
{
    const DAILY = 'daily';

    const WEEKLY = 'weekly';

    const MONTHLY = 'monthly';

    const QUARTERLY = 'quarterly';

    const SEMIANNUALLY = 'semi-annually';

    const ANNUALLY = 'annually';

    const TYPE_PRODUCT = 'product';

    const TYPE_DONATION = 'donation';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $period;

    /**
     * @var null|\DateTime|string
     */
    private $start_at;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $frequency;

    public function __construct($name,
                                $period = self::MONTHLY,
                                $type = self::TYPE_PRODUCT,
                                $start = null,
                                $frequency = 1
    ) {
        $this->name = $name;
        $this->period = $period;
        $this->type = $type;
        $this->start_at = $start;
        $this->frequency = $frequency;
    }

    public function __toCart()
    {
        return [
            'subscription' => 1,
            'subscription_product_name' => $this->name,
            'subscription_type' => $this->type,
            'subscription_period' => $this->period,
            'subscription_frequency' => $this->frequency,
            'subscription_start_date' => $this->start_at,
        ];
    }
}
