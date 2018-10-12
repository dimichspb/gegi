<?php

use app\factories\MonthFactory;
use app\services\month\Service;
use yii\db\Migration;

/**
 * Class m181010_084641_fill_month_table_default_values
 */
class m181010_084641_fill_month_table_default_values extends Migration
{

    protected $service;
    protected $factory;

    public function __construct(Service $service, MonthFactory $factory, array $config = [])
    {
        $this->service = $service;
        $this->factory = $factory;

        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->factory->getDefaults() as $default) {
            $month = $this->service->createByName($default['name']);
            $this->service->add($month);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ($this->factory->getDefaults() as $default) {
            $month = $this->service->findByName($default['name']);
            $this->service->remove($month);
        }
    }
}
