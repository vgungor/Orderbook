<?php
	$db_connect=mysqli_connect('localhost','root','','orderbook_v2_050518');
	mysqli_query($db_connect,"SET NAMES 'utf8'; SET CHARSET 'utf8'");
	//DB CONNECTION TEST
	/*
	if($db_connect -> connect_errno == 0) {
		echo "DB connection successful...";
	}
	else {
		echo "DB connection FAILED!!!".$link->connect_error;
	}
	*/ 

?>