<?php
	include_once 'connection.php';
	session_start();
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	//echo "email: ".$email;
	$timeinfo=date("Y-m-d H:i:s");
	//order detail information
	//$OrderDate=$_POST["siparis_tarihi"];      
	//$mOrderNumber=$_POST[""];   
	$cOrderNumber=$_POST["cOrderNumber"];
	if(isset($_POST["son_tarih"])){
		$LatestOfferDate=$_POST["son_tarih"];
	}	
	else {
		$LatestOfferDate=$timeinfo;
	}
	if(isset($_POST["teslimat_tarihi"])){
		$DeliveryDate=$_POST["teslimat_tarihi"];
	}	
	else {
		$DeliveryDate=$timeinfo;
	}
	$DeliveryDate=$_POST["teslimat_tarihi"];   
	//$orderStatus=$_POST[""];
	//file    
	$OrderMail=$_POST["teklif_mail"];      
	$DeliveryType=$_POST["teslimat_sekli"]; 
	
	echo $cOrderNumber."<br>";
	echo $LatestOfferDate."<br>";
	echo $DeliveryDate."<br>";
	echo $OrderMail."<br>";
	echo $DeliveryType."<br>";
	echo $timeinfo."<br>";
	
	//part detail information
	$partname=$_POST["parca_adı"];
	$partnumber=$_POST["parca_numara"];
	$partquantity=$_POST["parca_adet"];
	$partexecution=$_POST["parca_yapilisi"];
	//file 
	$partdrawing=$_POST["parca_teknik_cizim"];
	$partmaterial=$_POST["parca_malzeme"];
	$partdetail=$_POST["parca_aciklama"];
	echo $partname."<br>";
	echo $partnumber."<br>";
	echo $partquantity."<br>";
	echo $partexecution."<br>";
	echo $partdrawing."<br>";
	echo $partmaterial."<br>";
	echo $partdetail."<br>";
	
	//model detail informatin
	if($_POST["model_kontrol"]==1){
		$modelstatus=1;
	}
	else{
		$modelstatus=0;
	}
	$modelstatus=$_POST["model_kontrol"];
	$modelnumber=$_POST["model_no"];
	$modelname=$_POST["model_adi"];
	$modelplace=$_POST["model_yeri"];
	$modelcontact=$_POST["model_contact"];
	$modelcontactphone=$_POST["model_contact_telefon"];
	
	//ASK FOR LATEST mOrderNumber FROM DB: select mOrderNumber from ccreateorderdetail;
	$sorgula=mysqli_query($db_connect,"SELECT AUTO_INCREMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'orderbook_v2_050518' AND TABLE_NAME='ccreateorderdetail'" );
	if(mysqli_num_rows($sorgula)>0){
		$row = mysqli_fetch_assoc($sorgula);
		$mOrderNumber=$row["AUTO_INCREMENT"];
	}
	echo "mOrderNumber: ".$mOrderNumber."<br>";
	//SON EKLENEN 10.05.2018 19:39
	//$mOrderNumber=$mOrderNumber+1;
	$db_connect->begin_transaction();
	//1-INSERT INTO ccreateorderdetail TABLE
	//ccreateorderdetail(OrderDate, mOrderNumber, cOrderNumber, LatestOfferDate, DeliveryDate, 
	//orderStatus, OrderMail, DeliveryType, userID, mOrderMail)
	$sorgu1="INSERT INTO ccreateorderdetail VALUES('".$timeinfo."',".$mOrderNumber.",'".$cOrderNumber."','".$LatestOfferDate."','".$DeliveryDate."', NULL,'".$OrderMail."','".$DeliveryType."',".$userID.", NULL)";
	echo $sorgu1."<br>";
	$sonuc1=$db_connect->query($sorgu1);
	$mOrderNumber=mysqli_insert_id($db_connect);
	echo "mOrderNumber: ".$mOrderNumber."<br>";
	if(!$sonuc1){
		//$trun1=$db_connect->query("TRUNCATE ccreateorderdetail");
		mysqli_rollback($db_connect);
		die("<b>ccreateorderdetail query 1</b> error - entry FAILED!!! error: ".$db_connect->error);
	}
	
	//2-INSERT INTO ccreateorderpk TABLE
	//ccreateorderpk(mOrderNumber, partID)
	$sorgu2="INSERT INTO ccreateorderpk VALUES(".$mOrderNumber.", NULL)";
	echo $sorgu2."<br>";
	$sonuc2=$db_connect->query($sorgu2);
	$partID=mysqli_insert_id($db_connect);
	echo "partID: ".$partID."<br>";
	if(!$sonuc2){
		//$trun1=$db_connect->query("TRUNCATE ccreateorderdetail");
		//$trun2=$db_connect->query("TRUNCATE ccreateorderpk");
		mysqli_rollback($db_connect);
		die("<b>ccreateorderpk query 2</b> error - entry FAILED!!! error: ".$db_connect->error);
	}
	
	//3-INSERT INTO ccreateorderdetailpartinfo TABLE
	//ccreateorderdetailpartinfo(partID, partName, partNumber, partQuantity, partExecution, partTechDrawingNumber, partTechDrawingFile, 
	//partMaterial, partDetail, modelID, cleanedTechDrawingNumber, cleanedpartTechDrawingFile, partUnitPriceToC, unitPriceToM)
	$sorgu3="INSERT INTO ccreateorderdetailpartinfo VALUES(".$partID.",'".$partname."','".$partnumber."',".$partquantity.",'".$partexecution."', NULL, '".$partdrawing."','".$partmaterial."','".$partdetail."', NULL, NULL, NULL, NULL, NULL)";
	echo $sorgu3."<br>";
	$sonuc3=$db_connect->query($sorgu3);
	$modelID=mysqli_insert_id($db_connect);
	echo "modelID: ".$modelID."<br>";
	if(!$sonuc3){
		//$trun1=$db_connect->query("TRUNCATE ccreateorderdetail");
		//$trun2=$db_connect->query("TRUNCATE ccreateorderpk");
		//$trun3=$db_connect->query("TRUNCATE ccreateorderdetailpartinfo");
		mysqli_rollback($db_connect);
		die("<b>ccreateorderdetailpartinfo query 3</b> error - entry FAILED!!! error: ".$db_connect->error);
	}
	
	//4-INSERT INTO models TABLE
	//models(modelID, modelNumber, modelName, modelStatus, modelContact, modelContactphone, modelLocation)
	$sorgu4="INSERT INTO models VALUES('".$modelID."','".$modelnumber."','".$modelname."','".$modelstatus."','".$modelcontact."','".$modelcontactphone."','".$modelplace."')";
	echo $sorgu4."<br>";
	$sonuc4=$db_connect->query($sorgu4);
	if(!$sonuc4){
		//$trun1=$db_connect->query("TRUNCATE ccreateorderdetail");
		//$trun2=$db_connect->query("TRUNCATE ccreateorderpk");
		//$trun3=$db_connect->query("TRUNCATE ccreateorderdetailpartinfo");
		//$trun4=$db_connect->query("TRUNCATE models");
		mysqli_rollback($db_connect);
		die("<b>models query 4</b> error - entry FAILED!!! error: ".$db_connect->error);
	}
	$db_connect->commit();
	$db_connect->close();
	
	header("Location:../orderbook-pages/musteri-siparisler-tab.php");
	
	/*
	//FILE UPLOAD PHP SCRIPT
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "pdf" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	*/
?>