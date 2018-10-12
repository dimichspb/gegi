<?php
namespace app\models\program;

use app\models\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

class Program extends BaseModel
{
    /**
     * @var Id
     */
    protected $id;

    /**
     * @var Code
     */
    protected $code;

    /**
     * @var Description
     */
    protected $description;

    /**
     * @var ArrayCollection
     */
    protected $applications;

    /**
     * program constructor.
     * @param Id $id
     * @param Code|null $code
     * @param Description|null $description
     * @param ArrayCollection|null $applications
     */
    public function __construct(Id $id, Code $code = null, Description $description = null, ArrayCollection $applications = null)
    {
        $this->id = $id;
        $this->code = $code;
        $this->description = $description;
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
     * @return Code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Code $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @param Description $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return ArrayCollection
     */
    public function getApplications()
    {
        return $this->applications;
    }
}
