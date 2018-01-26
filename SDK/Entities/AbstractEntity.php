<?php

namespace G2A\Entities;

use G2A\Sdk;
use JsonSerializable;
use ArrayAccess;
use GeneratedHydrator\Configuration;

abstract class AbstractEntity implements ArrayAccess, JsonSerializable
{
    /**
     * @var Sdk
     */
    protected $sdk;

    /**
     * AbstractEntity constructor.
     *
     * @param Sdk $sdk
     */
    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        // immutable
    }

    public function offsetUnset($offset)
    {
        // imutable
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return array_diff_key(get_object_vars($this), array_flip(['sdk']));
    }

    /**
     * @param array $fillable
     * @param Sdk   $sdk
     *
     * @return static
     */
    public static function populate(array $fillable, Sdk $sdk)
    {
        $config = new Configuration(get_called_class());
        $hydratorClass = $config->createFactory()->getHydratorClass();
        $hydrator = new $hydratorClass();
        $instance = new static($sdk);

        return $hydrator->hydrate($fillable, $instance);
    }
}
