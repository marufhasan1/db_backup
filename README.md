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
If you want to download The database you can use this method. After run this method you will see a Download Popup menu of database SQL file.
	
**Example**
`<a href="download.php">Download</a>`
	
**'download.php' Contain Only This code:**
`include('db_backup_library.php');`
	
`$dbbackup = new db_backup;`
	
`$dbbackup->connect("Server Name","Username","passwrd","Database");`
	
`$dbbackup->backup();`
	
`$dbbackup->download();`

#### Note: This is the better way to keep the download code into a single page.

### `save()`
If you want to save the backup file into a server directory you can use this method
#### Parameters
It has 2 Parameters
> 1st parameter is Target path (where you want to save the file) *It is Mendatory* If you want to kip it blank you can just use `save("")`
> 2nd Parameter is (Optional) name of The file Default is *'backup_yyy-mm-dd.sql'*
### Documentation is not complete yeat...........
