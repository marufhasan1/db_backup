<?php
/*
	-- Specification--
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
*/			


class db_backup{
		private $exported_database;
		
		public function backup(){
			/*-------------------------------------*/
			//------Creating Table SQL start-------//
			/*-------------------------------------*/

			$table_sql = array();
			foreach ($this->tables() as $key => $table) {
				$tbl_query=mysql_query("SHOW CREATE TABLE ".$table);
				$row2 = mysql_fetch_row($tbl_query);
				$table_sql[]=$row2[1];
			}
			
			$solid_tablecreate_sql = implode("; \n\n" , $table_sql);
			/*-------------------------------------*/
			//-------Creating Table SQL end--------//
			/*-------------------------------------*/


			/*-------------------------------------*/
			//------Inserting Data SQL Start-------//
			/*-------------------------------------*/
			$all_table_data=array();
			foreach ($this->tables() as $key => $table) {
				$show_field=$this->view_fields($table);
				$solid_field_name=implode(", ",$show_field);
				$create_field_sql="INSERT INTO `$table` ( ".$solid_field_name.") VALUES \n";

				//Start checking data available
				mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
				$table_data= mysql_query("SELECT*FROM ".$table);
				if(!$table_data){
					echo 'Could not run query: '. mysql_error();
				}
				
				if (mysql_num_rows($table_data) > 0) {
					$data_viewig=$this->view_data($table);
					$splice_data = array_chunk($data_viewig,50);
					foreach($splice_data as $each_datas){
						$solid_data_viewig=implode(", \n",$each_datas)."; ";
						$all_table_data[]=$create_field_sql.$solid_data_viewig;
					}
				
				}
				else{
					$all_table_data[]=null;
				}
				//End checking data available
				
				
				
			}
			$entiar_table_data=implode(" \n\n\n",$all_table_data);
			/*-------------------------------------*/
			//-------Inserting Data SQL End--------//
			/*-------------------------------------*/
			$this->exported_database=$solid_tablecreate_sql."; \n \n".$entiar_table_data;
			return $this;
		}

		//Additional Methods
		/*-------------------------------------*/
		//--------Functions Start here---------//
		/*-------------------------------------*/
		
		public function download($name='backup'){
			/*//Download
			$file_name="Tmpdata.sql";
			$file=fopen($file_name,"w+");
			fwrite($file, $this->exported_database);*/
			
			header('Content-Type: application/sql');
			header('Content-Disposition: attachment; filename='.$name.'.sql');
			echo $this->exported_database;
			/*readfile($file_name);
			fclose($file);
			unlink($file_name);*/
		}
		
		public function save($path,$name=""){
			$name = ($name != "") ? $name : 'backup_' . date('Y-m-d');
			
			//Save file
			$file = fopen($path.$name.".sql","w+");
			$fw = fwrite($file, $this->exported_database);	
			if(!$fw){
				return false;
			}
			else {
				return true; 
			}
		}
		
		public function connect($server,$user,$pass,$db){
			$conn=mysql_connect($server,$user,$pass);
			$condb=mysql_select_db($db);
			if(!$conn || !$condb){
				echo mysql_error();
			}else{
				return true;
			}
		}
	
		public function tables(){
			/*-------------------------------------*/
			//------Creating Table List start------//
			/*-------------------------------------*/
			$tb_name=mysql_query("SHOW TABLES");
			$tables=array();
			while ($tb=mysql_fetch_row($tb_name)) {
				$tables[]=$tb[0] ;
			}
			/*-------------------------------------*/
			//-------Creating Table List end-------//
			/*-------------------------------------*/
			return $tables;
		}
		
		public function view_fields($tablename){
			$all_fields=array();
			$fields = mysql_query("SHOW COLUMNS FROM ".$tablename);
			if (!$fields) {
			 echo 'Could not run query: ' . mysql_error();
			}
			
			if (mysql_num_rows($fields) > 0) {
				while ($field = mysql_fetch_assoc($fields)) {
					$all_fields[]="`".$field["Field"]."`";
				}
			}
			return $all_fields;
		}


		public function view_data($tablename){
			$all_data=array();
			$table_data=mysql_query("SELECT*FROM ".$tablename);
			if(!$table_data){
				echo 'Could not run query: '. mysql_error();
			}

			if(mysql_num_rows($table_data)>0){

				
				while ($t_data=mysql_fetch_row($table_data)) {

					$per_data=array();
					foreach ($t_data as $key => $tb_data) {
						$per_data[]= "'".str_replace("'","\'",$tb_data)."'";
					}
					$solid_data= "(".implode(", ",$per_data).")";
					$all_data[]=$solid_data;
				}
			}
				return $all_data;
		}
	

		/*-------------------------------------*/
		//---------Functions End here----------//
		/*-------------------------------------*/

		//Export End here==================================================================
		//Import Start here==================================================================
		function db_import($file_path){
			$tbl_query=null;
			foreach ($this->tables() as $key => $table) {
				$tbl_query=mysql_query("DROP TABLE IF EXISTS ".$table);
			}
		 
			//---------------------------------------------------------------------------
			//Forign code Start here
			//---------------------------------------------------------------------------
			$templine = '';
			// Read in entire file
			$lines = file($file_path);
			// Loop through each line
			foreach ($lines as $line)
			{
			// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;

				// Add this line to the current segment
				$templine .= $line;
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';')
				{
					// Perform the query
					mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
					// Reset temp variable to empty
					$templine = '';
				}
			}

			 //echo "Database imported successfully <br/>";
			return true;
		}
	}
