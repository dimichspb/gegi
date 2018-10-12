<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseInteger;
use Assert\AssertionFailedException;
use Codeception\Test\Unit;

class BaseIntegerTest extends Unit
{
    use GetMockTrait;

    /**
     *
     */
    public function testAssertSuccess()
    {
        $mock = $this->getMock(BaseInteger::class, $value = 10);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseInteger::class, $value = -10);

        expect($mock->getValue())->equals($value);

    }

    /**
     *
     */
    public function testAssertFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseInteger::class, $value = 10.10);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseInteger::class, $value = -10.10);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseInteger::class, $value = true);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseInteger::class, $value = 'This is not valid integer value');
    }
}