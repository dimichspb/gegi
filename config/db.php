<?php

use app\components\NestedPDO;

return [
    'pdoClass' => NestedPDO::class,
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=gegi',
    'username' => 'gegi',
    'password' => 'gegi',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
