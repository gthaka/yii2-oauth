<?php

$db_host = $_ENV['DB_HOST'];
$db_name = $_ENV['DB_NAME'];

return [
    'class' => yii\db\Connection::class,
    'dsn' => "mysql:host=$db_host;dbname=$db_name",
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
