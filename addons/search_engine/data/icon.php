<?php	
// title that apear on the tool box
$addons_title = 'Search user';

if($user['user_rank'] > 0){
	echo "<div  id=\"" . $list_icon['name'] . "\" value=\"addon_panel_full\" class=\"addon_options other_panels\">
			<img  value=\"$addons_title\" src=\"addons/" . $list_icon['name'] . "/images/" . $list_icon['name'] . ".png\"/>
	</div>";
}
?>