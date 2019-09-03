<?php

// Autoload files using Composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

require_once 'config.php';

use MysqlDbExporter\MysqlDb;

MysqlDb::connect($MYSQL_SERVER, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE);

if (MysqlDb::import("sample/inventory.sql")) {
    echo "Import Successfully";
}

