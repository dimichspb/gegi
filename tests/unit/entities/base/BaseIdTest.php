<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseId;
use Assert\AssertionFailedException;
use Codeception\Test\Unit;

class BaseIdTest extends Unit
{
    use GetMockTrait;

    /**
     *
     */
    public function testAssertSuccess()
    {
        $mock = $this->getMock(BaseId::class, $value = 'id');

        expect($mock->getValue())->equals($value);
    }

    /**
     *
     */
    public function testAssertFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseId::class, $value = '00112233445566778899');

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseId::class, $value = 10);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseId::class, $value = true);
    }

    /**
     *
     */
    public function testToStringSuccess()
    {
        $mock = $this->getMock(BaseId::class, $value = 'id');

        expect($mock === 'id');
    }

}