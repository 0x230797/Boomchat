<?php
require_once("../../../system/config_min.php");
if(isset($_POST['embed_open']) && isset($_POST['embed_close']) && isset($_POST['embed_width1']) && isset($_POST['embed_margin'])
 && isset($_POST['embed_height1']) && isset($_POST['embed_color']) && isset($_POST['embed_text'])
 && isset($_POST['embed_type']) && $_POST['embed_type'] == '1' && isset($_POST['embed_side'])){
 
 $embed_open = $mysqli->real_escape_string(trim($_POST['embed_open']));
 $embed_close = $mysqli->real_escape_string(trim($_POST['embed_close']));
 $embed_width1 = $mysqli->real_escape_string(trim($_POST['embed_width1']));
 $embed_height1 = $mysqli->real_escape_string(trim($_POST['embed_height1']));
 $embed_color = $mysqli->real_escape_string(trim($_POST['embed_color']));
 $embed_text = $mysqli->real_escape_string(trim($_POST['embed_text']));
 $embed_margin = $mysqli->real_escape_string(trim($_POST['embed_margin']));
 $embed_side = $mysqli->real_escape_string(trim($_POST['embed_side']));
 
 if($embed_open == ''){
	$embed_open = "Open chat";
 }
 if($embed_close == ''){
	$embed_close = "Close chat";
 }
 if($embed_width1 == ''){
	$embed_width1 = '320px';
 }
 if($embed_height1 == ''){
	$embed_height1 = '480px';
 }
 if($embed_color == ''){
	$embed_color = '#222';
 }
  if($embed_text == ''){
	$embed_text = '#FFF';
 }
 if($embed_margin == ''){
	$embed_margin = '20px';
}
if($embed_side == ''){
	$embed_side = 'Right';
}
if($embed_side == 'Right'){
 $code2 = '<div id="corner_boom" value="' . $embed_close . '" style="height:' . $embed_height1 . '; width:' . $embed_width1 . '; right:' . $embed_margin . ';">
	<div style="background:' . $embed_color . '; height:33px;" id="corner_boom_top"><p id="corner_boom_title" style="color:' . $embed_text . ';">' . $embed_open . '</p>
	<a href="' . $setting['domain'] . '"><img src="' . $setting['domain'] . '/addons/boom_embed/images/boom_embed_expand.png"/></a></div>
	<div style="background:#000 url(\'' . $setting['domain'] . '/addons/boom_embed/images/loading.gif\')" id="corner_boom_content"><iframe name="' . $setting['domain'] . '/addons/boom_embed/execute/boom_embed_blank.php" id="corner_boom_iframe" value="' . $setting['domain'] . '/index.php" src=""></iframe></div>
	<script type="text/javascript" src="' . $setting['domain'] . '/addons/boom_embed/js/boom_embed.js"></script>
</div>';
}
if($embed_side == 'Left'){
 $code2 = '<div id="corner_boom" value="' . $embed_close . '" style="height:' . $embed_height1 . '; width:' . $embed_width1 . '; left:' . $embed_margin . ';">
	<div style="background:' . $embed_color . '; height:33px;" id="corner_boom_top"><p id="corner_boom_title" style="color:' . $embed_text . ';">' . $embed_open . '</p>
	<a href="' . $setting['domain'] . '"><img src="' . $setting['domain'] . '/addons/boom_embed/images/boom_embed_expand.png"/></a></div>
	<div style="background:#000 url(\'' . $setting['domain'] . '/addons/boom_embed/images/loading.gif\')" id="corner_boom_content"><iframe name="' . $setting['domain'] . '/addons/boom_embed/execute/boom_embed_blank.php" id="corner_boom_iframe" value="' . $setting['domain'] . '/index.php" src=""></iframe></div>
	<script type="text/javascript" src="' . $setting['domain'] . '/addons/boom_embed/js/boom_embed.js"></script>
</div>';

}
 
 
 $code1 = '<script type="text/javascript" src="' . $setting['domain'] .'/addons/boom_embed/js/jquery-1.11.2.min.js"></script>';
 $code3 = "1";
echo json_encode(
			array("code1" => $code1, "code2" => $code2, "code3" => $code3)
);
}
else if(isset($_POST['embed_width2']) && isset($_POST['embed_height2']) && $_POST['embed_type'] == '2'){
	$embed_width2 = $mysqli->real_escape_string(trim($_POST['embed_width2']));
	$embed_height2 = $mysqli->real_escape_string(trim($_POST['embed_height2']));
	
	if($embed_width2 == ''){
	$embed_width2 = '100%';
	}
	if($embed_height2 == ''){
	$embed_height2 = '100%';
	}
	
	$code1 = '<div style="width:' . $embed_width2 . '; height:' . $embed_height2 . ';"><iframe style="width:' . $embed_width2 . '; height:' . $embed_height2 . '; border:none;" src="' . $setting['domain'] . '/index.php"></iframe></div>';
	echo json_encode(
			array("code1" => $code1)
	);
}
else {
	echo 10;
}
?>