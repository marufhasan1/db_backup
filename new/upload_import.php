	<?php
		include('db_backup_library.php');
		$dbbackup = new db_backup;
		$dbbackup->connect("localhost","root","","test");
		$dbbackup->backup();
		if(isset($_POST["submit"])){

			//Uloading The temporary database file start here
        		if ($_FILES['temp_file']['name']!=null && $_FILES['temp_file']['name']!="") {
        			$src=$_FILES['temp_file']['tmp_name'];
        			$destination='temp_upload/temp_database.'.pathinfo($_FILES['temp_file']['name'],PATHINFO_EXTENSION);
        			if (copy($src,$destination)) {
        				//Importing Uploaded File Start here
							if($dbbackup->db_import($destination)){
								echo "Database Successfully Imported";
								//Deleting Temporary Database after imporing
								if(is_file($destination)){
									unlink($destination);
								}
							}
        				//Importing Uploaded File End here
        			}
        		}
			//Uloading The temporary database file end here
		}
	?>
	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
	<body>
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="file" name="temp_file">
			<input type="submit" name="submit" value="Upload">
		</form>
	</body>
</html>