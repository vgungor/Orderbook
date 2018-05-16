<?php
session_start();
session_destroy();
header("Location:../login-page/");
/*
	session_start();
	if(isset($_SESSION['email'])){
		$email=$_SESSION['email'];
	}
	if(isset($_SESSION['userid'])) {
		$userID=$_SESSION['userid'];
	}
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	//echo "email: ".$email;
*/
?>
<!--
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="template">
	<meta name="keywords" content="order offer portal, mustafa, volkan, gungor, orderbook ">
	<meta name="author" content="MVG">
FONTS
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
CSS DOCUMENTS
	<link rel="stylesheet" href="./css/reset.css">
	<link rel="stylesheet" href="./css/template-style.css">
	<title>Logout</title>
</head>

<body>

DEFAULT PAGE HEADER TEMPLATE / LOCATED ON EACH PAGE
	<header class="header">
		<div class="ust1">
			<a class="ust1a" href="#"><img id="ust_orcelogo" src="./images/mvglogo2.png" alt="MVG Design"></a>
			<h2 class="ust1a"><span>Order Book</span> Portal</h2>
		</div>
	</header>
-->

<?php
	/*
	if (isset($_SESSION['userid'])) {
		session_destroy();
		echo "<div><center><p>You have been logged out. Please " .
		"<a href='http://localhost/orderbook/login-page/'>click here</a> to refresh the screen.</p></center></div>";
		header("Location:http://localhost/orderbook/login-page/");
	}
	else{
		echo "<div><center><br>"."<p>You cannot log out because you are not  <a href='http://localhost/orderbook/login-page/'>logged in</a></p></center></div>";
		header("Location:http://localhost/orderbook/login-page/");
	}
	*/
?>
<!--
<br><br></div>
</body>
</html>
-->