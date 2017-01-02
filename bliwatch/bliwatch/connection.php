<?php
	$db = mysql_connect('localhost','psgteche_e360','cbe1234**');
	if($db){
	$db_select = mysql_select_db('psgteche_e360',$db);
	if(!$db_select){die;}
	}
	?>