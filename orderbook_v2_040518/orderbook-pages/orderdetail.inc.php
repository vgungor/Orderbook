<?php
	include_once 'connection.php';

	session_start();
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	$mOrderNumber=$_GET['mOrderNumber'];
	//echo "email: ".$email;
	
	$sorgu1="SELECT concat(users.firstname,' ',users.lastname) as usersname, company.name,users.userTypeID, users.userID FROM users,company WHERE company.companyID=users.companyID AND users.email='".$email."'" ;
	$sonuc1=$db_connect->query($sorgu1);
	while($row = $sonuc1->fetch_object()){
		$usersname=$row->usersname;
		$companyname=$row->name;
		$userID=$row->userID;
	}
				
		echo <<< _END
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
	<title>siparis-detay</title>
</head>

<body>

<!-- DEFAULT PAGE HEADER TEMPLATE / LOCATED ON EACH PAGE -->
	<header class="header">
		<div class="ust1">
			<a class="ust1a" href="#"><img id="ust_orcelogo" src="./images/mvglogo2.png" alt="MVG Design"></a>
			<h2 class="ust1a"><span>Order Book</span> Portal</h2>
			<div class="ust1a">
				<!-- <form class="ust1a_1"><button id="new_member" name="new_member" type="submit">Üye Ol</button></form> -->
				<form action="logout.php" method="POST" class="ust1a_1"><button id="logout" name="logout" type="submit">LOGOUT</button></form>
			</div>
		</div>
		<!-- SECTION RELATED TO CUSTOMER/COMPANY INFO / LOCATED ON EACH PAGE -->
		<div class="ust2">
			<div class="ust2a">
