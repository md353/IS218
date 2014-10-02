<?php

//====================================================================
//	Michael De La Cruz 
//	IS218
//	Challenge 1
//====================================================================

//********************************************
//	Created a class for reading the CSV File
//********************************************	
		class File {
	
		public function __construct() {
			
		}
		
		public static function openFile($file){
			$handle = fopen($file, "r");
			//$handle2 = fopen($file2, "r");
			// $handle = array_replace_recursive($handle1,$handle2);
			//$handle = 
			//$handle = array_replace($handle1[],$handle2);
			return $handle ;
		}
		
		public static function closeFile($handle){
			fclose($handle);
		}
		
	}
//***************************************************
//	Created a class for checking the column headings 
//***************************************************
	class readcsv {
		
		public static $handle;
		public static $colmn_headings;
		
		public function column_headingsCK($handle, $colmn_headings){
			
			while(($row = fgetcsv($handle, ",")) !== FALSE){
					if($colmn_headings){
						$column_heading = $row;
						$colmn_headings = FALSE;
					}
					else{
						$record = array_combine($column_heading, $row);
						$records[] = $record;
					}
				}
				return $records;
		}
		
	}

//**********************************************************************************
//	Created a class to print a table from the information extracted off the CSVfile
//**********************************************************************************
	class html_table {
		
		public static function printTable($records,$url_var){
			if(isset($_GET[$url_var])){
				echo '<table border="1">';
				foreach($records[$_GET[$url_var]] as $key => $value){
					
					echo '<tr><th>' . $key . '</th>';
					echo '<td>' . $value . '</td></tr>';
				}
					echo '</table>';
			}
		}
	}
	///class change extends html_table{
	///	pblic static function 
	//}
//******************************************************
//	Created a class create HTML links based off the class 
//******************************************************
	class pLinks extends html_table {
		
		public function __construct($records){
			
			$i = -1;
			if(empty($_GET)){
				foreach($records as $record){
					$i++;
				    echo '<a href="?record=' .$i. '">' . $record['INSTNM'] . '</a>';
					echo'</p>';
				}
			}
			
			html_table::printTable($records, 'record');
		}
		//public function __destruct($records){
			//html_table::printTable($records, 'record');
		//}
	}
	
$csv = 'hd2013.csv';
$file = File::openFile($csv);

$handle = new readcsv();
$records = $handle->column_headingsCK($file, TRUE);

new pLinks($records);

?>