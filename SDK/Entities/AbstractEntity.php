<?php

namespace G2A\Entities;

use G2A\Sdk;
use GeneratedHydrator\Configuration;
use G2A\Entities\Collections\EntityCollection;

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

    /**
     * @param array $items
     * @param Sdk $sdk
     * @return EntityCollection
     */
    public static function populateCollection(array $items, Sdk $sdk)
    {
        $populated = array_map(function ($item) use($sdk) {
            return self::populate($item, $sdk);
        }, $items);
        return new EntityCollection($populated);
    }
}