_END;
		echo	'<h2 class="ust2a_1" ><a href="#">'.$companyname.'</a></h2>
				<h3 class="ust2a_1" ><a href="#">'.$usersname.'</a></h3>
				<!--<img id="ust_firmalogo" class="ust2a_1" src="./images/firma_logo.jpg" alt="Firma Logo">-->
			</div>
		</div>
	</header>
	<!-- END OF DEFAULT PAGE HEADER -->

	<!-- NAVIGATION -->
	<!-- ORDER / TENDER SIDEBAR-->
	<nav class="navigation">
		<div class="orta1">
			<h2 id="create_order" class="orta1a"><a href="musteri-siparis-olusturma.php">Create Order</a></h2>
			<h2 id="create_tender" class="orta1a"><a href="musteri-teklif-olusturma.php">Create Tender</a></h2>
			<h2 id="orders" class="orta1a"><a href="musteri-siparisler-tab.php">Orders</a></h2>
			<h2 id="tenders" class="orta1a"><a href="musteri-teklifler-tab.php">Tenders</a></h2>
			<h2 class="orta1a"><a href="#">User Information</a></h2>
			<ul class="orta1_projeler">
				<li class="orta1_proje"><a href="../orderbook-pages/user-details.php">User Details</a></li>
				<li class="orta1_proje"><a href="#">Company Details</a></li>
			</ul>
			<h2 id="admin_page" class="orta1a"><a href="admin-page.php">Admin Page</a></h2>			
			<h2 class="orta1a"><a href="logout.php">Logout</a></h2>
		</div>
	</nav>
	<!-- END OF NAVIGATION -->';

				$sorgu7="SELECT userTypeID FROM users WHERE users.email='".$email."'" ;
				$sonuc7=$db_connect->query($sorgu7);
				while($row = $sonuc7->fetch_object()){
					$userTypeID=$row->userTypeID;
				}
				if($userTypeID==2 ){
					echo '	<script>
								$(function() {
									$(document).ready(function() {
										//$("#admin_page").remove();
									});
								});
							</script>';
				}
				else if($userTypeID==3 ){
					echo '	<script>
								$(function() {
									$(document).ready(function() {
										$("#create_tender").remove();
										$("#admin_page").remove();
									});
								});
							</script>';
				}
				else if($userTypeID==4 ){
					echo '	<script>
								$(function() {
									$(document).ready(function() {
										$("#create_order").remove();
										$("#admin_page").remove();
									});
								});
							</script>';
				}

	//echo $userID;
	
	$sorgu2="SELECT * FROM ccreateorderdetail WHERE  mOrderNumber='".$mOrderNumber."'" ;
	//echo $sorgu2."<br>";
	$sonuc2=$db_connect->query($sorgu2);
	while($row = $sonuc2->fetch_object()){
		$OrderDate=$row->OrderDate;      
		$mOrderNumber=$row->mOrderNumber;   
		$cOrderNumber=$row->cOrderNumber ;  
		$LatestOfferDate=$row->LatestOfferDate;
		$DeliveryDate=$row->DeliveryDate;   
		$orderStatus=$row->orderStatus;    
		$OrderMail=$row->OrderMail;      
		$DeliveryType=$row->DeliveryType;   
		$userID=$row->userID;         
		$mOrderMail=$row->mOrderMail; 
		/*
		echo "OrderDate: ".$OrderDate."<br>";      
		echo "mOrderNumber: ".$mOrderNumber."<br>";   
		echo "cOrderNumber: ".$cOrderNumber."<br>";   
		echo "LatestOfferDate".$LatestOfferDate."<br>";
		echo "DeliveryDate: ".$DeliveryDate."<br>";   
		echo "orderStatus: ".$orderStatus."<br>";   
		echo "OrderMail: ".$OrderMail."<br>";      
		echo "DeliveryType: ".$DeliveryType."<br>";   
		echo "userID: ".$userID."<br>";         
		echo "mOrderMail: ".$mOrderMail."<br>";
		*/	
	}
	
	echo'<!-- SECTION -->
		<section class="section">
			<!-- HEADER OF PROJECT/PART DETAIL PAGE ABOVE ORDER/TENDER -->
			<div class="orta2a">
				<h1>'.$cOrderNumber.' Order</h1>
				<h3>On <b>'.$OrderDate.'</b> order was issued by<b>'.$usersname.'</b> </h3>
				<h3>Order Status: <b>'.$orderStatus.'</b></h3>	
			</div>
		
			<!--SİPARİŞ DETAY SİPARİŞ DETAY SİPARİŞ DETAY -->
			<div class="orta2c">';

	echo '<!-- TABLE FOR THE ORDERS-->
			<table class="siparis_detay">
				<!-- table title-->
				<caption><b>ORDER DETAILS</b></caption>
				<!-- first row / cell attributes/names titles -->
				<tr>					
					<th>Latest Order Date</th>
					<td>'.$LatestOfferDate.'</td>
				</tr>
				<tr>
					<th>Delivery Date</th>
					<td>'.$DeliveryDate.'</td>
				</tr>
			</table>';

	$sorgu5="SELECT * FROM ccreateorderpk WHERE  mOrderNumber='".$mOrderNumber."'" ;
	//echo $sorgu5."<br>";
	$sonuc5=$db_connect->query($sorgu5);
	while($row = $sonuc5->fetch_object()){
		$mOrderNumber=$row->mOrderNumber;
		$partID=$row->partID;
		
		/*
		echo "mOrderNumber: ".$mOrderNumber."<br>";
		echo "partID: ".$partID."<br>";
		*/
	
		$sorgu3="SELECT * FROM ccreateorderdetailpartinfo WHERE  partID='".$partID."'" ;
		//echo $sorgu3."<br>";
		$sonuc3=$db_connect->query($sorgu3);
		while($row = $sonuc3->fetch_object()){
	
			$partID=$row->partID;                    
			$partName=$row->partName;                  
			$partNumber=$row->partNumber;                
			$partQuantity=$row->partQuantity;              
			$partExecution=$row->partExecution;             
			$partTechDrawingNumber=$row->partTechDrawingNumber;     
			$partTechDrawingFile=$row->partTechDrawingFile;       
			$partMaterial=$row->partMaterial;              
			$partDetail=$row->partDetail;                
			$modelID=$row->modelID;                   
			$cleanedTechDrawingNumber=$row->cleanedTechDrawingNumber;  
			$cleanedpartTechDrawingFile=$row->cleanedpartTechDrawingFile;
			$partUnitPriceToC=$row->partUnitPriceToC;          
			$unitPriceToM=$row->unitPriceToM;              
			
			/*
			echo "partID: ".$partID."<br>";                   
			echo "partName: ".$partName."<br>";                  
			echo "partNumber: ".$partNumber."<br>";                
			echo "partQuantity: ".$partQuantity."<br>";              
			echo "partExecution: ".$partExecution."<br>";             
			echo "partTechDrawingNumber: ".$partTechDrawingNumber."<br>";     
			echo "partTechDrawingFile: ".$partTechDrawingFile."<br>";       
			echo "partMaterial: ".$partMaterial."<br>";              
			echo "partDetail: ".$partDetail."<br>";                
			echo "modelID: ".$modelID."<br>";                   
			echo "cleanedTechDrawingNumber: ".$cleanedTechDrawingNumber."<br>";  
			echo "cleanedpartTechDrawingFile: ".$cleanedpartTechDrawingFile."<br>";
			echo "partUnitPriceToC: ".$partUnitPriceToC."<br>";          
			echo "unitPriceToM: ".$unitPriceToM."<br>";   
			*/
			echo '<table class="siparis_detay">
			<!-- table title-->
			<caption><b>PART DETAILS</b></caption>
				<tr>
					<th>Part Name</th>
					<td>'.$partName.'</td>
				</tr>
				<tr>
					<th>Part Number</th>
					<td>'.$partNumber.'</td>
				</tr>
				<tr>
					<th>Quantitiy Requested</th>
					<td>'.$partQuantity.'</td>
				</tr>
				<tr>
					<th>Part Execution</th>
					<td>'.$partExecution.'</td>
				</tr>
				<tr>
					<th>Part Technical Drawing</th>
					<td>'.$partTechDrawingNumber.'</td>
				</tr>
				<tr>
					<th>Part Material</th>
					<td>'.$partMaterial.'</td>
				</tr>
				<tr>
					<th>Part Details</th>
					<td>'.$partDetail.'/td>
				</tr>
			</table>';	
			
			$sorgu4="SELECT * FROM models WHERE  modelID='".$modelID."'" ;
			//echo $sorgu4."<br>";
			$sonuc4=$db_connect->query($sorgu4);
			while($row = $sonuc4->fetch_object()){
		
				$modelID=$row->modelID;
				$modelNumber=$row->modelNumber;
				$modelName=$row->modelName;
				$modelStatus=$row->modelStatus;
				$modelContact=$row->modelContact;
				$modelcontactphone=$row->modelcontactphone;
				$modelLocation=$row->modelLocation;        
				/*
				echo "modelID: ".$modelID."<br>";
				echo "modelNumber: ".$modelNumber."<br>";
				echo "modelName: ".$modelName."<br>";
				echo "modelStatus: ".$modelStatus."<br>";
				echo "modelContact: ".$modelContact."<br>";
				echo "modelcontactphone: ".$modelcontactphone."<br>";
				echo "modelLocation: ".$modelLocation."<br>";
				*/
			echo '<table class="siparis_detay">
			<!-- table title-->
			<caption><b>MODEL DETAILS</b></caption>
				<tr>
					<th>Model Name</th>
					<td>'.$modelName.'</td>
				</tr>
				<tr>
					<th>Model Number</th>
					<td>'.$modelNumber.'</td>
				</tr>
				<tr>
					<th>Model Location</th>
					<td>'.$modelLocation.'</td>
				</tr>
				<tr>
					<th>Contact Person for Model</th>
					<td>'.$modelContact.'</td>
				</tr>
				<tr>
					<th>Contact Phone for Model</th>
					<td>'.$modelcontactphone.'</td>
				</tr>
			</table>';
			
				
			}
			
		}
	}
echo '</div>
	</section>
	<!-- END OF SECTION -->
	
		
	<!-- DEFAULT PAGE FOOTER TEMPLATE / LOCATED ON EACH PAGE -->
	<footer>
		<p><a href="mailto:mvolkang@gmail.com">MVG</a> Order Book Commerce Portal  -  2018</p>
	</footer>
	<!-- DEFAULT PAGE FOOTER END-->
</body>
</html>	';
?>