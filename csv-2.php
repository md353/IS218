<?php
//====================================================================
//	Michael De La Cruz 
//	IS218
//	Assignment 2
//====================================================================


//**********************
//	Created a class
//**********************

class csvfile 
{
	// defining variables
	public $csv;
	public $column_headings;
//***************************************
//	Created a function within the class
//***************************************
	public function readcsv($csv, $column_headings)
	{
//**************************
//	Code to open CSV file 
//**************************		
	  ini_set('auto_detect_line_endings',TRUE);
	  //	variable $csv is holding spot for csvfile to be opened
		if (($handle = fopen($csv, "r")) !== FALSE) 
		{
    		while (($row = fgetcsv($handle, ",")) !== FALSE) 
    		{
     			if($column_headings == TRUE) 
     			{
       				$column_heading = $row;
       				$column_headings = FALSE;
     			} else {
       				$record = array_combine($column_heading, $row);
       				$records[] = $record;
     				   }

    		}

    		fclose($handle);
	  }
	if(empty($_GET)) 
	{
	foreach($records as $record) 
	{
		// creating records
			$i++;
			$record_num = $i - 1;
			
		// Printing out links
      echo '<a href=' . '"http://localhost/is218/csv-2.php?record=' . $record_num . '"' . '>University ' . $i . ' </a>'; 		
      echo '</p>';    	
 	}
	}
		$record = $records[$_GET['record']];
		
	  echo "<table border='1'>";
    	
    	
    	foreach($record as $key => $value) 
    	{
	  		echo "<tr>";
	  		echo "<th> $key </th> <td> $value </td>";
	 		echo "</tr>";
    	}
	  echo "</table>"; 
  	}
	}
//*************
//	Entering new CSV file into function to read 
//*************
	$newfile = new csvfile();
	$newfile->readcsv("hd2013.csv",TRUE);

?>