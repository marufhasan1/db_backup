<?php
include_once 'config.php';
require "DB_Backup.php";

use DB_Backup as DB;

DB::connect($MYSQL_SERVER, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE);

if (DB::backup()->save("test_files/", "backup_" . $MYSQL_DATABASE . "_" . date('d-m-Y'))) {
    echo "Backup Saved Successfully";
}

// print_r(DB::tables());
// print_r(DB::view_fields("migrations"));
// print_r(DB::view_data("migrations"));
// print_r(DB::backup());

	
