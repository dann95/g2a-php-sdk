<?php

use PHPUnit\Framework\TestCase;
use G2A\Entities\AbstractEntity;
use G2aTests\Unit\Entities\FooEntity;
use G2A\Sdk;

class AbstractEntityTest extends TestCase
{
    private function fakeSdk()
    {
        return new Sdk(
            'hash',
            'test@example.com',
            'secret',
            'SANDBOX'
        );
    }

    /**
     * @return FooEntity
     */
    public function testJson()
    {
        $sdk = $this->fakeSdk();
        $options = ['foo' => 'bar'];
        $instance = FooEntity::populate($options, $sdk);
        $this->assertJsonStringEqualsJsonString(json_encode($options), json_encode($instance));
        return $instance;
    }

    /**
     * @depends testJson
     * @param FooEntity $instance
     */
    public function testArrayAccess(FooEntity $instance)
    {
        $this->assertEquals('bar', $instance['foo']);
    }
}