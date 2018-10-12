<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseFilename;
use Assert\AssertionFailedException;

class BaseFilenameTest extends \Codeception\Test\Unit
{
    use GetMockTrait;

    /**
     *
     */
    public function testAssertSuccess()
    {
        $mock = $this->getMock(BaseFilename::class, $value = 'filename.vld');

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseFilename::class, $value = '123456789.txt');

        expect($mock->getValue())->equals($value);
    }

    /**
     *
     */
    public function testAssertFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseFilename::class, $value = 'This is not a valid filename');

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseFilename::class, $value = 10);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseFilename::class, $value = true);
    }
}
