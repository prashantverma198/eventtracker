<?php
include_once 'config.php';
include_once 'classes/class.event.php';
$obj =  new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
$eventList = $obj->getEventListById($_GET['eId']);
if($eventList) {
	extract($eventList[0]);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AD2C Campaign</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/themes/hot-sneaks/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui-timepicker-addon.css" />
<script>
	$(function() {
		$( "#datePicker1" ).datetimepicker({
					dateFormat: 'yy-mm-dd',
					showSecond: true,
					timeFormat: 'hh:mm:ss'
			});
			
			$( "#datePicker2" ).datetimepicker({
					dateFormat: 'yy-mm-dd',
					showSecond: true,
					timeFormat: 'hh:mm:ss'
			});
			
			
	});
	</script>
</head>
<body>
	<div class="container">
    	<div class="logo"><img border="0" src="images/logo.png" /></div>
        <!--Left Side-->
        <?php $sidebar = "Event"; include_once 'xsidebar.php'; ?>
        <!--Right Side-->
        <div class="right">
        	<div> <h1>Add Event</h1></div>
         <div class="cam_nav">
             <ul>		
             <li class="cam_nav_select"><a href="event.php"><strong>Events</strong></a></li>
             <li class=""><a href="template_design.php?eId=<?php echo $_GET['eId']?>"><strong>Form</strong></a></li>		
             <li class=""><a href="assign_event.php?eId=<?php echo $_GET['eId']?>"><strong>Assign User</strong></a></li>	
             </ul>
           </div>
          <div class="formDiv"><br />
                <form action="handler.php" method="post" name="frmLoginForm">
                	<table cellpadding="0" cellspacing="0" border="0">
                    	<tr>
                        	<td>Event Name: </td>
                         <td><input class="input" name="eName" required type="text" value="<?php echo $eName; ?>"/> </td>
                        </tr>
                        
                        <tr>
                        	<td>Event Start Date:  </td>
                         <td><input id="datePicker1" name="eStartDate" class="input" value="<?php echo $eStartDate; ?>"/></td>
                        </tr>
                        <tr>
                        	<td>Event End Date:  </td>
                         <td><input id="datePicker2" name="eEndDate" class="input" value="<?php echo $eEndDate; ?>"/></td>
                        </tr>
                        <tr>
                        	<td>Location:  </td>
                         <td><input name="location" class="input" value="<?php echo $location; ?>"/></td>
                        </tr>
                        <tr>
                        	<td>Description:  </td>
                         <td><textarea name="description" class="input" style="height:100px !important" ><?php echo $description; ?></textarea></td>
                        </tr>
                        <tr>
                        	<td>&nbsp; </td>
                         <?php
																														if($eId) { 
																																	$value = "Update";
																																	$t = "updateEvent";
																														}
																														else {
																																	$value = "Add";
																																	$t = "addEvent";
																														}
                         ?>
                            <td>
                            <input type="hidden" name="eId" value="<?php echo $eId; ?>" /> 
                             <input type="hidden" name="t" value="<?php echo $t; ?>" height="40px" /> 
                            <input class="input_butt" value="<?php echo $value; ?>" name="btnSubmit" type="submit" / >
                            <input class="input_butt" type="button" value="Cancel" onclick="window.location.href='event.php'" / >  
                            </td>
                        </tr>
                        
                    </table>
                	 
            </form>
            
            </div>
            
        </div>
        <div style="background:#000; width:100%; height:50px; float:left"> </div>
    </div>
</body>
</html>
