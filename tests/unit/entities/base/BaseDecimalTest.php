<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseDecimal;
use Assert\AssertionFailedException;
use Codeception\Test\Unit;

class BaseDecimalTest extends Unit
{
    use GetMockTrait;
    /**
     *
     */
    public function testAssertSuccess()
    {
        $mock = $this->getMock(BaseDecimal::class, $value = 10.00);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseDecimal::class, $value = 10);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseDecimal::class, $value = -10);

        expect($mock->getValue())->equals($value);
    }

    /**
     *
     */
    public function testAssertFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseDecimal::class, 'This is not valid decimal value');
    }
}