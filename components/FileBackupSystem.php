<?php
namespace app\components;

use League\Flysystem\FilesystemInterface;

/**
 * Class FileBackupSystem
 * @package app\components
 */
class FileBackupSystem implements BackupSystemInterface
{
    const DEFAULT_IMPORT_BUCKET_NAME = 'import';

    /**
     * @var FilesystemInterface
     */
    protected $filesystem;

    /**
     * @var string
     */
    protected $importBucket;

    public function __construct(FilesystemInterface $filesystem, string $importBucket = self::DEFAULT_IMPORT_BUCKET_NAME)
    {
        $this->filesystem = $filesystem;
        $this->importBucket = $importBucket;
    }

    /**
     * @param string $filename
     * @param string $content
     * @return mixed|void
     * @throws \League\Flysystem\FileExistsException
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function backup(string $filename, string $content)
    {
        $path = $this->getPath($this->importBucket, $filename);

        if ($this->filesystem->has($path)) {
            $this->filesystem->update($path, $content);
        } else {
            $this->filesystem->write($path, $content);
        }
    }

    /**
     * @param $bucket
     * @param $filename
     * @return string
     */
    protected function getPath($bucket, $filename)
    {
        return implode(DIRECTORY_SEPARATOR, [
            $bucket,
            $filename
        ]);
    }
}