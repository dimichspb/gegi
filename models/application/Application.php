<?php
namespace app\models\application;

use app\models\BaseModel;
use app\models\month\Month;
use app\models\program\Program;

/**
 * Class Application
 * @package app\models\application
 */
class Application extends BaseModel
{
    /**
     * @var Id
     */
    protected $id;

    /**
     * @var Program
     */
    protected $program;

    /**
     * @var Month
     */
    protected $month;

    /**
     * @var Count
     */
    protected $count;

    /**
     * Application constructor.
     * @param Id $id
     * @param Program $program
     * @param Month $month
     * @param Count $count
     */
    public function __construct(Id $id, Program $program, Month $month, Count $count)
    {
        $this->id = $id;
        $this->program = $program;
        $this->month = $month;
        $this->count = $count;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Program
     */
    public function getProgram(): Program
    {
        return $this->program;
    }

    /**
     * @return Month
     */
    public function getMonth(): Month
    {
        return $this->month;
    }

    /**
     * @return Count
     */
    public function getCount(): Count
    {
        return $this->count;
    }

    public function getName()
    {
        return $this->getMonth()->getName()->getValue();
    }
}