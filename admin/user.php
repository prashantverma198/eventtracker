<?php
	include_once 'config.php';
	include_once 'classes/class.user.php';
	$obj =  new User(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
	$userList = $obj->getUserList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AD2C Campaign</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="container">
    	<div class="logo"><img border="0" src="images/logo.png" /></div>
        <!--Left Side-->
        <?php $sidebar = "User"; include_once 'xsidebar.php'; ?>
        <!--Right Side-->
        
        <div class="right">
        	<div style="width:100%;">
           <?php echo displaySessMsg(); ?> 
         		<h1>User</h1>
           <p><img border="0" src="images/add.png" /> &nbsp; <a href="user_detail.php" class="none"><u>Add New User</u></a></p>
         </div>
            <br />
           <br /> 
            <table cellpadding="0" cellspacing="0" border="0" width="97%">
            <?php
           							if($userList) {
            ?>
            	<tr style="background:url(images/table_head_bg.png) top left repeat-x; height:31px; color:#ffffff;">
                    <td width="15%"> Name</td>
                    <td width="20%"> Email</td>
                    <td width="10%"> Mobile No</td>
                    <td width="15%"> Edit </td>
                </tr>
             <?php
													      foreach($userList as $value) {
													?>   
                <tr style="background:url(images/table_detail_bg.png) top left repeat-x; height:29px; color:#484343;">
                    <td align="center"><?php echo $value['name']; ?></td>
                    <td align="center"><?php echo $value['email']; ?></td>
                    <td align="center"><?php echo $value['mobile_no']; ?></td>
                    <td align="center"><a href="user_detail.php?uId=<?php echo $value['uId']; ?>"><img src="images/edit.png" /></a></td>
                </tr>
                <?php
																			  }
																		}
																		else {
																		?>
                  <tr><td style="text-align:left !important">Sorry!! No Record Found.</td></tr>
                  <?php
																		}
																		?>
                
            </table>
        </div>
        <div style="background:#000; width:100%; height:50px; float:left"> </div>
    </div>
</body>
</html>
