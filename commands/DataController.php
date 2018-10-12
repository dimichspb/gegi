<?php
namespace app\commands;

use app\components\BackupSystemInterface;
use app\components\FilesystemInterface;
use app\processors\ProcessorInterface;
use app\services\application\Service as ApplicationService;
use yii\base\Module;
use yii\console\Controller;
use yii\console\ExitCode;

class DataController extends Controller
{
    /**
     * @var ProcessorInterface
     */
    protected $processor;

    /**
     * @var ApplicationService
     */
    protected $applicationService;

    /**
     * @var BackupSystemInterface
     */
    protected $backupSystem;

    /**
     * DataController constructor.
     * @param string $id
     * @param Module $module
     * @param ProcessorInterface $processor
     * @param ApplicationService $applicationService
     * @param BackupSystemInterface $backupSystem
     * @param array $config
     */
    public function __construct(string $id, Module $module, ProcessorInterface $processor, ApplicationService $applicationService,
                                BackupSystemInterface $backupSystem, array $config = [])
    {
        $this->processor = $processor;
        $this->applicationService = $applicationService;
        $this->backupSystem = $backupSystem;

        parent::__construct($id, $module, $config);
    }

    /**
     * @param $filename
     * @return int
     */
    public function actionImport($filename)
    {
        $path = getcwd() . DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($path)) {
            throw new \RuntimeException('File not found: ' . $path);
        }

        $data = file_get_contents($path);

        $this->backupSystem->backup($filename, $data);

        $collection = $this->processor->process($data);

        $this->stdout('Processing ' . $collection->count() . ' items...');
        $this->applicationService->import($collection);

        $this->stdout('Done!');

        return ExitCode::OK;
    }
}