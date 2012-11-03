		<?php
		//Show a Different Tab Menu Color On Selection of the Item
		switch($sidebar){
				case "Event":
							$event='nav_select';
							break;
				case "User":
							$user='nav_select';
							break;
				case "Analytics":
							$analytic='nav_select';
							break;
			}
		?>
<div class="nav_side">
    <div class="<?=$event?$event:$event='nav'?>"><p><a href="event.php" class="side">Event</a></p></div>
    <div class="<?=$user?$user:$user='nav'?>"><p><a href="user.php" class="side">User</a></p></div>
    <div class="<?=$analytic?$analytic:$analytic='nav'?>"><p><a href="analytic.php" class="side">Analytics</a></p></div>
    <!--<div class="nav"><p><a href="template.php" class="side">Template</a></p></div>-->
</div>