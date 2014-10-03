<?php

//====================================================================|
//	Michael De La Cruz 												  |
//	IS218															  |
//	Challenge 1														  |
//====================================================================|

//**********************************************************************************//
//	Created a class to create & print a table from 									//
//  the information extracted off the CSVfile										//
//**********************************************************************************//
	class html_table{
		
		// This function prints table from csv file by heading and data
		public static function prTable($records,$uName){
			if(isset($_GET[$uName])){
				// callng class and function to open file & create table to be used later
				$csvFile2 = File::openFile('hd2013xl.csv');
				$heads = readcsv::gtHeads($csvFile2,TRUE);
				echo '<table border="1">';
				foreach($records[$_GET[$uName]] as $key => $value){
					echo '<tr><th>' . $heads[$key] . '</th>';
					echo '<td>' . $value . '</td></tr>';
				}
				echo '</table>';
			}
		}
	}
//************************************************************************************//
//	Created a class create HTML links based off the table created					  //
//************************************************************************************//
	class prLinks extends html_table{
		
		// This function has a constructor to print links when a new object is created and array passed	
		public function __construct($records){
			
			$i = -1;
			if(empty($_GET)){
				foreach($records as $record){
					$i++;
					echo '<a href="?record=' .$i. '">' . $record['INSTNM'] . '</a>';
					echo'</p>';
				}
			}
			// Is called to print table after links are pressed on like in cars.php
			html_table::prTable($records, 'record');
		}
	}

//********************************************//
//	Created a class for opening the CSV File  //
//********************************************//	
	class File {
		
		//Function for opening a csv file for reading.	
		public static function openFile($file){
			$handle = fopen($file, "r");
			return $handle;
		}
		
		// closing the file 
		public static function closeFile($handle){
			fclose($handle);
		}
	}
//********************************************
//	Created a class for reading the CSV File & setting headings
//********************************************	
	class readcsv extends File{
		
		// This function is looking for headings 
		public function column_headingCK($handle, $colmn_heads){
			
			while(($row = fgetcsv($handle, ",")) !== FALSE){
					if($colmn_heads){
						$column_heading = $row;
						$colmn_heads = FALSE;
					}
					else{
						$record = array_combine($column_heading, $row);
						$records[] = $record;
					}
				}
				return $records;
		}
		//...............................................................................
		// This static function matches the headings from database Look alike headings to
		// specific headings that are much more understandable. Is used to replace colum heading
		//...............................................................................
		public static function gtHeads($handle, $colmn_heads){
			while(($row = fgetcsv($handle)) !== FALSE){
					
					if($colmn_heads){
						$column_heading = $row;
						$colmn_heads = FALSE;
					}
					else{
						$record = array_combine($column_heading, $row);
						$records[$record['varname']] = $record['varTitle'];
					}	
					
				}
				
				return $records;
		}
	}
//-----------------------------------------------------------------------------------------------
// The file is being set to a variable that then passes the class and function to open the file  
//-----------------------------------------------------------------------------------------------
$csvFile = 'hd2013.csv';
$file = File::openFile($csvFile);
//-------------------------------------------------------------------------------------
// The file is then loaded up through calling a function and placing it into an array
//-------------------------------------------------------------------------------------
$handle = new readcsv();
$records = $handle->column_headingCK($file, TRUE);
//....................................................................
// Links are then printed when object is instantiated by the "new"
//.....................................................................
new prLinks($records);

?>
