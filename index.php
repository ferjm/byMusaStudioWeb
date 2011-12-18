<?php

function body() {
	function customBody() {
		echo '  <body class="bleed left webkit white">';
		echo '    <img src="images/back1.jpg" id="bg">';
	}
	// Random background number
	$random_background = rand(0,8);
	// Gets the background db entry
	include_once('mysql/mysql.class.php');
	$db = new Database();
	if ($db->connect()) {
		if ($db->select(DB_Config::BACKGROUNDS_TABLE,'*','id='.$random_background)) {
			$background = $db->getResult();
			if(is_array($background)) {
				if ((isset($background['path'])) &&
				(isset($background['style'])) &&
				(isset($background['black'])) &&
				(isset($background['left']))) {
					if ($background['black']) {
						$color = 'black';
					} else {
						$color = 'white';
					}
					if (!$background['left']) {
						$position = 'right';
					} else {
						$position = '';
					}
					echo '  <body class="bleed left '.$position.' webkit '.$color.'">';
					echo '    <img src="'.$background['path'].'" id="bg">';
				} else {
					customBody();
				}
			} else {
				customBody();
			}
		} else {
			customBody();
		}
	} else {
		customBody();
	}	
}

include 'html/head.inc.html';
body();
include 'html/layout.inc.html';
include 'html/footer.inc.html';
?>
