	<?php
		include('db_backup_library.php');
		$dbbackup = new db_backup;
		$dbbackup->connect("localhost","root","","myci1");
		$dbbackup->backup();
		if($dbbackup->db_import("test.sql")){
			echo "Database Successfully Imported";
		}
	?>
	