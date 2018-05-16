<?php
	include_once 'connection.php';
	
	session_start();
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	//echo "email: ".$email;
	
	
	$sorgu1="SELECT concat(users.firstname,' ',users.lastname) as usersname, company.name,users.userTypeID, users.userID FROM users,company WHERE company.companyID=users.companyID AND users.email='".$email."'" ;
	$sonuc1=$db_connect->query($sorgu1);
	while($row = $sonuc1->fetch_object()){
		$usersname=$row->usersname;
		$companyname=$row->name;
		$userID=$row->userID;
		$userTypeID=$row->userTypeID;

	}
	
	//echo $userID;
	if(!($_POST["sentOfferedPrice"]==NULL)){
		header("Location:musteri-teklifler-tab.php");
		
	}
	else {
		$partID=$_POST["partID"];
		$OfferedPrice=$_POST["OfferedPrice"];
	}
	//echo $OfferedPrice."<br>";
	//echo $partID;
	if($userTypeID==4){
		//TEDARİKÇİ FİYAT TEKLİFİ `supplierbidperpart` TABLOSUNA YAZILACAK
		$sorgu="INSERT INTO supplierbidperpart VALUES(NULL,$partID,$userID,$OfferedPrice,CURRENT_TIMESTAMP)"; 				//SET unitPriceToM='".$OfferedPrice."' WHERE partID='".$partID."'";
		echo $sorgu;
		$sonuc=$db_connect->query($sorgu);
	}
	else if($userTypeID==2) {
	//ÜRETİCİ SEÇİMİNE KAYDIRILACAK
		$sorgu="UPDATE ccreateorderdetailpartinfo SET unitPriceToM='".$OfferedPrice."' WHERE partID='".$partID."'";
		echo $sorgu;
		$sonuc=$db_connect->query($sorgu);
	}
	if(!$sonuc){
		echo "<br>".gettype($OfferedPrice)."<br>";
		echo "error in price insertion";
	}
	else{
		header("Location:musteri-teklifler-tab.php");
	}
	
?>