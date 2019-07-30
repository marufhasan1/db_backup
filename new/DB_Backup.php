<?php 
	class DB_Backup{
		private static $conn = null;
		private static $exported_database;

		// private function __construct () { }

		public static function connect($server, $user, $pass, $db){
			self::$conn = new mysqli($server, $user, $pass, $db);
			if (self::$conn->connect_error) {
			    die("Connection failed: " . self::$conn->connect_error);
			}
			// echo "connected";
		}


		public static function backup(){
			self::$conn->query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			/*-------------------------------------*/
			//------Creating Table SQL start-------//
			/*-------------------------------------*/

			$table_sql = array();
			foreach (self::tables() as $key => $table) {
				$tbl_query=self::$conn->query("SHOW CREATE TABLE ".$table);
				$row2 = $tbl_query->fetch_row();
				$table_sql[]=$row2[1];
			}
			
			$solid_tablecreate_sql = implode("; \n\n" , $table_sql);
			/*-------------------------------------*/
			//-------Creating Table SQL end--------//
			/*-------------------------------------*/


			/*-------------------------------------*/
			//------Inserting Data SQL Start-------//
			/*-------------------------------------*/
			$all_table_data = array();
			foreach (self::tables() as $key => $table) {
				$show_field = self::view_fields($table);
				$solid_field_name = implode(", ",$show_field);
				$create_field_sql = "INSERT INTO `$table` ( ".$solid_field_name.") VALUES \n";

				//Start checking data available
				$table_data= self::$conn->query("SELECT * FROM ".$table);
				if(self::$conn->error){
					die(self::$conn->error);
				}
				
				if ($table_data->num_rows > 0) {
					$data_viewig = self::view_data($table);
					$splice_data = array_chunk($data_viewig,50);
					foreach($splice_data as $each_datas){
						$solid_data_viewig = implode(", \n",$each_datas)."; ";
						$all_table_data[] = $create_field_sql.$solid_data_viewig;
					}
				}
				else{
					$all_table_data[] = null;
				}
				//End checking data available
				
				
				
			}
			$entiar_table_data = implode(" \n\n\n",$all_table_data);
			/*-------------------------------------*/
			//-------Inserting Data SQL End--------//
			/*-------------------------------------*/
			self::$exported_database = $solid_tablecreate_sql."; \n \n".$entiar_table_data;
			return new static;
		}


		public static function tables(){
			/*-------------------------------------*/
			//------Creating Table List start------//
			/*-------------------------------------*/
			$tb_name=self::$conn->query("SHOW TABLES");
			$tables=array();
			while ($tb = $tb_name->fetch_row()) {
				$tables[] = $tb[0];
			}
			/*-------------------------------------*/
			//-------Creating Table List end-------//
			/*-------------------------------------*/
			return $tables;
		}


		private static function view_fields($tablename){

			//Getting the fields list by table
			$all_fields=array();
			$fields = self::$conn->query("SHOW COLUMNS FROM ".$tablename);
			
			if(self::$conn->error){
				die(self::$conn->error);
			}
			
			if ($fields->num_rows > 0) {
				while ($field = $fields->fetch_assoc()) {
					$all_fields[]="`".$field["Field"]."`";
				}
			}
			return $all_fields;
		}


		public function view_data($tablename){
			$all_data=array();
			$table_data=self::$conn->query("SELECT * FROM `".$tablename."`");

			if(self::$conn->error){
				die(self::$conn->error);
			}

			if($table_data->num_rows > 0){				
				while ($t_data = $table_data->fetch_row()) {

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


		public static function save($path,$name=""){
			$name = ($name != "") ? $name : 'backup_' . date('Y-m-d');
			
			//Save file
			$file = fopen($path.$name.".sql","w+");
			$fw = fwrite($file, self::$exported_database);	
			if(!$fw){
				return false;
			}
			else {
				return true; 
			}
		}


		public static function download($name='backup'){
		
			header('Content-Type: application/sql');
			header('Content-Disposition: attachment; filename='.$name.'.sql');
			echo self::$exported_database;
		}


		//Export End here====================================================================

		//Import Start here==================================================================
		public static function import($file_path){
			$tbl_query=null;
			foreach (self::tables() as $key => $table) {
				self::$conn->query("DROP TABLE IF EXISTS ".$table);
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
					self::$conn->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . self::$conn->error . '<br /><br />');
					// Reset temp variable to empty
					$templine = '';
				}
			}
			//echo "Database imported successfully <br/>";
			return true;
		}

	}