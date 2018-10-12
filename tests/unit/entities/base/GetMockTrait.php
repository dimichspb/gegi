<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseEntity;
use Codeception\Test\Unit;

trait GetMockTrait
{
    /**
     * @param $class
     * @param $value
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    protected function getMock($class, $value)
    {
        /** @var Unit $this */
        $mock = $this
            ->getMockBuilder($class)
            ->setConstructorArgs(['value' => $value])
            ->getMockForAbstractClass();

        return $mock;
    }
}