	<?php
		require "DB_Backup.php";
		use DB_Backup as DB;
		DB::connect("localhost","root","","prototype");

		echo "<pre>";
		print_r(DB::backup()->tables());
		echo "</pre>";
	?>
	