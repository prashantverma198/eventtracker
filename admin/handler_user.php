<?php
include_once 'config.php';
include_once 'classes/class.user.php';

if($_POST['btnSubmit']) {
	
			$t = $_POST['t'];
   $objUser = new User(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
			
	switch($t) {
					case "Login":
							$result = $objUser->doUserLogin($_POST);
							$type = $result[0]['user_type'];
							$uId  = $result[0]['uId'];
							if($result != lOGIN_ERROR) {
								  if($type==1) {
												setSuccessMsg(LOGIN_OK);
												header('location: event.php');
										}
										else {
												setSuccessMsg(LOGIN_OK);
												header('location: ../eventlist.php?uId='.$uId);
										}
							}
							else {
									setErrorMsg($result);
									header('location: ../index.html');
							}
					break;
					
					case "addUser":
								$result = $objUser->addUser($_POST);
								if($result == USER_ADD_SUCCESS) {
										setSuccessMsg($result);
										header('location: user.php');
							}
							else {
									setErrorMsg($result);
									header('location: user_detail.php');
							}
					break;
					
					case "updateUser":
					   $uId = $_POST['uId'];
								$result = $objUser->updateUser($_POST);
								if($result == USER_UPDATE_SUCCESS) {
										setSuccessMsg($result);
										header('location: user.php');
							}
							else {
									setErrorMsg($result);
									header('location: user_detail.php?uId='.$uId);
							}
					break;
		}
}
else {
}
?>