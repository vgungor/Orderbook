<?php
	include_once 'connection.php';
	$last_id=db2_last_insert_id($db_connect);
	echo $last_id; 
	
?>