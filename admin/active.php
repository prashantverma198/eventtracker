<?php
include_once 'config.php';
include_once 'classes/class.event.php';
$objE = new Event(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_SCHEMA);
$leadData = $objE->getLeadData($_REQUEST['eId']);
if(!$leadData) {
	echo "Sorry!!! No data found";
}
?>
<table cellpadding="0" cellspacing="0" border="0" width="97%">
<tr style="background:url(images/table_head_bg.png) top left repeat-x; height:31px; color:#ffffff;">
<td width="50%" align="center">User</td>
<td width="50%">Lead</td>
</tr>
<?php
					foreach($leadData['result'] as $value) {
?>
<tr style="background:url(images/table_detail_bg.png) top left repeat-x; height:29px; color:#484343;">
<td width="50%" align="center"><?php echo $value['name']; ?></td>
<td width="50%"><?php echo $value['leads']; ?></td>
<?php
					}
				?>
</tr>
</table>
<table cellpadding="0" cellspacing="0" border="0" width="97%">
<tr>
<td>
<canvas id="barChart" width="600" height="250">[No canvas support]</canvas>
<script>
			var bar = new RGraph.Bar('barChart', [<?php echo $leadData['lead']?>]);
			bar.Set('chart.labels', [<?php echo $leadData['user']?>]);
			bar.Set('chart.colors', ['#CC1111']);
			bar.Draw();
</script>
</td>
</tr>
</table>