<?
	//INCLUDE DB CONNECTION
	include_once 'connection.php';
	
	//SESSION INFO BETWEEN PAGES
	session_start();
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	//echo "email: ".$email;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="template">
	<meta name="keywords" content="order offer portal, mustafa, volkan, gungor, orderbook ">
	<meta name="author" content="MVG">
	<!-- FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<!-- CSS DOCUMENTS -->
	<link rel="stylesheet" href="./css/reset.css">
	<link rel="stylesheet" href="./css/template-style.css">
	
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<title>MVG OrderBook</title>
</head>
