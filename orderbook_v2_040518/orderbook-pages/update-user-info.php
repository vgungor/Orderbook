<?php
	include_once 'connection.php';
	
	session_start();
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	//echo "email: ".$email;
	//echo "userID: ".$userID;
	
		$firstname=$_POST["firstname"];
		$lastname=$_POST["lastname"];
		$job=$_POST["job"];
		$mobile=$_POST["mobile"];
		$password=$_POST["password"];
		$email=$_POST["email"];
		
		echo "firstname:".$firstname."<br>";
		echo "lastname:".$lastname."<br>";
		echo "job:".$job."<br>";
		echo "mobile:".$mobile."<br>";
		echo "password:".$password."<br>";
		echo "email:".$email."<br>";
		
		$sorgu="UPDATE users set firstName='$firstname', lastName='$lastname', job='$job', mobile='$mobile', password=$password, email='$email' WHERE userID=$userID";
		echo $sorgu;
		$sonuc=$db_connect->query($sorgu);
		
		if(!$sonuc){
			echo "Error in user info update";
			echo $db_connect->error;
		}
		else{
			header("Location:../orderbook-pages/user-details.php");
		}
	
?>