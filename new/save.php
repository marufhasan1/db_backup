	<?php
		require "DB_Backup.php";
		use DB_Backup as DB;
		DB::connect("localhost","root","","prototype");
		
		if(DB::backup()->save("file/")){
			echo "Backup Saved Successfully";
		}

	// print_r(DB::tables());
	// print_r(DB::view_fields("migrations"));
	// print_r(DB::view_data("migrations"));
	// print_r(DB::backup());
	?>
	
