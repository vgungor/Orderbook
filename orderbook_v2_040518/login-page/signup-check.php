<?php
	include_once 'connection.php';
	session_start();
	$email=$_SESSION['email'];
	//$userID=$_SESSION['userid'];
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	//echo "email: ".$email;
	
		echo <<< _END
		<html>
			<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width-device-width">
			<meta name="description" content="Login-Ekrani">
			<meta name="keywords" content="order offer portal, mustafa, volkan, gungor, orderbook ">
			<meta name="author" content="MVG">
	
			<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
			<link rel="stylesheet" href="style-loginpage.css">
			<title>signup-check.php</title>
		</head>
		<body>
		</body>
		</html>
	
_END;

	//DO NOT FORGET SQL INJECTION	
	//SQL INJECTION REMOVAL
	// remove html entities
	function sql_injection_removal($db_connect,$string){
		return htmlentities(mysql_fix_string($db_connect, $string));
	}
	//remove user input added quotes
	function mysql_fix_string($db_connect, $string){
		if(get_magic_quotes_gpc())
			$string=stripslashes($string);
			return $db_connect->real_escape_string($string);		
	}
	
	$firstname=sql_injection_removal($db_connect,$_POST["firstname"]);
	$lastname=sql_injection_removal($db_connect,$_POST["lastname"]);
	$identityNumber=sql_injection_removal($db_connect,$_POST["identityNumber"]);
	$job=sql_injection_removal($db_connect,$_POST["job"]);
	$mobile=sql_injection_removal($db_connect,$_POST["mobile"]);
	$email=sql_injection_removal($db_connect,$_POST["email"]);
	$password=sql_injection_removal($db_connect,$_POST["password"]);
	$companyName=sql_injection_removal($db_connect,$_POST["companyName"]);
	$companyWebpage=sql_injection_removal($db_connect,$_POST["companyWebpage"]);
	$companyLogo=sql_injection_removal($db_connect,$_POST["companyLogo"]);
	$street=sql_injection_removal($db_connect,$_POST["street"]);
	$postalCode=sql_injection_removal($db_connect,$_POST["postalCode"]);
	$district=sql_injection_removal($db_connect,$_POST["district"]);
	$city=sql_injection_removal($db_connect,$_POST["city"]);
	$country=sql_injection_removal($db_connect,$_POST["country"]);
	$companyPhone=sql_injection_removal($db_connect,$_POST["companyPhone"]);
	$companyFax=sql_injection_removal($db_connect,$_POST["companyFax"]);
	$companyMobile=sql_injection_removal($db_connect,$_POST["companyMobile"]);
	$timeinfo=date("Y-m-d H:i:s");
		
	/*PROCEDURE TO ADD INFO TO TABLES
	1. Lock the first table (e.g., cats).
	2. Insert data into the first table.
	3. Retrieve the unique ID from the first table (the insert_id property).
	4. Unlock the first table.
	5. Insert data into the second table.
	*/
	
	$db_connect->begin_transaction();
	//1-INSERT INTO COMPANY TABLE
	//company(companyID,companyName,companyWebpage,companyLogo)
	$sorgu1="INSERT INTO company VALUES(NULL,'".$companyName."','".$companyWebpage."','".$companyLogo."')";
	$sonuc1=$db_connect->query($sorgu1);
	$companyID=mysqli_insert_id($db_connect);
	
	if(!$sonuc1) {
		mysqli_rollback($db_connect);
		die("<b>query 1</b> - entry FAILED!!! error: ".$db_connect->error);
	}
	else {
		//2-INSERT INTO COMPANY ADDRESS TABLE
		//companyaddress(companyID,street,postalCode,district,city,country,companyPhone,companyFax,companyMobile)
		$sorgu2="INSERT INTO companyaddress VALUES('".$companyID."','".$street."','".$postalCode."','".$district."','".$city."','".$country."','".$companyPhone."','".$companyFax."','".$companyMobile."')";
		$sonuc2=$db_connect->query($sorgu2);
		if(!$sonuc2) {
			mysqli_rollback($db_connect);
			die("<b>query 2</b> error - entry FAILED!!! error: ".$db_connect->error);
		}
		else {
			//3-INSERT INTO DISTRICT TABLE
			//4-INSERT INTO CITY TABLE
			//5-INSERT INTO COUNTRY TABLE
			//6-INSERT INTO USERS TABLE
			//users(userID, firstName, lastName, email, password, registrationStatus, deletionStatus, blockedStatus, identityNumber, companyID, job, mobile, userTypeID, RegisterTime)
			$sorgu6="INSERT INTO users VALUES(NULL,'".$firstname."','".$lastname."','".$email."','".$password."',1,0,0,'".$identityNumber."','".$companyID."','".$job."','".$mobile."',NULL,'".$timeinfo."')";
			//echo $sorgu6;
			$sonuc6=$db_connect->query($sorgu6);
			if(!$sonuc6){
				mysqli_rollback($db_connect);
				die("<b>query 6</b> error - entry FAILED!!! error: ".$db_connect->error);
			}
		}
	}
	$db_connect->commit();
	
	$sorgu10="SELECT firstName, lastName, email, companyName, mobile FROM users, company 
				WHERE users.companyID=company.companyID AND  email='$email'";
	$sonuc10=$db_connect->query($sorgu10);
	if($sonuc10) {
		$firstName=$row->firstName;
		$lastName=$row->lastName;
		$email=$row->email;
		$companyName=$row->companyName;
		$mobile=$row->mobile;
	}
	
	// EMAIL SYSTEM ADMIN AS NEW USER REGISTRY
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: mvolkang@hotmail.com' . "\r\n";
	$content = "<div 'font-size: 14px'>
				<p><h3>A new user REGISTERED to ORDERBOOK - <a href='http://localhost/orderbook/login-page/'>awaiting your approval</a></h3>
				name: <b>$firstName</b><br>
				lastname: <b>$lastName</b><br>
				company: <b>$companyName</b><br>
				email: <b>$email</b><br>
				mobile: <b>$mobile</b><br>
				</p></div>";
	mail("mvolkang@hotmail.com","Orderbook new User registry",$content,$headers);

	$db_connect->close();
	
	header("Location:../login-page/");
	
	/* testing the POST variables */
	/*
	echo "firstname: ".$firstname."<br>";
	echo "lastname: ".$lastname."<br>";
	echo "identityNumber: ".$identityNumber."<br>";
	echo "job: ".$job."<br>";
	echo "mobile: ".$mobile."<br>";
	echo "email: ".$email."<br>";
	echo "password: ".$password."<br>";
	echo "companyName:".$companyName."<br>";
	echo "companyWebpage:".$companyWebpage."<br>";
	echo "companyLogo:".$companyLogo."<br>";
	echo "street:".$street."<br>";
	echo "postalCode:".$postalCode."<br>";
	echo "district:".$district."<br>";
	echo "city:".$city."<br>";
	echo "country:".$country."<br>";
	echo "companyPhone:".$companyPhone."<br>";
	echo "companyFax:".$companyFax."<br>";
	echo "companyMobile:".$companyMobile."<br>";
	
	echo "mysqli_insert_id: ".$companyID."<br>";
	*/
	

	
	
?>