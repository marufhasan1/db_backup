# Database Backup Library 
## Initialize
	include('db_backup_library.php');
	$dbbackup = new db_backup;
## Initialize
		
	## Specification
	-- Class Name is: db_backup
	-- Methods
		-- connect(Server Name,User name,passwrd,Database) 
			--Usages: If your project connected with database already
					then you don't need to use this 'connect()' Method
			--Parameters
				1st: Server Name
				2nd: Username
				3rd: Password
				4th: Database Name
		-- tables() It will Return an array with all tables name in the database
		-- backup() It will Initialize The Backup
		-- download() It will download The Backup file in sql
			--Parameters
				1st: If you want to give a custom name of backup use it Default is 'backup'
		-- save() If you want to save the backup file into a server directory you can use it
			--parameters
				1st: Path URL
				2nd: file Name Default Name is backup_yyy-mm-dd
		--db_import(source)
			Usage: If you want to Import Database from SQL File Use this method
			--Parameters
			1st: Source/Path of SQL file
