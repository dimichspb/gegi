<?php
namespace app\processors;

use app\models\application\ApplicationCollection;

/**
 * Interface ProcessorInterface
 * @package app\processors
 */
interface ProcessorInterface
{
    /**
     * @param $data
     * @return ApplicationCollection
     */
    public function process($data): ApplicationCollection;
}