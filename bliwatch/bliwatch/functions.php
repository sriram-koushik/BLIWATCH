<?php function confirm_query($result){if(!$result){
 die("Database not connected ".mysql_error());}}
function mysql_prep($value){
	$magic_quotes_active = get_magic_quotes_gpc(); 
	$new_enough_php = function_exists("mysql_real_escape_string"); 
	if($new_enough_php){
		if($magic_quotes_active){
			$value = stripslashes($value);} 
			$value = mysql_real_escape_string($value);} 
		else{
			if(!$magic_quotes_active){
				$value = addslashes($value);
			}
		}return $value; 
	} 
?>