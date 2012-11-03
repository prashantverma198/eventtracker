<?php
include_once 'config.php';
include_once 'classes/class.event.php';
$obj =  new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
$template = $obj->getTemplateById($_GET['eId']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AD2C Campaign</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script src="http://yui.yahooapis.com/3.7.3/build/yui/yui-min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
</head>
<body>
	<div class="container">
    	<div class="logo"><img border="0" src="images/logo.png" /></div>
        <!--Left Side-->
        <?php $sidebar = "Event"; include_once 'xsidebar.php'; ?>
         <?php echo displaySessMsg(); ?>
        <div class="right">
        	<div> <h1>Add Event</h1></div>
         <div class="cam_nav">
             <ul>		
             <li class=""><a href="event.php"><strong>Events</strong></a></li>
             <li class="cam_nav_select"><a href="template_design.php?eId=<?php echo $_GET['eId']?>"><strong>Form</strong></a></li>		
             <li class=""><a href="assign_event.php?eId=<?php echo $_GET['eId']?>"><strong>Assign User</strong></a></li>	
             </ul>
           </div>
          <div class="formDiv"><br />
                <form action="handler.php" method="post" name="frmLoginForm">
                <table cellpadding="0" cellspacing="0" border="0" class="mainTable" id="lastRow">
                <?php if($template) { 
																        $data = unserialize(base64_decode($template[0]['data']));
																								$count = count($data);
                        $i=0; 
																								foreach($data as $v) {
																								if(!preg_match('/[^a-z]/i', $v['type'])) {	 
																												if($i==0) { ?>
																														<tr>
																													<td>Field: </td>
																													<td>
																																		<select name="frmField[]" class="input">
																																		<option value="">Choose Field</option>
																													<?php foreach($formField as $key=>$value) {
																																			if($key == trim($v['type'])) {  $var = 'selected="selected"'; } else { $var =''; }?>
																																					<option value="<?php echo $key; ?>" <?php echo $var; ?>><?php echo $value; ?></option>
																													<?php } ?>        
																																	</select>
																														</td>
																												</tr>
																														<tr>
																													<td>Label:  </td>
																													<td><input type="text" name="label[]" value="<?php echo $v['label']; ?>" class="input" /></td>
																												</tr>
																														<tr>
																													<td>Value:  </td>
																													<td><input type="text" name="value[]" value="<?php echo $v['value']; ?>" class="input" /></td>
																												</tr>
																												<?php
																																}
																																else { ?>
																																<tr id="table<?php echo $i; ?>">
																																		<td colspan="2">
																																				<table class="addtable" id="m_none">
																																							<tr><td colspan="2" style="text-align:right!important">
																																											<a href="#" class="remove" rel="table<?php echo $i; ?>" onclick="return removeFiled(this.rel);">
																																													<img src="images/close.gif" title="close" width="16px" height="16px"/>
																																											</a>
																																									</td>
																																							</tr>
																																							<tr>
																																									<td>Field: </td>
																																									<td>
																																														<select name="frmField[]" class="input">
																																														<option value="">Choose Field</option>
																																									<?php foreach($formField as $key=>$value) {
																																															if($key == trim($v['type'])) {  $var = 'selected="selected"'; } else { $var =''; }?>
																																																	<option value="<?php echo $key; ?>" <?php echo $var; ?>><?php echo $value; ?></option>
																																									<?php } ?>        
																																													</select>
																																										</td>
																																						</tr>
																																							<tr>
																													<td>Label:  </td>
																													<td><input type="text" name="label[]" value="<?php echo $v['label']; ?>" class="input" /></td>
																												</tr>
																																							<tr>
																													<td>Value:  </td>
																													<td><input type="text" name="value[]" value="<?php echo $v['value']; ?>" class="input" /></td>
																												</tr>
																																				</table>
																																			</td>
																																	</tr> 
																												<?php     	
																																	}
																																	$i++;
																								      }
																								   }
																										?>
                      
                <?php } else { ?>
                							
                    	<tr>
                        	<td>Field: </td>
                         <td><select name="frmField[]" class="input">
                              <option value="">Choose Field</option>
                              <option value="text">Text</option>
                              <option value="email">Email</option>
                              <option value="mobile">Mobile</option>
                              <option value="select">Select</option>
                              <option value="textarea">Textarea</option>
                              <option value="radio">Radio</option>
                              <option value="checkbox">Checkbox</option>
                             </select>
                          </td>
                        </tr>
                        
                        <tr id="select" style="display:none">
                        	<td>Option Value:  </td>
                         <td><textarea name="option[]" class="textarea" rows="20"></textarea></td>
                        </tr>
                        <tr>
                        	<td>Label:  </td>
                         <td><input type="text" name="label[]" value="" class="input" /></td>
                        </tr>
                        <tr>
                        	<td>Value:  </td>
                         <td><input type="text" name="value[]" value="" class="input" /></td>
                        </tr>
                <?php } ?>	
                <tr class="addmore">
                        	<td>&nbsp; </td>
                            <td> 
                              <input type="hidden" name="t" value="createForm" />
                              <input type="hidden" name="step" value="<?php echo $_GET['step']?>" />
                              <input type="hidden" name="event" value="<?php echo $_GET['eId']?>" />
                            		<input class="input_butt" value="Save" name="btnSubmit" type="submit" / >
                            		<input class="input_butt" type="button" value="Cancel" / >
                              <input type="button" name="add" value="Add More" align="right" id="add" class="input_butt" />  
                            </td>
                        </tr>
                </table>         
            </form>
            </div>
        </div>
        <div style="background:#000; width:100%; height:50px; float:left; margin-top:50px;"> </div>
    </div>
</body>
</html>
