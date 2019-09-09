<?php

// Autoload files using Composer autoload
require_once __DIR__ . '/../vendor/autoload.php';

require_once 'config.php';

use MysqlDbExporter\MysqlDb;


MysqlDb::connect($MYSQL_SERVER, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE);

if (MysqlDb::backup()->save("sample/", "backup_" . $MYSQL_DATABASE . "_" . date('d-m-Y'))) {
    echo "Backup Saved Successfully";
}

// print_r(DB::tables());
// print_r(DB::view_fields("migrations"));
// print_r(DB::view_data("migrations"));
// print_r(DB::backup());

	
