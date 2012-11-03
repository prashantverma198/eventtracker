<?php
 Class Event extends Database {
		/**
			*  @Method       __construct
			*  @Description		Constructor methos for the class. Invoke the Database constructor as well
			*/	
			function __construct($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DB_SCHEMA) {
	    		parent::__construct($MYSQL_HOST,$MYSQL_USER,$MYSQL_PASSWORD,$MYSQL_DB_SCHEMA);
	  }
			
		/**
			*  @Method       doUserLogin
			*  @Description		Check user is exists in database and is user admin.
			*/	
			function addEvent($argPostData) {
				
							$arrCols = array('eName' =>$argPostData['eName'], 
																								'eStartDate'=>$argPostData['eStartDate'], 
																								'eEndDate'=>$argPostData['eEndDate'],
																								'location'=>$argPostData['location'], 
																								'description'=>$argPostData['description'], 
																								'createDate'=>'now()', 
																								'modifyDate'=>'now()'
																								);
							$where = '1';
							$result = $this->insert(TABLE_EVENT, $arrCols, $where);
							if($result) {
										return ENENT_ADD_SUCCESSFULLY;
							}
							else {
										return 	ENENT_ADD_ERROR;
							}
				
			}
			
			/**
			*  @Method       doUserLogin
			*  @Description		Check user is exists in database and is user admin.
			*/	
			function getEventList() {
					$arrCol = array('eId', 'eName', 'eStartDate','eEndDate','location', 'description');
					$where = '1';
					$result = $this->select(TABLE_EVENT, $arrCol, $where);
					return $result;
			}
			
		/**
			*  @Method       doUserLogin
			*  @Description		Check user is exists in database and is user admin.
			*/
			function getEventListById($cId) {
						$arrCol = array('eId', 'eName', 'eStartDate','eEndDate','location', 'description');
					$where = '1 AND eId='.$cId;
					$result = $this->select(TABLE_EVENT, $arrCol, $where);
					return $result;
			}
			
		/**
			*  @Method       updateEvent
			*  @Description		Update event Detail.
			*/
			function updateEvent($argPostData) {
					
					$arrCols = array('eName' =>$argPostData['eName'], 
																								'eStartDate'=>$argPostData['eStartDate'], 
																								'eEndDate'=>$argPostData['eEndDate'],
																								'location'=>$argPostData['location'], 
																								'description'=>$argPostData['description'],  
																								'modifyDate'=>'now()'
																								);
							$where = '1 AND eId='.$argPostData['eId'];
							
							$result = $this->update(TABLE_EVENT, $arrCols, $where);
							if($result) {
										return ENENT_ADD_SUCCESSFULLY;
							}
							else {
										return 	ENENT_ADD_ERROR;
							}
			}
			
					/**
			*  @Method       assignUser
			*  @Description		Assign User to the event.
			*/
			function assignUser($arrPostData) {
				
						$this->deleteAssignEvent($arrPostData['eId']); // for update case
						$uCount = count($arrPostData['uName']); // count user name
						for($i=0; $i<$uCount; $i++) {
													
													$arrCol = array('eId'=>$arrPostData['eId'],
													                'uId'=>$arrPostData['uName'][$i]
																													);
													$where = '1';
													$result = $this->insert(TABLE_ASSIGN_EVENT, $arrCol, $where);
						}
						if($result) {
									return ASSIGN_SUCCESSFULLY;
						}
						else {
							  return ASSIGN_ERROR;
						}
			}
			
						/**
			*  @Method       getAssignEventList
			*  @Description		Display list of event assign to the user.
			*/
			function getAssignEventList() {
										
				 $arrCol = array('assignId', 'eId','uId', 'uName', 'eName');
					$where = '1';
					$orderby = 'uName';
					$result = $this->select(TABLE_ASSIGN_EVENT, $arrCol, $where, '', $orderby);
					return $result;	
			}
			
			function getEventDetailById($eId) {
					
					$arrCol = array('assignId', 'eId','uId');
					$where = '1 AND eId='.$eId;
					$result = $this->select(TABLE_ASSIGN_EVENT, $arrCol, $where);
					return $result;	
			}
			
			function deleteAssignEvent($uId) {
					$where = '1 AND eId='.$uId;
					$result = $this->deleteRecord(TABLE_ASSIGN_EVENT, $where);
			}
			
			function getMaxEId() {
					$arrCol = array('MAX(eId) as eId');
					$where = '1';
					$result = $this->select(TABLE_EVENT, $arrCol, $where);
					return $result;
			}
			function getTemplateById($eId){
					$arrCol = array('eId', 'data');
					$where = '1 AND eId='.$eId;
					$result = $this->select(TABLE_FORM_DATA, $arrCol, $where);
					return $result;
			}
			function getEventListByUserId($uId) {
					$arrCol = array('event.eId', 'eName');
					$where = "1 AND uId=".$uId;
     $table =  TABLE_EVENT.' inner join '.TABLE_ASSIGN_EVENT.' on '.TABLE_EVENT.'.eId = '.TABLE_ASSIGN_EVENT.' .eId';
     $resultArr = $this->select($table, $arrCol, $where);
					return $resultArr;
			}
			
			function getLeadData($eId) {
						$arrCol = array('user_profile.name', 'count(lead_data) as leads');
						$where  = '1 AND '.TABLE_LEAD_STATS.'.publisher='.$eId;
						$table = TABLE_LEAD_STATS.' inner join '.TABLE_USER_PROFILE.' on '.TABLE_USER_PROFILE.'.uId ='.TABLE_LEAD_STATS.'.name';
						$groupby = TABLE_LEAD_STATS.'.name';
						$resultArr = $this->select($table, $arrCol, $where, $groupby);

      foreach($resultArr as $value) {

								$lead .= sprintf("$comma%s", $value['leads']);
								$user .= sprintf("$comma'%s'", $value['name']);
								$comma = ', ';
						}
						
      $responseArr['lead'] = $lead;
						$responseArr['user'] = $user;
						$responseArr['result'] = $resultArr;
						//print_r($responseArr);//die;
						return $responseArr;
			}
			
			 function getLeadReportData() {
					$arrCol = array('lead_data  as lead');
					$where = '1';
					$result = $this->select(TABLE_LEAD_STATS, $arrCol, $where);
					$i=0;
					foreach($result as $value) {
						
								$arr = explode('#', $value['lead']);
        foreach($arr as $v ){
											$arrV = explode('=', $v);
											$resonse[$i][$arrV[0] ? $arrV[0] : 'eId'] = $arrV[1] ? $arrV[1] : 0;
									$i++;		
					   }
								
			  }
					return $resonse;
			}
			
			

}
?>