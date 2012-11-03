<?php
 
Class saveData extends Database {
		/**
			*  @Method       __construct
			*  @Description		Constructor methos for the class. Invoke the Database constructor as well
			*/	
			function __construct($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DB_SCHEMA) {
	    		parent::__construct($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DB_SCHEMA);
	  }
			
			function saveForm($eId, $argPostData) {
				
				// delete previous data;
				$this->deleteFormData($eId);
				
				$data = serialize($argPostData);
				
				$arrCol = array('eId'=>$eId,
																				'data'=>base64_encode($data),
																				'createDate'=>'now()'  
																				);
				$where = '1';
				$result = $this->insert(TABLE_FORM_DATA, $arrCol, $where);
				return $result;																
			}
			
			/**
			*  @Method       getFormById
			*  @Description		Get form data by eventId
			*/	
			function getFormById($eId) {
					$arrCols = array('fId', 'eId', 'data');
					$where = '1 AND eId='.$eId;
					$result = $this->select(TABLE_FORM_DATA, $arrCols, $where);
					return $result;
			}
			
			/**
			*  @Method       __construct
			*  @Description		Constructor methos for the class. Invoke the Database constructor as well
			*/	
			function saveFormData() {
				$resultArr = $this->getForm();
			}
			
			/**
			*  @Method       deleteFormData
			*  @Description		Delete form by Event
			*/	
			function deleteFormData($eId) {
					$where = '1 AND eId='.$eId;
					$result = $this->deleteRecord(TABLE_FORM_DATA, $where);
			}
			
		/**
			*  @Method       __construct
			*  @Description		Constructor methos for the class. Invoke the Database constructor as well
			*/	
			function saveEventFormData($uId, $eId, $argPostData) {
						$resultArr = $this->getFormById($eId);
						$unserialisedFormArr = unserialize(base64_decode($resultArr[0]['data']));
	     foreach($unserialisedFormArr as $value) {
									$lead_data .= $hash.$value['label'].'='.$argPostData[$value['name']];
									$hash = '#';
						}
						$lead_data .= '#eId='.$eId;
						$arrCol = array('publisher'=>$eId, 'name'=>$uId, 'lead_data'=>$lead_data);
						$where = '1';
						$result = $this->insert(TABLE_LEAD_STATS, $arrCol, $where);
						return $result;

						
			}

}