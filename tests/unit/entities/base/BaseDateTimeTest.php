<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseDateTime;
use Codeception\Test\Unit;

class BaseDateTimeTest extends Unit
{
    use GetMockTrait;

    /**
     *
     */
    public function testAssertSuccess()
    {
        $mock = $this->getMock(BaseDateTime::class, $value = '2018-08-14T08:20:18+00:00');

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseDateTime::class, $value = '2018-08-15T08:20:18+00:00');

        expect($mock->getValue())->equals($value);
    }
}