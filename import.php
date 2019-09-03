<?php
include('db_backup_library.php');
$dbbackup = new db_backup;
$dbbackup->connect("localhost", "root", "", "test");
$dbbackup->backup();
if ($dbbackup->db_import("sample_database.sql")) {
    echo "Database Successfully Imported";
}

