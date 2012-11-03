<?php
/**
*	CLASS	:	A class to Manage Memory
*/
class memoryMgr {
	/**
 	*	ERROR DESCRIPTION:
	*	MEMORY_INI_SET_ERROR 		- Function ini_set("memory_limit", MEMORY) returned false
	*	MEMORY_LIMIT_EXHAUSTION 	- Unable to get the required memory in Mbytes for processing
 	*/
	private $memory_limit_PHP_INI;
	
	/**
 	*	Constructor
	*	INPUT	:	
 	*/
	public function __construct(){
		$this->memory_limit_PHP_INI = ini_get("memory_limit");
	}

	/**
 	*	FUNCTION	:	setMemory()		:	Get the required memory limit based on the data size
	*	INPUT		:	$dataSize			:	Size of Data
	*	RETURN		:	$memory_limit		:	New memory Limit
 	*/
	public function getMemory($dataSize){
		//Calculate the Amount of Memory Required for this
		//Assume 1 Char = 1 byte + header + memory for processing = 50 bytes
		//Total Bytes = 50 * $dataSize
		//Total MB = (50 * $dataSize)/1024/1024
		$memory_limit = 50*$dataSize/1024/1024; //Convery to MB
		//echo $memory_limit."<br>";
		
		if($memory_limit <= 128)			$memory_limit = "128M";
		elseif($memory_limit > 128 && $memory_limit <= 256)		$memory_limit = "256M";
		elseif($memory_limit > 256 && $memory_limit <= 512)		$memory_limit = "512M";
		elseif($memory_limit > 512 && $memory_limit <= 768)		$memory_limit = "768M";
		elseif($memory_limit > 768 && $memory_limit <= 1024)		$memory_limit = "1024M";
		elseif($memory_limit > 1024 && $memory_limit <= 1536)		$memory_limit = "1536M";
		elseif($memory_limit > 1536 && $memory_limit <= 2048)		$memory_limit = "2048M";
		else {echo "FATAL ERROR: MEMORY_LIMIT_EXHAUSTION<br>\n";	$memory_limit = 0; }
		
		return $memory_limit;
	}

	/**
 	*	FUNCTION	:	setMemory()		:	Get the required memory limit based on the data size
	*	INPUT		:	$dataSize			:	Size of Data
	*	RETURN		:	$memory_limit		:	New memory Limit
 	*/
	public function setMemory($dataSize){
		
		$memory_limit = $this->getMemory($dataSize);
		//echo "<br>\n$memory_limit\n<br>";
		if($memory_limit){
			$iniResult = ini_set("memory_limit", $memory_limit);
			
			if(!isset($iniResult)){
				$memory_limit = 0;	
				//echo "ERROR: MEMORY_INI_SET_ERROR<br>\n";
			}
		}			
		
		return $memory_limit;
	}
	
	/**
 	*	FUNCTION	:	resetMemory()		:	Reset the Allocated memory to the original Memory state of the application
	*	INPUT		:	
	*	RETURN		:	
 	*/
	public function resetMemory(){
		ini_set("memory_limit", $this->memory_limit_PHP_INI);
	}
}//memoryMgr END
?>