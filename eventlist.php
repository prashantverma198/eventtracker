<?php
	include_once 'config.php';
	include_once 'admin/classes/class.event.php';
	include_once 'admin/classes/class.user.php';
	$objE = new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
	$objU = new User(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
	
	$eventArr = $objE->getEventListByUserId($_GET['uId']);

	$userArr = $objU->getUserDetailById($_GET['uId']);
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AD2C Audit & Activation Client</title>
<link href="common/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="common/js/jquery-1.7.2.js"></script>
</head>

<body>
<div class="container">
<div class="header">
  <div>
  					<a href="home.html">
       		<img src="common/images/ad2c_logo-new1.png" border="0" align="left">
       </a>
 </div>  
</div>
<div class="content">
  <div>Hi,&nbsp;&nbsp;<strong><label id="username"><?php echo $userArr[0]['name']; ?></label></strong></div><br/><br/>
  <?php if($eventArr) { ?>
  			<div class="selectEvent">Select Event</div><br/>
 			 <form name="frmEventList" action="eventform.php" method="post">
  <select name="event" class="selectEvent" id="selectEvent">
    <?php 
				     foreach($eventArr as $value) {  ?>
         	<option value="<?php echo $value['eId']; ?>"><?php echo $value['eName']; ?></option>
   <?php } ?>      
  </select><br/><br />
  <input type="hidden" name="name" value="<?php echo $userArr[0]['name']; ?>"  />
  <input type="hidden" value="<?php echo $_GET['uId']; ?>" name="uId" />
  <input type="submit" name="submit" value="Submit" class="submitbutton" /> 
  </form><br/>
					</div>
  <?php }  else { ?>
       <div class="selectEvent">Sorry!!! No event for today.</div><br/>
  <?php } ?>     

<br />
<div class="footer">
  <div align="center" class="footer_nav"><small>© 2012 AD2C</small></div>
</div>
</div>			
</body>
</html>
