<?php
namespace app\models\month;

use app\models\application\Application;
use app\models\BaseModel;
use app\models\program\Program;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Month
 * @package app\models\month
 */
class Month extends BaseModel
{
    /**
     * @var Id
     */
    protected $id;

    /**
     * @var Name
     */
    protected $name;

    /**
     * @var Index
     */
    protected $index;

    /**
     * @var ArrayCollection
     */
    protected $applications;

    /**
     * Month constructor.
     * @param Id $id
     * @param Name $name
     * @param Index $index
     * @param ArrayCollection|null $applications
     */
    public function __construct(Id $id, Name $name, Index $index, ArrayCollection $applications = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->index = $index;
        $this->applications = $applications? $applications: new ArrayCollection();
    }

    /**
     * @return Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Index
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * @return ArrayCollection
     */
    public function getApplications()
    {
        return $this->applications;
    }

    /**
     * @param Program $program
     * @return ArrayCollection
     */
    public function getApplicationsByProgram(Program $program)
    {
        return $this->applications->filter(function(Application $application) use ($program) {
            return $application->getProgram() === $program;
        });
    }
}