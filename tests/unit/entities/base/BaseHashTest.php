<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseHash;
use Assert\AssertionFailedException;
use Codeception\Test\Unit;

class BaseHashTest extends Unit
{
    use GetMockTrait;

    /**
     *
     */
    public function testAssertSuccess()
    {
        $mock = $this->getMock(BaseHash::class, $value = 'hash');

        expect($mock->getValue())->equals($value);
    }

    /**
     *
     */
    public function testAssertFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseHash::class, $value = 'This hash is more than 36 symbols length');

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseHash::class, $value = 10);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseHash::class, $value = true);
    }

    /**
     *
     */
    public function testToStringSuccess()
    {
        $mock = $this->getMock(BaseHash::class, $value = 'hash');

        expect($mock === 'hash');
    }

}