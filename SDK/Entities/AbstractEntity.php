<?php

namespace G2A\Entities;

use G2A\Sdk;
use GeneratedHydrator\Configuration;

abstract class AbstractEntity
{

    protected $sdk;

    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
    }

    /**
     * @param array $fillable
     * @param Sdk $sdk
     * @return static
     */
    public static function populate(array $fillable, Sdk $sdk)
    {
        $config = new Configuration(get_called_class());
        $hydratorClass = $config->createFactory()->getHydratorClass();
        $hydrator = new $hydratorClass;
        $instance = new static($sdk);
        return $hydrator->hydrate($fillable, $instance);
    }

    public static function populateCollection(array $items, Sdk $sdk)
    {

    }
}