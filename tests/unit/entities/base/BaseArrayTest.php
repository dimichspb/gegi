<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseArray;
use Assert\AssertionFailedException;

class BaseArrayTest extends \Codeception\Test\Unit
{
    use GetMockTrait;

    public function testAssertSuccess()
    {
        $mock = $this->getMock(BaseArray::class, $value = ['value']);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseArray::class, $value = [123]);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseArray::class, $value = [0 => 'value0', 1 => 'value1']);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseArray::class, $value = ['a' => 'valueA', 'b' => 'valueB']);

        expect($mock->getValue())->equals($value);
    }

    public function testAssertFailed()
    {
        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseArray::class, $value = 'This is not a valid array value');

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseArray::class, $value = 10);

        $this->expectException(AssertionFailedException::class);

        $mock = $this->getMock(BaseArray::class, $value = true);
    }

    /**
     *
     */
    public function testNext()
    {
        $stub = new class([$key0 = 0 => $value0 = 'value0', $key1 = 1 => $value1 = 'value1']) extends BaseArray {};

        expect($stub->next())->equals($value1);

    }

    /**
     *
     */
    public function testValid()
    {
        $stub = new class([$key0 = 0 => $value0 = 'value0', $key1 = 1 => $value1 = 'value1']) extends BaseArray {};

        expect($stub->valid())->equals(true);
    }

    /**
     *
     */
    public function testKey()
    {
        $stub = new class([$key0 = 0 => $value0 = 'value0', $key1 = 1 => $value1 = 'value1']) extends BaseArray {};

        expect($stub->key())->equals($key0);
    }

    /**
     *
     */
    public function testRewind()
    {
        $stub = new class([$key0 = 0 => $value0 = 'value0', $key1 = 1 => $value1 = 'value1']) extends BaseArray {};

        $stub->next();
        $stub->rewind();

        expect($stub->current())->equals($value0);
    }

    /**
     *
     */
    public function testCurrent()
    {
        $stub = new class([$key0 = 0 => $value0 = 'value0', $key1 = 1 => $value1 = 'value1']) extends BaseArray {};

        expect($stub->current())->equals($value0);
    }
}
