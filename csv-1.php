<?php
//====================================================================
//	Michael De La Cruz 
//	IS218
//	Assignment 1
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
//*************
//	Code to open CSV file 
//*************		
	  ini_set('auto_detect_line_endings',TRUE);
	  //	variable $csv is holding spot for csvfile to be opened
		if (($handle = fopen($csv, "r")) !== FALSE) 
		{
    		while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) 
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
		
	foreach($records as $record) 
	{
    	foreach($record as $key => $value) 
    	{
      		echo $key . ': ' . $value .  "</br> \n";
    	}
    	echo '<hr>';
  	}
	
	}
}
/*	
//*************
//	New Class
//*************	
class otherclass
{
//**********************************************************
//	Function to read csvfile method is called
//**********************************************************
	function callcsvfile()
	{
		$csvfile = new csvfile();
		$newcsv = $csvfile->readcsv();
		echo $newcsv;
	}
}
 */	
//*************
//	Entering new CSV file into function to read 
//*************
	$newfile = new csvfile();
	$newfile->readcsv("uk-500.csv",TRUE);

?>