<?php
include_once 'config.php';
include_once 'classes/class.user.php';
$obj =  new User(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
$userDetailArr = $obj->getUserDetailById($_GET['uId']);
if($userDetailArr) {
	extract($userDetailArr[0]);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AD2C</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.16/themes/hot-sneaks/jquery-ui.css" />
<script>
	$(function() {
		$( "#datePicker" ).datepicker({
					dateFormat: 'yy-mm-dd'
			});
});

function validateForm() {
		var pwd = $('input[name=uPwd]').val();
		var cpwd = $('input[name=uCofmPwd]').val();
		if(pwd != cpwd) {
				alert('Password do not match.');
				return false;
		}
		return true;
}
	</script>
 
</head>
<body>
<?php
include_once 'config.php';
include_once 'classes/class.user.php';
$obj =  new User(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
$userDetailArr = $obj->getUserDetailById($_GET['uId']);
if($userDetailArr) {
	extract($userDetailArr[0]);
}
?>
	<div class="container">
    	<div class="logo"><img border="0" src="images/logo.png" /></div>
        <!--Left Side-->
        <?php $sidebar = "User"; include_once 'xsidebar.php'; ?>
        <!--Right Side-->
        <div class="right">
        	<div> <h1>Add User</h1></div>
          <div class="formDiv"><br />
                <form action="handler_user.php" method="post" name="frmLoginForm" onsubmit="return validateForm();">
                	<table cellpadding="0" cellspacing="0" border="0">
                    	<tr>
                        	<td>Name: </td>
                         <td><input class="input" name="uName" type="text" value="<?php echo $name; ?>"/> </td>
                        </tr>
                        
                        <tr>
                        	<td>Email:  </td>
                         <td><input type="email"  name="uEmail" class="input" value="<?php echo $email; ?>"/></td>
                        </tr>
                        <tr>
                        	<td>Mobile No:  </td>
                         <td><input type="text" name="uMobile" class="input" value="<?php echo $mobile_no; ?>" maxlength="10"/></td>
                        </tr>
                        <tr>
                        	<td>Password:  </td>
                         <td><input name="uPwd" class="input" value="<?php echo base64_decode($password); ?>" type="password"/></td>
                        </tr>
                        <tr>
                        	<td>Confirm Password:  </td>
                         <td><input type="password" name="uCofmPwd" class="input" value="<?php echo base64_decode($password); ?>" /></td>
                        </tr>
                        <tr>
                        	<td>&nbsp; </td>
                         <?php
																														if($uId) { 
																																	$value = "Update User";
																																	$t = "updateUser";
																														}
																														else {
																																	$value = "Add User";
																																	$t = "addUser";
																														}
                         ?>
                            <td>
                            <input type="hidden" name="uId" value="<?php echo $uId; ?>" /> 
                             <input type="hidden" name="t" value="<?php echo $t; ?>" height="40px" /> 
                            <input class="input_butt" value="<?php echo $value; ?>" name="btnSubmit" type="submit" / >
                            <input class="input_butt" type="button" value="Cancel" onclick="window.location.href='user.php'" / >  
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
