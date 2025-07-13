<?php
	
	$mysqli->query("CREATE TABLE IF NOT EXISTS `boom_bot_data` (
					  `id` int(10) NOT NULL AUTO_INCREMENT,
					  `reply` varchar(1000) NOT NULL,
					  `view` int(1) NOT NULL DEFAULT '0',
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
					
	$mysqli->query("ALTER TABLE setting ADD boom_bot_delay int(4) NOT NULL DEFAULT '300'");
	$mysqli->query("ALTER TABLE setting ADD boom_bot_status int(1) NOT NULL DEFAULT '0'");
	$mysqli->query("ALTER TABLE setting ADD boom_bot_time int(10) NOT NULL DEFAULT '0'");
	$mysqli->query("ALTER TABLE setting ADD boom_bot_name varchar(20) NOT NULL DEFAULT 'Boombot'");
	$mysqli->query("ALTER TABLE setting ADD boom_bot_type int(1) NOT NULL DEFAULT '1'");
	$mysqli->query("ALTER TABLE setting ADD boom_bot_room int(1) NOT NULL DEFAULT '1'");


?>