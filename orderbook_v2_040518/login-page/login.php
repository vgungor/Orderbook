<?php
	define(TRUE,1);
	define(FALSE,0);
	echo <<< _END
		<html>
			<head>
			<title>login.php</title>
			</head>
			<body>
			</body>
		</html>
	
_END;
	include_once 'connection.php';
	
	//DO NOT FORGET SQL INJECTION
	$login_email=$_POST["email"];
	$login_password=$_POST["password"];
	
	//SQL INJECTION REMOVAL
	$login_email=sql_injection_removal($db_connect,$_POST["email"]);
	$login_password=sql_injection_removal($db_connect,$_POST["password"]);
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
	
	
	//echo $email, $password;
	
	$sorgula=mysqli_query($db_connect,"SELECT * FROM Users WHERE email='".$login_email."' AND password='".$login_password."'" );
	if(mysqli_num_rows($sorgula)>0){
		while($row = mysqli_fetch_assoc($sorgula)){
		
			$userID=$row["userID"];			
			$firstName=$row["firstName"];
			$lastName=$row["lastName"];
			$email=$row["email"];
			$password=$row["password"];
			$registrationStatus =$row["registrationStatus"];
			$deletionStatus=$row["deletionStatus"];
			$blockedStatus=$row["blockedStatus"];
			$identityNumber=$row["identityNumber"];
			$companyID=$row["companyID"];
			$userTypeID=$row["userTypeID"];
			
			
			if($login_email==$email && $login_password=$password && $registrationStatus==TRUE && ($userTypeID==1 /*|| $userTypeID==NULL*/)&& $blockedStatus==FALSE){
				// Start session n redirect to last page
				session_start();
				$_SESSION['id']=session_id();
				$_SESSION['userid']=$userID;
				$_SESSION['email']=$email;
				//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
				echo 	"<script>
						<!--
							window.location='../orderbook-pages/admin-page.php';
						//-->
						</script>";
				$sorgu="INSERT INTO userlogininfo VALUES (NULL, $userID, CURRENT_TIMESTAMP, 'SUCCESFUL')";
				$sonuc=$db_connect->query($sorgu);
				//header("Location:http://localhost/orderbook/admin-page/admin-page.php");
			}
			else if($login_email==$email && $login_password=$password && $registrationStatus==TRUE && ($userTypeID==2 /*|| $userTypeID==NULL*/) && $blockedStatus==FALSE){
				// Start session n redirect to last page
				session_start();
				$_SESSION['id']=session_id();
				$_SESSION['userid']=$userID;
				$_SESSION['email']=$email;
				$sorgu="INSERT INTO userlogininfo VALUES (NULL, $userID, CURRENT_TIMESTAMP, 'SUCCESFUL')";
				$sonuc=$db_connect->query($sorgu);
				header("Location:../orderbook-pages/musteri-siparisler-tab.php");
			}
			else if($login_email==$email && $login_password=$password && $registrationStatus==TRUE && ($userTypeID==3 /*|| $userTypeID==NULL*/) && $blockedStatus==FALSE){
				// Start session n redirect to last page
				session_start();
				$_SESSION['id']=session_id();
				$_SESSION['userid']=$userID;
				$_SESSION['email']=$email;
				$sorgu="INSERT INTO userlogininfo VALUES (NULL, $userID, CURRENT_TIMESTAMP, 'SUCCESFUL')";
				$sonuc=$db_connect->query($sorgu);
				header("Location:../orderbook-pages/musteri-siparisler-tab.php");
			}
			else if($login_email==$email && $login_password=$password && $registrationStatus==TRUE && ($userTypeID==4 /*|| $userTypeID==NULL*/) && $blockedStatus==FALSE){
				// Start session n redirect to last page
				session_start();
				$_SESSION['id']=session_id();
				$_SESSION['userid']=$userID;
				$_SESSION['email']=$email;
				$sorgu="INSERT INTO userlogininfo VALUES (NULL, $userID, CURRENT_TIMESTAMP, 'SUCCESFUL')";
				$sonuc=$db_connect->query($sorgu);
				header("Location:../orderbook-pages/musteri-siparisler-tab.php");
			}
			else {
				$sorgu="INSERT INTO userlogininfo VALUES (NULL, $userID, CURRENT_TIMESTAMP, 'FAILED-BLOCKED USER')";
				$sonuc=$db_connect->query($sorgu);
				echo "<a href='../login-page/index.html'>Please click to correct username and password!!!</a>";
			}
				
				
			/*
			echo $userID."<br>";	
			echo $firstName."<br>";
			echo $lastName."<br>";
			echo $email."<br>";
			echo $password."<br>";
			echo $registrationStatus."<br>";
			echo $deletionStatus."<br>";
			echo $blockedStatus."<br>";
			echo $identityNumber."<br>";
			echo $companyID."<br>";
			echo $userTypeID."<br>";
			*/
		}
		/*
		$sorgu2="SELECT * FROM Users WHERE email='".$email."' AND password='".$password."'";
		$result2=$db_connect->query($sorgu2);
		
		echo "OBJECT <br>";
		while ($row2 = $result2->fetch_object()) {
			$userID=$row2->userID ;
			$firstName==$row2->firstName ;
			$lastName==$row2->lastName ;
			$email==$row2->email ;
			$password=$row2->password ;
			$registrationStatus =$row2->registrationStatus ;
			$deletionStatus=$row2->deletionStatus ;
			$blockedStatus=$row2->blockedStatus ;
			$identityNumber=$row2->identityNumber ;
			$companyID=$row2->companyID ;
			$userTypeID=$row2->userTypeID ;
			
			
			echo $userID."<br>";	
			echo $firstName."<br>";
			echo $lastName."<br>";
			echo $email."<br>";
			echo $password."<br>";
			echo $registrationStatus."<br>";
			echo $deletionStatus."<br>";
			echo $blockedStatus."<br>";
			echo $identityNumber."<br>";
			echo $companyID."<br>";
			echo $userTypeID."<br>";
		}
		*/
	}
	else {
		
		//echo $login_email, $login_password;
		$sorgu="SELECT userID FROM users WHERE email='$login_email'";
		$sonuc=$db_connect->query($sorgu);
		//echo $sorgu;
		if($row = $sonuc->fetch_object()){		
			$userID=$row->userID;	
		}
		$sorgu="INSERT INTO userlogininfo VALUES (NULL, $userID, CURRENT_TIMESTAMP, 'FAILED-WRONG USERNAME PASSWORD')";
		$sonuc=$db_connect->query($sorgu);
		echo "<a href='../login-page/index.html'>Wrong Username or Password</a>";
	}
?>