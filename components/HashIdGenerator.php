<?php
namespace app\components;

use Doctrine\ORM\Id\AbstractIdGenerator;

/**
 * Class HashIdGenerator
 * @package app\components
 */
class HashIdGenerator extends AbstractIdGenerator
{
    /**
     * Generate hash
     * @param \Doctrine\ORM\EntityManager $em
     * @param null|object $entity
     * @return mixed|string
     */
    public function generate(\Doctrine\ORM\EntityManager $em, $entity)
    {
        return md5(serialize($entity));
    }
}