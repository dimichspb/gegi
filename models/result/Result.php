<?php
namespace app\models\result;

use app\models\application\Count;
use app\models\BaseModel;
use app\models\month\Month;
use app\models\program\Program;

class Result extends BaseModel
{
    /**
     * @var Month
     */
    protected $month;

    /**
     * @var array
     */
    protected $columns = [];

    /**
     * Result constructor.
     * @param Month $month
     */
    public function __construct(Month $month)
    {
        $this->month = $month;
    }

    /**
     * @return Month
     */
    public function getMonth(): Month
    {
        return $this->month;
    }

    /**
     * @param Program $program
     * @param Count $count
     */
    public function setValue(Program $program, Count $count)
    {
        $this->setColumn($program->getCode()->getValue(), $count->getValue());
    }

    /**
     * @param Program $program
     * @return mixed|null
     */
    public function getValue(Program $program)
    {
        $index = $program->getCode()->getValue();

        return $this->getColumn($index);
    }

    /**
     * @return array
     */
    public function getColumns()
    {
        return array_keys($this->columns);
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return array_values($this->columns);
    }

    /**
     * @param $index
     * @return mixed|null
     */
    public function getColumn($index)
    {
        return isset($this->columns[$index])? $this->columns[$index]: null;
    }

    /**
     * @param $index
     * @param $value
     */
    public function setColumn($index, $value)
    {
        $this->columns[$index] = $value;
    }
}