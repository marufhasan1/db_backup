<?php
include_once 'config.php';
require "DB_Backup.php";

use DB_Backup as DB;

DB::connect($MYSQL_SERVER, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE);

if (DB::import("test_files/sample_database.sql")) {
    echo "Import Successfully";
}

