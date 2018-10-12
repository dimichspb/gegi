<?php
namespace app\components;

/**
 * Interface BackupSystemInterface
 * @package app\components
 */
interface BackupSystemInterface
{
    /**
     * @param string $filename
     * @param string $content
     * @return mixed
     */
    public function backup(string $filename, string $content);
}