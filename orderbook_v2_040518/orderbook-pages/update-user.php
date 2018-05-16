<?php
	include_once 'connection.php';

	$firstname=$_POST["firstname"];
	$lastname=$_POST["lastname"];
	$email=$_POST["email"];
	$company=$_POST["company"];
	$password=$_POST["password"];
	$usertypeID=$_POST["usertypeID"];
	if(!isset($_POST["block_user"])){
		$block_user=0;
	}
	else {
		$block_user=1;
	}
	
	
	
	echo "firstname: ".$firstname."<br>";
	echo "lastname: ".$lastname."<br>";
	echo "email: ".$email."<br>";
    echo "company: ".$company."<br>";
	echo "password: ".$password."<br>";
    echo "usertypeID: ".$usertypeID."<br>";
    echo "block_user: ".$block_user."<br>";
	
	$db_connect->begin_transaction();
	//UPDATE USERS TABLE
	//users(userID, firstName, lastName, email, password, registrationStatus, deletionStatus, blockedStatus, identityNumber, companyID, job, mobile, userTypeID, RegisterTime)
	$sorgu1="UPDATE users SET blockedStatus='".$block_user."', userTypeID='".$usertypeID."', password='".$password."' WHERE email='".$email."'";
	//$sorgu1="UPDATE users SET blockedStatus=1, userTypeID=4, password=1111 WHERE email='uretici@gmail.com'";
	$sonuc1=$db_connect->query($sorgu1);
	
	if(!$sonuc1) {
		mysqli_rollback($db_connect);
		die("<b>Update query</b> - FAILED!!! error: ".$db_connect->error);
	}
	
	$db_connect->commit();
	$db_connect->close();
	header("Location:../orderbook-pages/admin-page.php");
	
	
?>