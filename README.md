# Database Backup Library 
## Initialize
`include('db_backup_library.php'); $dbbackup = new db_backup;`

Just Use `include` or `require` the `'db_backup_library.php'` File
And create an object of `'db_backup'` class


## Methods
	
* connect() 
* backup()
* tables()
* download()
* save()
* db_import()

### `connect()`
**This is a Opotional Method**
If your project connected with Server and database already then you don't need to use this Method,
Other wise you can use this method to connect with MySQL Server and Database
	
**Example**
	
`include('db_backup_library.php');`
	
`$dbbackup = new db_backup;`
	
`$dbbackup->connect("Server Name",User name,passwrd,Database)`

### `backup()`
**This is a Mendatory Method**
After connecting with Server and Database you must call this method other wise other method cannot work.

**Example**
	
`include('db_backup_library.php');`
	
`$dbbackup = new db_backup;`
	
`$dbbackup->connect("Server Name","Username","passwrd","Database");`
	
`$dbbackup->backup();`

	
### `tables()`
If you need to show the name of all table in database just call this method it will return an array with the name of all table in the database.
	
**Example**
	
`include('db_backup_library.php');`
	
`$dbbackup = new db_backup;`
	
`$dbbackup->connect("Server Name","Username","passwrd","Database");`
	
`$dbbackup->backup();`
	
`print_r($dbbackup->tables());`

### `download()`
If you want to download The database you can use this method
### Documentation is not complete yeat...........
