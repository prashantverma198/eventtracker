<?php
include_once 'config.php';
include_once 'classes/class.event.php';
$objE = new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
$eventList = $objE->getEventList();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Event Tracker</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="http://yui.yahooapis.com/3.7.3/build/yui/yui.js"></script>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/RGraph.common.core.js"></script>
<script type="text/javascript" src="js/RGraph.bar.js"></script>
<script type="text/javascript">
$(function(){
			callAJAX();
})
function callAJAX() {
	var selectVal = $('select[name=event]').val();
	$.get('active.php?eId='+selectVal, function(data){
			$('#result').html(data);
	});
}

function downloadReport() {
			window.location.href="handler.php?t=downloadReport"
}
</script>
<!--<script type="text/javascript">
var hbtempl = null;

function callAJAX() {

YUI().use("io", "handlebars", "json", function(Y) {
    var uri = "active.php";
				var select = Y.one('#event');
				var optionValue = select.get("value");

				var cfg = {
    		method: 'POST',
   		 data: 'eId='+optionValue,
    		headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
						on: {
								success: function(id, o, args) {
        		var data = o.responseText;
										if(!hbtempl) {
													hbtempl = Y.Handlebars.compile(Y.one('#table_result').getHTML());
										}
										
										data = Y.JSON.parse(data);
										data.tbl_id = "result_" + ~~(Math.random() * 20000);
										html = hbtempl(data);
										//alert('HTML eo emit: ' + html);
										//alert('HTML to emit: ' + Y.JSON.stringify(Y.JSON.parse(data)));
										Y.one('#result').set('innerHTML', html);
									//	Y.log('Canvas: ' +, 'warn');
									//var canvasId =  '#result_' + data.tbl_id + ' canvas';
									//var canvasElement = Y.one(canvasId)._node;
									var bar = new RGraph.Bar('graph_' + data.tbl_id, data.lead);//Y.JSON.parse('[' + data.lead + ']'));
									bar.Set('chart.labels', data.user);//Y.JSON.parse('[' + data.user + ']'));
									bar.Set('chart.ymin', 0);
									bar.Draw();
    		 	}
					 }
				}
    var request = Y.io(uri, cfg);
	});
}
</script>
<script type="text/x-handlebars-template" id="table_result">
	<table cellpadding="0" cellspacing="0" border="0" width="97%">
	<tr style="background:url(images/table_head_bg.png) top left repeat-x; height:31px; color:#ffffff;">
		<td width="50%" align="center">User</td>
		<td width="50%">Lead</td>
	</tr>
		{{#result}}
	<tr style="background:url(images/table_detail_bg.png) top left repeat-x; height:29px; color:#484343;">
	<td width="50%" align="center">{{{name}}}</td>
	<td width="50%">{{{leads}}}</td>
	</tr>
	 {{/result}}
	</table>
	<table cellpadding="0" cellspacing="0" border="0" width="97%" id="result_{{tbl_id}}">
	<tr>
	<td>
	<canvas width="600" height="250" id="graph_{{tbl_id}}">[No canvas support]</canvas>
	</td>
	</tr>
	</table>
</script>		-->
<style type="text/css">
body {
    font-family: Arial;
}

pre.code {
    display: block;
    border-radius: 15px;
    border: 1px dashed #aaa;
    padding: 5px;
    background-color: #eee;
}
</style>
</head>
<body>
	<div class="container">
    	<div class="logo"><img border="0" src="images/logo.png" /></div>
        <!--Left Side-->
        <?php $sidebar = "Analytics"; include_once 'xsidebar.php'; ?>
        <!--Right Side-->
        <div class="right">
        	<div> <h1 style="font-size:48px;">Analytics</h1>
            	
            </div>
                <br />
            <table class="filter" cellpadding="0" cellspacing="0" border="0">
            	<tr>
                	<td style="text-align:left !important">
                    	<form action="" method="post">
                        <select name="event" id="event">
                         <?php $i=0;
																									     foreach($eventList as $val) {?>
                              <option value="<?php echo $val['eId']; ?>" <?php if($i==0) { ?> selected="selected"<?php } ?>><?php echo $val['eName']; ?></option>
                         <?php
																									     $i++; 
																														}
																														?>
                        </select>
                        <input type="button" name="submit" value="Go" onclick="callAJAX()" />
                        </form>
                    </td>
                 <td style="text-align:right !important">
                        <select name="report" id="event" onchange="downloadReport();">
                        	<option value="">Download Report</option>
                         <option value="download">Lead Report</option>
                        </select>
                        </form>
                    </td>   
                </tr>
            </table><br />
            <div id="result"></div>
        </div>
        <div style="background:#000; width:100%; height:50px; float:left"> </div>
    </div>
</body>
</html>
