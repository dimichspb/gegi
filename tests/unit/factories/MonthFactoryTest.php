<?php
/**
 * Created by PhpStorm.
 * User: dtaranti
 * Date: 12.10.2018
 * Time: 14:33
 */

use app\factories\MonthFactory;
use app\models\month\Id;
use app\models\month\Month;
use app\repositories\month\RepositoryInterface;

class MonthFactoryTest extends \Codeception\Test\Unit
{
    public function testGetDefaults()
    {
        $factory = new MonthFactory($this->getRepositoryMock('0'));

        expect(is_array($factory->getDefaults()));
    }

    public function testCreateByName()
    {
        $factory = new MonthFactory($this->getRepositoryMock($id = '0'));

        $month = $factory->createByName($name = 'january');

        expect($month)->isInstanceOf(Month::class);
        expect(strtolower($month->getName()->getValue()))->equals(strtolower($name));
        expect($month->getIndex()->getValue())->equals(1);
        expect($month->getId()->getValue())->equals($id);
    }

    public function testCreate()
    {
        $factory = new MonthFactory($this->getRepositoryMock($id = '0'));

        $month = $factory->create($name = 'january', $index = 1);

        expect($month)->isInstanceOf(Month::class);
        expect(strtolower($month->getName()->getValue()))->equals(strtolower($name));
        expect($month->getIndex()->getValue())->equals($index);
        expect($month->getId()->getValue())->equals($id);
    }

    /**
     * @param $nextIdValue
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    protected function getRepositoryMock($nextIdValue)
    {
        $mock = $this->getMockBuilder(RepositoryInterface::class)->getMock();
        $mock->method('nextId')->willReturn($this->getIdMock($nextIdValue));

        return $mock;
    }

    /**
     * @param $value
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    protected function getIdMock($value)
    {
        $mock = $this->getMockBuilder(Id::class)->getMock();
        $mock->method('getValue')->willReturn($value);

        return $mock;
    }
}
