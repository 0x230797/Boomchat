<?php	
if($user['user_rank'] > 4){
	$addons_title = str_replace('_', ' ', $list_icon['name']);
	echo "<div  id=\"" . $list_icon['name'] . "\" value=\"addon_panel_full\" class=\"addon_options other_panels\">
			<img  value=\"$addons_title\" src=\"addons/" . $list_icon['name'] . "/images/" . $list_icon['name'] . ".png\"/>
	</div>";
}
?>