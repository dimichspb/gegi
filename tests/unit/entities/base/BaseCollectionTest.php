<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseCollection;
use Assert\AssertionFailedException;
use Codeception\Test\Unit;

class BaseCollectionTest extends Unit
{
        /**
     *
     */
    public function testAssertSuccess()
    {
        $stub = new class($value = [new \stdClass(), new \stdClass()]) extends BaseCollection {
            protected function getClass()
            {
                return \stdClass::class;
            }

        };

        expect($stub->getValue())->equals($value);
    }

    /**
     *
     */
    public function testAssertNotObjectsFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $stub = new class($value = ['value1', 'value2']) extends BaseCollection
        {
            protected function getClass()
            {
                return \stdClass::class;
            }

        };
    }

    /**
     *
     */
    public function testAssertWrongClassFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $stub = new class($value = [new \stdClass(), new \stdClass()]) extends BaseCollection
        {
            protected function getClass()
            {
                return BaseCollection::class;
            }
        };
    }

    /**
     *
     */
    public function testAssertOneIsNotObjectFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $stub = new class($value = [new \stdClass(), 'value1']) extends BaseCollection {
            protected function getClass()
            {
                return \stdClass::class;
            }
        };
    }

    /**
     *
     */
    public function testAssertOneIsWrongClassFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $wrongClass = new class() {};

        $stub = new class($value = [new \stdClass(), $wrongClass]) extends BaseCollection {
            protected function getClass()
            {
                return \stdClass::class;
            }
        };
    }
}