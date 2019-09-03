	<?php
		require "DB_Backup.php";

    use DB_Backup as DB;

    DB::connect("localhost", "root", "", "prototype");

    if (DB::import("tests/backup_2019-07-30.sql")) {
			echo "Import Successfully";
		}
	?>
