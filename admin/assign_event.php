<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AD2C</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
include_once 'config.php';
include_once 'classes/class.user.php';
include_once 'classes/class.event.php';
$obj =  new User(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
$objE = new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
$userDetailArr = $obj->getUserList();
$listUserArr = $objE->getEventDetailById($_GET['eId']);
if($listUserArr) {
		foreach($listUserArr as $value) {
				$uNameArr[]= $value['uId'];
		}
}

?>
	<div class="container">
    	<div class="logo"><img border="0" src="images/logo.png" /></div>
        <!--Left Side-->
        <?php $sidebar = "Event"; include_once 'xsidebar.php'; ?>
         <?php echo displaySessMsg(); ?>
        <div class="right">
        	<div> <h1>Assign User</h1></div>
         <div class="cam_nav">
             <ul>		
             <li class=""><a href="event.php"><strong>Events</strong></a></li>
             <li class=""><a href="template_design.php?eId=<?php echo $_GET['eId']?>"><strong>Form</strong></a></li>		
             <li class="cam_nav_select"><a href="assign_event.php?eId=<?php echo $_GET['eId']?>"><strong>Assign User</strong></a></li>	
             </ul>
           </div>

          <div class="formDiv"><br />
                <form action="handler.php" method="post" name="frmAssignEvent">
                	<table cellpadding="0" cellspacing="0" border="0" width="50%">
                  <tr style="background:url(images/table_head_bg.png) top left repeat-x; height:31px; color:#ffffff;">
                  	<td width="50%" style="text-align:center !important">User</td>
                 </tr>
                 <tr>
                     <td>
                     				<div class="inner_t">
                         <table class="none_b">
                         <?php
																									     foreach($userDetailArr as $value) { ?>
					                     					<tr>
                               			<td align="center">
                                  <input type="checkbox" name="uName[]" value="<?php echo $value['uId']; ?>" 
																																				<?php if(@in_array($value['uId'], $uNameArr)) { ?> checked="checked"<?php } ?> />
                               							<?php echo $value['name']; ?>
                                  </td>
                               </tr>
                         <?php } ?>      
                         </table>
                         </div>
                     </td>
                 </tr>
                 <tr>
                 <td colspan="2" style="text-align:center !important">
                    <input type="hidden" name="t" value="assign" />
                    <input type="hidden" name="step" value="<?php echo $_GET['step']?>" />
                    <input type="hidden" name="eId" value="<?php echo $_GET['eId']; ?>" />
                 			<input type="submit" name="submit" value="Assign"  />
                 			<input type="button" name="cancel" value="Cancel" /></td>
                 </tr>
            </table>
                	 
            </form>
            
            </div>
            
        </div>
        <div style="background:#000; width:100%; height:50px; float:left"> </div>
    </div>
</body>
</html>
