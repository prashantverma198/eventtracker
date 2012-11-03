<?php
$t = $_REQUEST['t'];
switch($t) {
	
	 case "createForm": 
		  $eId = $_POST['event'];
				$count = count($_POST['frmField']);
				$f = array('text','email');
				for($i=0; $i<$count; $i++) {
							$finalArray[$i]['type'] = $_POST['frmField'][$i];
							$finalArray[$i]['label'] = $_POST['label'][$i];
							$finalArray[$i]['name'] = 'frm'.$_POST['label'][$i];
							$finalArray[$i]['value'] = $_POST['value'][$i];
       
							//if filed is select then prepare option for the select
							if($_POST['frmField'][$i] == 'select') {
									$optionArr = explode(',', $_POST['value'][$i]);
									$str = sprintf('<select name="%s">', 'frm'.$_POST['label'][$i]);
									$str .= sprintf('<option value="">%s</option>', 'Please Select '.ucfirst(strtolower($_POST['label'][$i])));
									
									$c = count($optionArr);  //count total no of option in array
									for($j=0; $j< $c; $j++) {
											$str .=sprintf('<option value="%s">%s</option>', strtolower(trim($optionArr[$j])), ucfirst(strtolower($optionArr[$j]))); 
									}
									$str .= sprintf('</select>');
									
									$finalArray[$i]['field'] = $str;
							}
							elseif($_POST['frmField'][$i] == 'textarea') {
										$finalArray[$i]['field'] = sprintf('<textarea name="%s">%s</textarea>', $_POST['frmField'][$i].'2345', $_POST['value'][$i]);
							}
							elseif(@in_array($_POST['frmField'][$i], $f)) {
									$finalArray[$i]['field'] = sprintf('<input type="%s" name="%s" value="%s" onclick="if(this.value==\'%s\'){ this.value=\'\';}"
										onblur="if(this.value==\'\') { this.value=\'%s\'; }">',$_POST['frmField'][$i],'frm'.$_POST['label'][$i],$_POST['value'][$i], $_POST['value'][$i], 
										$_POST['value'][$i]);
							}
							else {
									$finalArray[$i]['field'] = sprintf('<input type="%s" name="%s" value="%s" >',$_POST['frmField'][$i],'frm'.$_POST['label'][$i],$_POST['value'][$i]);
							}
				}
				include_once 'config.php';
				include_once 'classes/class.saveForm.php';
				$step = $_POST['step'];
				$obj =  new saveData(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
				$result = $obj->saveForm($eId, $finalArray);
				if($result) {
					 if($step) {
							  setSuccessMsg($result);
									header('location: assign_event.php?eId='.$eId.'&step=2');
						}
						else {
							  setSuccessMsg($result);
									header('location: template_design.php?eId='.$eId);
						}
				}
				break;
				
				case "addEvent";
							include_once 'config.php';
							include_once 'classes/class.event.php';
							$obj =  new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
							$result = $obj->addEvent($_POST);
       if($result == ENENT_ADD_SUCCESSFULLY) {
								 $arrR = $obj->getMaxEId();
									$eId = $arrR[0]['eId'];
									setSuccessMsg($result);
						   header('location: template_design.php?eId='.$eId.'&step=2');
							}
							else {
									 setErrorMsg($result);
						    header('location: event_detail.php');
							}
							break;
				
							
				case "updateEvent";
							include_once 'config.php';
							include_once 'classes/class.event.php';
							$obj =  new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
							$result = $obj->updateEvent($_POST);
							$eId = $_POST['eId'];
       if($result == ENENT_ADD_SUCCESSFULLY) {
									setSuccessMsg($result);
						   header('location: event.php');
							}
							else {
									 setErrorMsg($result);
						    header('location: event_detail.php?eId='.$eId);
							}
							break;
									
				case "assign":
							include_once 'config.php';
							include_once 'classes/class.event.php';
							$step = $_POST['step'];
							$eId = $_POST['eId'];
							$obj =  new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
							$result = $obj->assignUser($_POST);
       if($result == ASSIGN_SUCCESSFULLY) {
								if($step) {
											setSuccessMsg($result);
						   		header('location: event.php');
								}
								else {
											setSuccessMsg($result);
						   		header('location: assign_event.php?eId='.$eId);
								}
							}
							else {
									 setErrorMsg($result);
						    header('location: assign_event.php?eId='.$eId);
							}
							break;
							
				case "xLogin":
      include_once 'config.php';
						include_once 'classes/class.user.php';
						$objU = new User(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
						$result = $objU->doUserLogin($_REQUEST);
						if($result){
							 echo $result[0]['uId'];
						}
						else {
								echo 0;
						}
					break;
					
			case "downloadReport":
			    include_once 'config.php';
							include_once 'classes/class.event.php';
							include_once 'classes/class.csv.php';
							$obj =  new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
							$lead = $obj->getLeadReportData();
					   // inset column name in result array so that it dispaly column name at top of the csv file.
				  	array_unshift($lead, $arrColName);
							$fileName = 'lead_Report';
					 	$objGenCSV = new csvManager($fileName);
						 $result = $objGenCSV->csvWrite($lead);
							header('location: '.$fileName.'.csv');					
			break;
			
			default :
			break;						
				
}
?>