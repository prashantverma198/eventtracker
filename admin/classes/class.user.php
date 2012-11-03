<?php
 Class User extends Database {
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
			function doUserLogin($argPostData) {
				
							$arrCols = array('uId', 'name', 'email', 'mobile_no', 'user_type');
							$where = sprintf('1 AND email="%s" AND password="%s"', $argPostData['uName'], base64_encode($argPostData['password']));
							$result = $this->select(TABLE_USER_PROFILE, $arrCols, $where);
							if($result) {
										return $result;
							}
							else {
										return 	false;
							}
			}			
					
		/**
			*  @Method       addUser
			*  @Description		Create new user.
			*/	
			function addUser($argPostData) {
				
							$arrCols = array('user_type'=>2, 
																								'name'=>$argPostData['uName'], 
																								'email'=>$argPostData['uEmail'],
																								'mobile_no'=>$argPostData['uMobile'],
																								'password'=>base64_encode($argPostData['uPwd']),
																								'creation_date'=>'now()',
																								'activated'=>1);
							$where = '1';
							$result = $this->insert(TABLE_USER_PROFILE, $arrCols, $where);
							if($result) {
										return USER_ADD_SUCCESS;
							}
							else {
										return USER_ADD_ERROR;
							}
			}
			
		/**
			*  @Method       getUserList
			*  @Description		get user list not admin.
			*/	
			function getUserList(){
						$arrCol = array('uId', 'name','email','mobile_no','password','gender','dob','city');
						$where = '1 AND user_type != 1';
						$resultArr = $this->select(TABLE_USER_PROFILE, $arrCol, $where);
						return $resultArr;
			}
			
					/**
			*  @Method       getUserList
			*  @Description		get user list not admin.
			*/	
			function getUserDetailById($uId){
						$arrCol = array('uId', 'name','email','mobile_no','password','gender','dob','city');
						$where = '1 AND uId ='.$uId;
						$resultArr = $this->select(TABLE_USER_PROFILE, $arrCol, $where);
						return $resultArr;
			}
			
								/**
			*  @Method       addUser
			*  @Description		Create new user.
			*/	
			function updateUser($argPostData) {
				
							$arrCols = array('user_type'=>2, 
																								'name'=>$argPostData['uName'], 
																								'email'=>$argPostData['uEmail'],
																								'mobile_no'=>$argPostData['uMobile'],
																								'password'=>base64_encode($argPostData['uPwd']),
																								'creation_date'=>'now()',
																								'activated'=>1);
							$where = '1 AND uId='.$argPostData['uId'];
							$result = $this->update(TABLE_USER_PROFILE, $arrCols, $where);
							if($result) {
										return USER_UPDATE_SUCCESS;
							}
							else {
										return USER_UPDATE_ERROR;
							}
			}
}
?>