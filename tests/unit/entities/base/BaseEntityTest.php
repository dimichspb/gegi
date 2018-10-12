<?php
namespace app\tests\unit\entities\base;

use app\entities\base\BaseEntity;
use Codeception\Test\Unit;

class BaseEntityTest extends Unit
{
    use GetMockTrait;
    /**
     *
     */
    public function testGetValueSuccess()
    {
        $mock = $this->getMock(BaseEntity::class, $value = true);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseEntity::class, $value = 10);

        expect($mock->getValue())->equals($value);

        $mock = $this->getMock(BaseEntity::class, $value = 'String');

        expect($mock->getValue())->equals($value);
    }
}