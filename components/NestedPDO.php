<?php
namespace app\components;

/**
 * Class NestedPDO
 * @package app\components
 */
class NestedPDO extends \PDO 
{
    // Database drivers that support SAVEPOINTs.
    protected static $savepointTransactions = array("pgsql", "mysql");

    // The current transaction level.
    protected $transLevel = 0;

    /**
     * @return bool
     */
    protected function nestable()
    {
        return in_array($this->getAttribute(\PDO::ATTR_DRIVER_NAME),
            self::$savepointTransactions);
    }

    /**
     * @return bool|void
     */
    public function beginTransaction()
    {
        if($this->transLevel == 0 || !$this->nestable()) {
            parent::beginTransaction();
        } else {
            $this->exec("SAVEPOINT LEVEL{$this->transLevel}");
        }

        $this->transLevel++;
    }

    /**
     * @return bool|void
     */
    public function commit() {
        $this->transLevel--;

        if($this->transLevel == 0 || !$this->nestable()) {
            parent::commit();
        } else {
            $this->exec("RELEASE SAVEPOINT LEVEL{$this->transLevel}");
        }
    }

    /**
     * @return bool|void
     */
    public function rollBack() {
        $this->transLevel--;

        if($this->transLevel == 0 || !$this->nestable()) {
            parent::rollBack();
        } else {
            $this->exec("ROLLBACK TO SAVEPOINT LEVEL{$this->transLevel}");
        }
    }
}