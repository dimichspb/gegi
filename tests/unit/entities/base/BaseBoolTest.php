<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseBool;
use Assert\AssertionFailedException;
use Codeception\Test\Unit;

class BaseBoolTest extends Unit
{
    use GetMockTrait;

    /**
     *
     */
    public function testAssertSuccess()
    {
        $mock = $this->getMock(BaseBool::class, $value = true);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseBool::class, $value = false);

        expect($mock->getValue())->equals($value);
    }

    /**
     *
     */
    public function testAssertFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseBool::class, $value = 'This is not a boolean value');
    }
}