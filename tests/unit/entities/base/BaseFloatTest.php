<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseFloat;
use Assert\AssertionFailedException;
use Codeception\Test\Unit;

class BaseFloatTest extends Unit
{
    use GetMockTrait;
    /**
     *
     */
    public function testAssertSuccess()
    {
        $mock = $this->getMock(BaseFloat::class, $value = 10.10);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseFloat::class, $value = 10.00);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseFloat::class, $value = 10);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseFloat::class, $value = -10.10);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseFloat::class, $value = -10.00);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseFloat::class, $value = -10);

        expect($mock->getValue())->equals($value);
    }

    /**
     *
     */
    public function testAssertFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseFloat::class, 'This is not a valid float value');
    }
}