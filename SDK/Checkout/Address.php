<?php

namespace G2A\Checkout;

class Address
{
    private $firstName;

    private $lastName;

    private $zipCode;

    private $countryCode;

    private $county;

    private $city;

    private $line1;

    private $line2;

    private $company;

    /**
     * Address constructor.
     *
     * @param $firstName
     * @param $lastName
     * @param $zipCode
     * @param $countryCode
     * @param $county
     * @param $city
     * @param $line1
     * @param string $line2
     * @param string $company
     */
    public function __construct($firstName,
                                $lastName,
                                $zipCode,
                                $countryCode,
                                $county,
                                $city,
                                $line1,
                                $line2 = '',
                                $company = ''
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->zipCode = $zipCode;
        $this->countryCode = $countryCode;
        $this->county = $county;
        $this->city = $city;
        $this->line1 = $line1;
        $this->line2 = $line2;
        $this->company = $company;
    }

    /**
     * @return array
     */
    public function __toCart()
    {
        return [
            'firstname' => $this->firstName,
            'lastname' => $this->lastName,
            'line_1' => $this->line1,
            'line_2' => $this->line2,
            'zip_code' => $this->zipCode,
            'city' => $this->city,
            'company' => $this->company,
            'county' => $this->county,
            'country' => $this->countryCode,
        ];
    }
}
