	<?php
		include('db_backup_library.php');
		$dbbackup = new db_backup;
		$dbbackup->connect("localhost","root","","myci1");
		$dbbackup->backup();
		echo "<pre>";
			print_r($dbbackup->tables());
		echo "</pre>"
	?>
	