<?php
declare(strict_types=1);

use yii\db\Connection;

return [
    'class' => Connection::class,
    'dsn' => 'mysql:host=db;dbname=yii_db',
    'username' => 'yii_user',
    'password' => 'user_password',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
