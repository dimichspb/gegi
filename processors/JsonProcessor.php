<?php
namespace app\processors;

use app\models\application\ApplicationCollection;
use app\models\month\MonthCollection;
use yii\helpers\Json;
use app\services\program\Service as ProgramService;
use app\services\month\Service as MonthService;
use app\services\application\Service as ApplicationService;

/**
 * Class JsonProcessor
 * @package app\processors
 */
class JsonProcessor implements ProcessorInterface
{
    /**
     * @var ProgramService
     */
    protected $programService;

    /**
     * @var MonthService
     */
    protected $monthService;

    /**
     * @var ApplicationService;
     */
    protected $applicationService;

    /**
     * JsonProcessor constructor.
     * @param ProgramService $programService
     * @param MonthService $monthService
     * @param ApplicationService $applicationService
     */
    public function __construct(ProgramService $programService, MonthService $monthService, ApplicationService $applicationService)
    {
        $this->programService = $programService;
        $this->monthService = $monthService;
        $this->applicationService = $applicationService;
    }

    /**
     * @param $data
     * @return ApplicationCollection
     */
    public function process($data): ApplicationCollection
    {
        $array = Json::decode($data);

        if (!is_array($array)) {
            throw new \RuntimeException('Error processing data');
        }

        $collection = $this->processArray($array);

        return $collection;
    }

    /**
     * @param array $array
     * @return ApplicationCollection
     */
    protected function processArray(array $array): ApplicationCollection
    {
        if (!isset($array['Columns'])) {
            throw new \RuntimeException('Wrong format. Cannot find "Columns" array');
        }
        if (!isset($array['Rows'])) {
            throw new \RuntimeException('Wrong format. Cannot find "Rows" array');
        }

        $monthCollection = $this->processColumns($array['Columns']);

        return $this->processRows($monthCollection, $array['Rows']);
    }

    /**
     * @param array $array
     * @return MonthCollection
     * @throws \Collections\Exceptions\InvalidArgumentException
     */
    protected function processColumns(array $array): MonthCollection
    {
        $collection = new MonthCollection();

        foreach ($array as $name) {
            if (!$month = $this->monthService->findByName($name)) {
                $month = $this->monthService->createByName($name);
            }
            $collection = $collection->add($month);
        }

        return $collection;
    }

    /**
     * @param MonthCollection $monthCollection
     * @param array $array
     * @return ApplicationCollection
     * @throws \Collections\Exceptions\InvalidArgumentException
     */
    protected function processRows(MonthCollection $monthCollection, array $array): ApplicationCollection
    {
        $collection = new ApplicationCollection();

        foreach ($array as $code => $row) {
            if (!$program = $this->programService->findByCode($code)) {
                $program = $this->programService->create($code);
            }

            foreach ($monthCollection as $index => $month) {
                if (!isset($row[$index])) {
                    throw new \RuntimeException(
                        'No index ' . $index . ' found in row: ' . $code . ', dump: ' . PHP_EOL .
                        serialize($row));
                }
                if (!$application = $this->applicationService->findByProgramAndMonth($program, $month)) {
                    $application = $this->applicationService->create($program, $month, (int)$row[$index]);
                }

                $collection = $collection->add($application);
            }
        }

        return $collection;
    }
}