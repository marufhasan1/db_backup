	<?php
		require "DB_Backup.php";
		use DB_Backup as DB;
		DB::connect("localhost","root","","prototype");
		DB::backup()->download();
	?>
	