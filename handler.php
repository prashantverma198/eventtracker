<?php
switch($_REQUEST['t']){
 		
case "xGetEventList":
  include_once 'config.php';
  include_once 'admin/classes/class.event.php';
		include_once 'admin/classes/class.user.php';
		
  $objE = new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
		$eventArr = $objE->getEventListByUserId($_GET['uId']);
		
		$objU = new User(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
		$resultArr = $objU->getUserDetailById($_GET['uId']);  
				
		if($eventArr) {
		  $response .= sprintf('<option value="%s">%s</option>', 0, "Select Event");
				foreach($eventArr as $event) { 
						$response .= sprintf('<option value="%s">%s</option>', $event['eId'], $event['eName']);
				}
		}
		$response = array("event"=>$response, "name"=>$resultArr[0]['name']);
  print_r(json_encode($response)); 
		die;
  break;		

	
case "xGetEventForm":
  include_once 'config.php';
  include_once 'admin/classes/class.saveForm.php';
		$obj = new saveData(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
		$eId = $_REQUEST['eId'];
		$uId = $_REQUEST['uId'];
		$formData = $obj->getFormById($eId);
  $unserialisedFormArr = unserialize(base64_decode($formData[0]['data']));
		$count = count($unserialisedFormArr);
		$response = '<form id="saveform" class="saveform" align="left">';
		$response .= '<ul>';
		for($i=0; $i<$count; $i++){
				$response .= '<li>';
				$response .= '<label>'.ucfirst(strtolower($unserialisedFormArr[$i]['label'])).'</label><br/>';
				$response .= $unserialisedFormArr[$i]['field'];
				$response .= '</li><br/>';
			}
			$response .= '</ul>';
			$response .= sprintf('<input type="hidden" name="eId" value="%s" />', $eId);
			$response .= sprintf('<input type="hidden" name="uId" value="%s" />', $uId);
			$response .= sprintf('<input type="hidden" name="t" value="%s" />', "xSubmitEventForm");
			$response .= '<input type="button" name="submit" value="Save" class="submitbutton" onclick="onSaveForm();"/>'; 
			$response .= '</form>'; 
		
			print_r($response); die;
 break;	  

case "GetUserDetail":
    include_once 'config.php';
				include_once 'admin/classes/class.user.php';
				$objU = new User(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
				$resultArr = $objU->getUserDetailById($_GET['uId']);  
default:
  break;
		
case "SubmitEventForm":
  include_once 'config.php';
  include_once 'admin/classes/class.saveForm.php';
		$obj = new saveData(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
		$eId = $_REQUEST['eId'];
		$uId = $_REQUEST['uId'];
		$resultArr = $obj->saveEventFormData($uId, $eId, $_POST);
		header('location: thanks.html');
  break;

case "xSubmitEventForm":
  include_once 'config.php';
  include_once 'admin/classes/class.saveForm.php';
		$obj = new saveData(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
		$eId = $_REQUEST['eId'];
		$uId = $_REQUEST['uId'];
		$resultArr = $obj->saveEventFormData($uId, $eId, $_REQUEST);
		echo "done";
  break;
	
case "xPhotoUpload":
	print_r($_REQUEST);
break;
}

?>