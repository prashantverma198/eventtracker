<?php
/**
 * Copyright (c) 2012 AD2C INDIA PVT. LTD
 *	
 *
 * @package       AD2CAMPAIGN
 * @copyright     AD2C INDIA PVT. LTD
 * @author        Prashant Verma <prashant@ad2c.co>
 * @license       Proprietary
 * @Description    
 *                
 */
 
/**
 *  @function     setSuccessMessage
	*  @Description		Set Success Message in a SESSION
*/ 
function setSuccessMsg($msg) {
  $_SESSION['sessMsg'] = '<div style="color:green;">'.$msg.'</div>';
}

/**
 *  @function     setErrorMessage
	*  @Description		Set Error Message in a SESSION
*/ 
function setErrorMsg($msg) { 
  $_SESSION['sessMsg'] = '<div style="color:red;">'.$msg.'</div>';
}

/**
 *  @function     displaySessMsg
	*  @Description		Get Error/Success Message from SESSION. Make the session variable empty
*/ 
function displaySessMsg(){   
  $sessMsg = $_SESSION['sessMsg'];
  $_SESSION['sessMsg'] = '';	

  //Put a condition to Display Popup else dont display it		    		  
  if($sessMsg){
    return $sessMsg;
  }
  
  return false;
}

/**
 *  @function     formatDate
	*  @Description		Format the Date Option Selected in the Drop Down Box
*/
function formatDate($vardate, $sDate='', $eDate='', $cId='', $pName=''){
		switch($vardate){
				case "tdy":
				  $startDate = date("Y-m-d");
						$passDate = sprintf('left(datetime, 10) = "%s"', date("Y-m-d"));
						$dateArr = array($passDate, 'd');
						break;
		
				case "ystdy":
  				$startDate = date("Y-m-d", strtotime("-1 day"));
				  $passDate = sprintf('left(datetime, 10) = "%s"', $startDate);
						$dateArr = array($passDate, 'd');
						break;
		
				case "1m":
				  $startDate = date("Y-m-01", strtotime("-1 month"));
				  $passDate = sprintf('left(datetime, 10) >= "%s" and left(datetime, 10) <= "%s"', $startDate, date("Y-m-d"));
						$dateArr = array($passDate, 'm');
						break;
		
				case "2m":
				  $startDate = date("Y-m-01", strtotime("-2 month"));
				  $passDate = sprintf('left(datetime, 10) >= "%s" and left(datetime, 10) <= "%s"', $startDate, date("Y-m-d"));
						$dateArr = array($passDate, 'm');    
						break;
		
				case "3m":
				  $startDate = date("Y-m-01", strtotime("-3 month"));
				  $passDate = sprintf('left(datetime, 10) >= "%s" and left(datetime, 10) <= "%s"', $startDate, date("Y-m-d"));				  
						$dateArr = array($passDate, 'm');    
						break;
		
				case "cd":
				  $dateArr = formatCustomDate($sDate, $eDate);
						break;
			
			case "bd":
			   include('../config.php');
			   include_once('../campaign/classes/class.cBasicInfo.php');
						
      $objC = new CampaignBasicInfo(MYSQL_HOST,MYSQL_USER,MYSQL_PASSWORD,MYSQL_DB_SCHEMA);
						
      $campaignArr = $objC->getCampaignDetailById($cId); // get campaign start date
						$cDbDetail = $objC->getCampaignConfigDbDetail($cId);
						$cDbArr = $cDbDetail[0];
						
						// Recoonect to the current campaign .
      $objD = new Database($cDbArr['dbHost'], $cDbArr['dbUser'], $cDbArr['dbPassword'], $cDbArr['dbSchema']); 
                          
			   $startDate = $campaignArr[0]['cStartDate']; 
			   $dateArr = formatCustomDate($startDate, date("Y-m-d"));
                                                
						break;
						
				case "7w":
				default:
				  $startDate = date("Y-m-d", strtotime("-7 day"));
						$passDate = sprintf('left(datetime, 10) >= "%s" and left(datetime, 10) <="%s"', $startDate, date('Y-m-d'));
						$dateArr = array($passDate, 'w');  
						break;
		}
		return $dateArr;
}

/**
 *  @function     formatCustomDate
	*  @Description		Format the Custom Date Option Selected in the Drop Down Box
*/
function formatCustomDate($sdate, $edate) {

  $startDate = strtotime($sdate); 
  $endDate = strtotime($edate);
  $datediff = $endDate - $startDate; // Get total no of days between 2 days
  $days = floor($datediff/(60*60*24));

		if($days == 0) {
		    // if start date and end date is same.
						$passDate = sprintf('left(datetime, 10) = "%s"', $sdate);
						$dateArr = array($passDate, 'd');
		}
		elseif($days > 0 && $days < 15) {
			   // if start date and end date are less thean 2 weeks.
						$passDate = sprintf('left(datetime, 10) >= "%s" and left(datetime, 10) <= "%s"', $sdate, $edate);
						$dateArr = array($passDate, 'w');  
		}
		else {
						$passDate = sprintf('left(datetime, 10) >= "%s" and left(datetime, 10) <= "%s"', $sdate, $edate);
						$dateArr = array($passDate, 'm');
		}
 	return $dateArr;
}

/**
 *  @function     getdateRange
	*  @Description		Format the date that will display form whci date to which date graph has been plotted.
*/

function getdateRange($dateStr) {
	$dateArr = explode('"', $dateStr);
	if($dateArr[3]) {
			$dateRange = $dateArr[1].' to '.$dateArr[3];
	}
	else {
			$dateRange = $dateArr[1];
	}
	return $dateRange;
}	


?>