<?php
include_once 'config.php';
require "DB_Backup.php";

use DB_Backup as DB;

DB::connect($MYSQL_SERVER, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DATABASE);

echo "<pre>";
print_r(DB::backup()->tables());
echo "</pre>";

