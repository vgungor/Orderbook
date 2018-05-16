<?php
	include_once 'connection.php';
	include_once 'orderdetail.inc.php';	
	
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
				<h2 class="ust2a_1" ><a href="#"><?php echo $companyname;?></a></h2>
				<h3 class="ust2a_1" ><a href="#"><?php echo $usersname;?></a></h3>
				<!--<img id="ust_firmalogo" class="ust2a_1" src="./images/firma_logo.jpg" alt="Firma Logo">-->
			</div>
		</div>
	</header>
	<!-- END OF DEFAULT PAGE HEADER -->

	<!-- NAVIGATION -->
	<!-- ORDER / TENDER SIDEBAR-->
	<nav class="navigation">
		<div class="orta1">
			<h2 class="orta1a"><a href="musteri-siparis-olusturma.php">Create Order</a></h2>
			<h2 class="orta1a"><a href="musteri-siparisler-tab.php">Orders</a></h2>
			<h2 class="orta1a"><a href="musteri-teklifler-tab.php">Tenders</a></h2>
			<h2 class="orta1a"><a href="#">User Information</a></h2>
			<ul class="orta1_projeler">
				<li class="orta1_proje"><a href="#">User Details</a></li>
				<li class="orta1_proje"><a href="#">Company Details</a></li>
			</ul>
			<h2 class="orta1a"><a href="admin-page.php">Admin Page</a></h2>			
			<h2 class="orta1a"><a href="logout.php">Logout</a></h2>
		</div>
	</nav>
	<!-- END OF NAVIGATION -->
	
	
	<!-- SECTION -->
	<section class="section">
		<!-- HEADER OF PROJECT/PART DETAIL PAGE ABOVE ORDER/TENDER -->
		<div class="orta2a">
			<h1>Proje/Parça Adı</h1>
			<h2>Müşteri Talep/Sipariş Numarası</h2>
			<h3>Sipariş DURUMU</h3>	
		</div>
		
		<!--SİPARİŞ DETAY SİPARİŞ DETAY SİPARİŞ DETAY -->
		<div class="orta2c">
			<!-- TABLE FOR THE ORDERS-->
			<table class="siparis_detay">
				<!-- table title-->
				<caption>ORDER DETAILS</caption>
				<!-- first row / cell attributes/names titles -->
				<tr>
					<th>Customer Order Number</th>
					<td><?php echo $cOrderNumber;?></td>
				</tr>
				<tr>
					<th>Order Date</th>
					<td><?php echo $OrderDate;?></td>
				</tr>
				<tr>					
					<th>Latest Order Date</th>
					<td><?php echo $LatestOfferDate;?></td>
				</tr>
				<tr>
					<th>Delivery Date</th>
					<td><?php echo $DeliveryDate;?></td>
				</tr>
				<tr>
					<th>Order Status</th>
					<td><?php echo $orderStatus;?></td>
				</tr>
			</table>
			<table class="siparis_detay">
			<!-- table title-->
			<caption>PART DETAILS</caption>
				<tr>
					<th>Part Name</th>
					<td><?php echo $partName;?></td>
				</tr>
				<tr>
					<th>Part Number</th>
					<td><?php echo $partNumber;?></td>
				</tr>
				<tr>
					<th>Quantitiy Requested</th>
					<td><?php echo $partQuantity;?></td>
				</tr>
				<tr>
					<th>Part Execution</th>
					<td><?php echo $partExecution;?></td>
				</tr>
				<tr>
					<th>Part Technical Drawing</th>
					<td><?php echo $partTechDrawingNumber;?></td>
				</tr>
				<tr>
					<th>Part Material</th>
					<td><?php echo $partMaterial;?></td>
				</tr>
				<tr>
					<th>Part Details</th>
					<td><?php echo $partDetail;?></td>
				</tr>
			</table>
		</div>
	</section>
	<!-- END OF SECTION -->
	
		
	<!-- DEFAULT PAGE FOOTER TEMPLATE / LOCATED ON EACH PAGE -->
	<footer>
		<p><a href="mailto:mvolkang@gmail.com">MVG</a> Order Book Commerce Portal  -  2018</p>
	</footer>
	<!-- DEFAULT PAGE FOOTER END-->
</body>
</html>