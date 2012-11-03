<?php
require_once('memMgr.php'); 
/**
*	CLASS	:	A class to read/write/update CSV File
*/
class csvManager extends memoryMgr{	
	private $csvFileName;
	
	/**
 	*	Constructor
	*	INPUT	:	CSV File Name
 	*/
	public function __construct($csvFileName){
	  ini_set('auto_detect_line_endings',TRUE);
	  
	  //If .csv extension is missing then add it
	  if(!strstr(".csv", $csvFileName)){
				 $this->csvFileName = $csvFileName.".csv";
			}	 
		 //echo "<br>".$this->csvFileName."<br>"; die;
	}
	
  public function setFileName($csvFileName){
   $this->csvFileName = $csvFileName;
   //echo "<br>".$this->csvFileName."<br>";
  }
	
	
	/**
 	*	FUNCTION	:	csvRead()	:	Read CSV File
	*	INPUT		:	$mode		:	r. If mode is not provided then default value used is 'r'. Optional
	*	RETURN		:	$csvArr		:	return the CSV File into an array
 	*/
	public function csvRead($mode='r'){
		//Handle 'r' cases only
		switch($mode){
		case 'r':
		case 'R':
			$mode = 'r';
			break; 

		default:
			echo "ERROR: Incorrect Read Mode. Use mode parameter 'r': read File<br>\n";
			return false;
		}
		
		$handle = fopen($this->csvFileName, $mode);
		if($handle){
			$counter = 0;
			while (($csvRow = fgetcsv($handle, 1024, ",")) !== FALSE) {
				$csvArr[$counter++] = $csvRow;
				//print_r($csvRow); echo "<br>\n<br>\n"; 
			}					
			fclose($handle);
		}
		else{
			echo "ERROR: Unable to open the file $this->csvFileName<br>\n";
			return false;
		}
		
		return $csvArr;
	}
	
	/**
 	*	FUNCTION	:	csvWrite()	:	Write to CSV File
	*	INPUT		:	$csvArr		:	Data Array to be written into CSV File
	*	INPUT		:	$mode		:	w, a. If mode is not provided then default value used is 'w'. Optional
	*	RETURN		:	$status		:	result of the write function
 	*/
	public function csvWrite($csvArr, $mode='w'){
		
		//Handle w: write & a:append cases only
		switch($mode){
		case 'a':
		case 'A':
			$mode = 'a';
			break; 
			
		case 'w':
		case 'W':
			$mode = 'w';
			break; 

		default:
			echo "ERROR: Incorrect Write Mode. Use mode parameters 'w': write / 'a': append File.<br>\n";
			return false;
		}
		
		ini_set("max_execution_time", 90);
		if(!$this->setMemory(10*sizeof($csvArr))){
			echo "FATAL ERROR: Insufficient Memory";
			return false;
		}
		
		$handle = fopen($this->csvFileName, $mode);
		if($handle){		
			if($csvArr){		
				$counter = 0;				
				foreach($csvArr as $row){
					if(is_array($row)){
						//$row has more than 1 Columns.
						if(is_array($row[0])){
							//TODO: This is a multidimensional Array. May need separate implementation
							echo "ERROR: Format Not Allowed after row count = $counter<br>\n";
							fclose($handle);
							return false;
						}
						$rowData = $row;
					}
					else{
						//$row has only 1 Column.
						$rowData = array($row);
					}
					
					$rowDataLen = fputcsv($handle, $rowData);
	
					if(!$rowDataLen){
						echo "ERROR: Unable to Write to CSV after row count = $counter<br>\n";
						fclose($handle);
						return false;
					}
					
					$counter++;
				}
			}
			
			fclose($handle);
		}
		else{
			echo "ERROR: Unable to open the file $this->csvFileName<br>\n";
			return false;
		}
		
		return true;
	}
}//csvManager END
?>