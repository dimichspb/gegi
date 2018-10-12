<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseString;
use Assert\AssertionFailedException;
use Codeception\Test\Unit;

class BaseStringTest extends Unit
{
    use GetMockTrait;

    /**
     *
     */
    public function testAssertSuccess()
    {
        $mock = $this->getMock(BaseString::class, $value = 'string');

        expect($mock->getValue())->equals($value);
    }

    /**
     *
     */
    public function testAssertFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseString::class, $value = 10);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseString::class, $value = 10.10);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseString::class, $value = -10);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseString::class, $value = -10.10);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseString::class, $value = true);
    }

    /**
     *
     */
    public function testToStringSuccess()
    {
        $mock = $this->getMock(BaseString::class, $value = 'string');

        expect($mock === 'string');
    }

}