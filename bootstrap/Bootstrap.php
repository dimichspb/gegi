<?php
namespace app\bootstrap;

use app\components\BackupSystemInterface;
use app\components\EntityManagerBuilder;
use app\components\FileBackupSystem;
use app\models\user\types\AccessTokenType;
use app\models\user\types\AuthKeyType;
use app\models\user\types\PasswordHashType;
use app\models\user\types\UsernameType;
use app\processors\JsonProcessor;
use app\processors\ProcessorInterface;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use League\Flysystem\Adapter\Local;
use League\Flysystem\FilesystemInterface;
use yii\base\BootstrapInterface;
use yii\di\Container;
use yii\web\User;

class Bootstrap implements BootstrapInterface
{
    /**
     * Bootstrap application
     *
     * @param \yii\base\Application $app
     * @throws \yii\db\Exception
     */
    public function bootstrap($app)
    {
        /** @var Container $container */
        $container = \Yii::$container;

        \Yii::$app->db->open();
        $pdo = \Yii::$app->db->pdo;

        $runtime = \Yii::getAlias('@runtime');
        $models = \Yii::getAlias('@app/models');

        $container->setSingleton(EntityManager::class, function () use ($pdo, $runtime, $models) {
            return (new EntityManagerBuilder())
                ->withProxyDir($runtime . '/proxy', 'Proxies', true)
                ->withMapping(new SimplifiedYamlDriver([
                    $models . '/user/mapping' => 'app\models\user',
                    $models . '/program/mapping' => 'app\models\program',
                    $models . '/month/mapping' => 'app\models\month',
                    $models . '/application/mapping' => 'app\models\application',
                ]))

                ->withCache(new FilesystemCache($runtime . '/cache'))
                ->withTypes([
                    \app\models\user\types\IdType::NAME => \app\models\user\types\IdType::class,
                    UsernameType::NAME => UsernameType::class,
                    AuthKeyType::NAME => AuthKeyType::class,
                    AccessTokenType::NAME => AccessTokenType::class,
                    PasswordHashType::NAME => PasswordHashType::class,

                    \app\models\program\types\IdType::NAME => \app\models\program\types\IdType::class,
                    \app\models\program\types\CodeType::NAME => \app\models\program\types\CodeType::class,
                    \app\models\program\types\DescriptionType::NAME => \app\models\program\types\DescriptionType::class,

                    \app\models\month\types\IdType::NAME => \app\models\month\types\IdType::class,
                    \app\models\month\types\NameType::NAME => \app\models\month\types\NameType::class,
                    \app\models\month\types\IndexType::NAME => \app\models\month\types\IndexType::class,

                    \app\models\application\types\IdType::NAME => \app\models\application\types\IdType::class,
                    \app\models\application\types\CountType::NAME => \app\models\application\types\CountType::class,
                ])
                ->withAutocommit(true)
                ->build(['pdo' => $pdo]);
        });

        $container->set(FilesystemInterface::class, new \League\Flysystem\Filesystem(
            new Local(\Yii::getAlias('@runtime/files'))
        ));

        $container->set(BackupSystemInterface::class, FileBackupSystem::class);

        $container->set(\app\repositories\user\RepositoryInterface::class,\app\repositories\user\DoctrineRepository::class);
        $container->set(\app\repositories\program\RepositoryInterface::class,\app\repositories\program\DoctrineRepository::class);
        $container->set(\app\repositories\month\RepositoryInterface::class, \app\repositories\month\DoctrineRepository::class);
        $container->set(\app\repositories\application\RepositoryInterface::class, \app\repositories\application\DoctrineRepository::class);
        $container->set(\app\repositories\result\RepositoryInterface::class, \app\repositories\result\DoctrineRepository::class);

        $container->set(ProcessorInterface::class, JsonProcessor::class);

        if ($app instanceof \yii\web\Application) {
            $container->set(User::class, \Yii::$app->user);
        }
    }
}