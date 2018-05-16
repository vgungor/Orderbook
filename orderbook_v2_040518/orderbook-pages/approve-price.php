<?php
	include_once 'connection.php';
	
	session_start();
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	//echo "email: ".$email;
	
	$partID=$_POST["partID"];
	echo $partID."<br>";
	
	$sorgu="SELECT mOrderNumber FROM ccreateorderpk where partID='$partID'";
	echo $sorgu."<br>";
	$sonuc=$db_connect->query($sorgu);
	if($row = $sonuc->fetch_object()){
		$mOrderNumber=$row->mOrderNumber;
	}
	echo $mOrderNumber."<br>";
	
	$sorgu1="UPDATE ccreateorderdetail SET orderStatus='Teklif Onaylandı' WHERE mOrderNumber='".$mOrderNumber."'";
	echo $sorgu1;
	$sonuc1=$db_connect->query($sorgu1);
	
	if(!$sonuc1){
		echo "error in price insertion";
	}
	else{
		header("Location:musteri-teklifler-tab.php");
	}
	
	

?>