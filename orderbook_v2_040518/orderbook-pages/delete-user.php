<?php
	include_once 'connection.php';
	$email=$_POST["email"];
	//echo "email: ".$email."<br>";
	$db_connect->begin_transaction();
	//DELETE USERS TABLE
	//users(userID, firstName, lastName, email, password, registrationStatus, deletionStatus, blockedStatus, identityNumber, companyID, job, mobile, userTypeID, RegisterTime)
	$sorgu1="DELETE FROM users WHERE email='".$email."'";
	//$sorgu1="UPDATE users SET blockedStatus=1, userTypeID=4, password=1111 WHERE email='uretici@gmail.com'";
	$sonuc1=$db_connect->query($sorgu1);
	
	if(!$sonuc1) {
		mysqli_rollback($db_connect);
		die("<b>Delete query </b> - FAILED!!! error: ".$db_connect->error);
	}
	
	$db_connect->commit();
	$db_connect->close();
	header("Location:../orderbook-pages/admin-page.php");


?>