<?php
  include_once 'config.php';
  include_once 'admin/classes/class.saveForm.php';
		$obj = new saveData(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
		$formData = $obj->getFormById($_POST['event']);
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AD2C Event Tracker</title>
<link href="common/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="common/js/jquery-1.7.2.js"></script>
</head>

<body onload="getEventForm();">
<div class="container">
<div class="header">
  <div><a href="home.html"><img src="common/images/ad2c_logo-new1.png" border="0" align="left"></a></div>  
</div>

<div class="content">
<div>Hi,&nbsp;&nbsp;<strong><label id="username"><?php echo $_POST['name']; ?></label></strong></div><br/><br/>
  <div class="formEvent" id="formEvent">
  <?php
  					$unserialisedFormArr = unserialize(base64_decode($formData[0]['data']));
							$count = count($unserialisedFormArr);
							?>
							<form class="eventform" action="handler.php" method="post">
       	<ul style="list-style-type:none">
        <?php 
													for($i=0; $i<$count; $i++){ ?>
        					<li>
             					<label>
																				<?php echo ucfirst(strtolower($unserialisedFormArr[$i]['label'])); ?></label><br/>
                    <?php echo $unserialisedFormArr[$i]['field']; ?>
             </li><br />
        <?php 
													}
										 ?>
        </ul><br /><br />
       <input type="hidden" name="eId" value="<?php echo $_POST['event']; ?>" /> 
       <input type="hidden" name="uId" value="<?php echo $_POST['uId']; ?>" /> 
       <input type="hidden" name="t" value="SubmitEventForm" /> 
       <input type="submit" name="submit" value="Save" class="submitbutton" /> 
       </form>

  </div><br/>  
</div>  

<br />
<div class="footer">
  <div align="center" class="footer_nav"><small>© 2012 AD2C</small></div>
</div>
</div>			
</body>
</html>
