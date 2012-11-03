<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AD2C Audit & Activation Client</title>
<link href="common/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
<div class="header">
  <div><a href="home.html"><img src="common/images/ad2c_logo-new1.png" border="0" align="left"></a></div>  
</div>

<div class="content">
<form class="loginform" align="left" method="post" action="admin/handler_user.php">
		<ul style="margin-top:20px; list-style-type:none;">
						<li>
						  <label>USER ID</label><br/>
						  <input type="text" name="uName" placeholder="mymail@mail.com"/><br/><br/>
						</li>
						<li>
						  <label>PASSWORD</label><br/>
						  <input type="password" name="password"/><br/><br/><br/>
						</li>
      <input type="hidden" name="t" value="Login"  />
				  <input type="submit" name="btnSubmit" value="Login" class="submitbutton"/>
		</ul>
</form>
</div>  

<br />
<div class="footer">
  <div align="center" class="footer_nav"><small>© 2012 AD2C</small></div>
</div>
</div>			
</body>
</html>
