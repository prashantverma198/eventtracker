<?php
/**
 * Copyright (c) 2012 AD2C INDIA PVT. LTD
 *	
 *
 * @package       AD2CAMPAIGN
 * @copyright     AD2C INDIA PVT. LTD
 * @author        Prashant Verma <prashant@ad2c.co>
 * @license       Proprietary
 * @Description   Common Database Functions 
 *                
 */
 
class Database{
  private $host;
  private $user;
  private $pwd;
  private $dbname;
  
  /**
   *  @Method       __construct
   *  @Description		Construtor for this Database class. Save the Database host, user, password, schema
   */ 
  function __construct($host, $username, $password, $dbname) {
				$this->host = $host;
				$this->user = $username;
				$this->pwd  = $password;
				$this->dbname   = $dbname;
				$this->connect($this->host, $this->user, $this->pwd, $this->dbname);
  }

  /**
   *  @Method       connect
   *  @Description		Database connection method
   */ 	
	 function connect($host, $user, $pwd, $dbname){
	 		//echo "Class Database: connect(): ".$host." ### ".$user." ### ".$pwd."###".$dbname."<br><br>"; //die;
	 		
				$dbconnection = mysql_connect($host, $user, $pwd); 
				if($dbconnection){
					 $a = mysql_select_db($dbname);
				}
				else{
					 echo 'Fatal Error: Database Connection Failed ';
				}
  }

  /**
   *  @Method       select
   *  @Description		Default Implementation of Select Query
   */ 		
	 function select($tableName, $arrFiled, $where ='', $groupby = '', $order = '', $limit=''){
	   //echo "Class Database: select(): <br><br>"; die;
	   
		  $field = implode(',' , $arrFiled);//Get all the Fields from the array

    $where = ' WHERE '.$where;
		  if($where == '' && $groupby == ''){
		    //TODO: Is it Advisable to do where = '1'. Hope there is not Mysql Injection
			   $where = ' WHERE 1';
		  }
				elseif($where != '' && $groupby == '') {				  
						$where = $where;
				}
				elseif($where == '' && $groupby != '') {
						$where = ' GROUP BY '.$groupby;
				}
				elseif($where && $groupby){
       $where = $where.' GROUP BY '.$groupby;
				}
		  
		  $sql = 'SELECT '.$field.' FROM '.$tableName.$where;
				
				if($order){
				  $sql .= ' ORDER BY '.$order;
				}
				
		  if($limit) {
			   $sql .= ' LIMIT '.$limit;
		  }
		  
		  $sql .= ";";
		 //echo "Class Database: select(): $sql<br><br>"; //die;
		  $result = mysql_query($sql);				

				if($result){
					 while($row = mysql_fetch_assoc($result)){
						  $resultArr[] = $row;
			 		}
			 }		
			 return $resultArr;
	 }

  /**
   *  @Method       update
   *  @Description		Default Implementation of update Query
   */ 		
	 function update($table, $arrcols, $where){
	   //echo "Class Database: update(): <br><br>"; die;
    $comma = '';
		  
		  //Loop through all the arrcols, that are to be updated
		  foreach($arrcols as $key=>$value){
												
						if(is_numeric($value)){		//Check if the value is numeric						  
			    	$str .= $comma.$key.'='."'".$value."'";
			   }
			   elseif($value == 'now()'){  //This is for datetime setting
				    $str .= $comma.$key.'='.$value;
  			 } 
			   else{
				    $str .= $comma.$key.'="'.$value.'"';
			   }
			   
			   $comma = ', ';
		  }
		
		  $sql = 'UPDATE '.$table.' SET '.$str.' WHERE '.$where.";";
		
	  	//echo "Class Database: update(): $sql<br><br>"; die;

		  $result = mysql_query($sql); 
  
    return $result;  
	}
	
 /**
   *  @Method       insert
   *  @Description		Default Implementation of update Query
   */ 
	function insert($table, $arrColumn){
			//echo "Class Database: insert(): <br><br>"; die;
			$comma1 = '';//Put after the field name
			$comma2 = '';//Put after the field value
	
			foreach($arrColumn as $key=>$value) {
					//table field
					$column .= $comma1.$key;
					$comma1 = ', ';
				
					if(is_numeric($value)){
							$fieldValue .= $comma2."'".$value."'";
					}
					elseif($value == 'now()') {
							$fieldValue .= $comma2.$value;
					}
					else{
							$fieldValue .= $comma2.'"'.$value.'"';
					}
					$comma2 = ', ';
			}
						
			$sql = 'INSERT INTO '.$table.' ('.$column.') VALUES ('.$fieldValue.');';
			//echo "Class Database: insert(): $sql<br><br>"; //die;
				
			$result = mysql_query($sql);
			return $result;
	}

 /**
  *  @Method       delete
  *  @Description		Default Implementation of delete Query
  */ 
	function delete($table, $where){
	  //echo "Class Database: delete(): <br><br>"; die;	
	  
		 $sql = 'UPDATE '.$table.'  SET isDelete = 1 where '.$where.";";
		 //echo "Class Database: delete(): $sql<br><br>"; die;	
		 $result = mysql_query($sql);
		 return $result;
	}
	
	 /**
  *  @Method       delete
  *  @Description		Default Implementation of delete Query
  */ 
	function deleteRecord($table, $where){
	  //echo "Class Database: delete(): <br><br>"; die;	
	  
		 $sql = 'DELETE FROM '.$table.' where '.$where.";";
		 //echo "Class Database: delete(): $sql<br><br>"; die;	
		 $result = mysql_query($sql);
		 return $result;
	}

}/*Class Database Ends*/
?>