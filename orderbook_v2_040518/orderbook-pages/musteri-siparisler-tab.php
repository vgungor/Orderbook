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
	<title>siparisler-tab</title>
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
			<h2 id="create_order" class="orta1a"><a href="musteri-siparis-olusturma.php">Create Order</a></h2>
			<h2 id="create_tender" class="orta1a"><a href="musteri-teklif-olusturma.php">Create Tender</a></h2>
			<h2 id="orders"class="orta1a"><a href="musteri-siparisler-tab.php">Orders</a></h2>
			<h2 id="tenders"class="orta1a"><a href="musteri-teklifler-tab.php">Tenders</a></h2>
			<h2 class="orta1a"><a href="#">User Information</a></h2>
			<ul class="orta1_projeler">
				<li class="orta1_proje"><a href="../orderbook-pages/user-details.php">User Details</a></li>
				<li class="orta1_proje"><a href="#">Company Details</a></li>
			</ul>
			<h2 id="admin_page" class="orta1a"><a href="admin-page.php">Admin Page</a></h2>			
			<h2 class="orta1a"><a href="logout.php">Logout</a></h2>
			<?php
				$sorgu2="SELECT userTypeID FROM users WHERE users.email='".$email."'" ;
				$sonuc2=$db_connect->query($sorgu2);
				while($row = $sonuc2->fetch_object()){
					$userTypeID=$row->userTypeID;
					//echo gettype($userTypeID)." ".$userTypeID;
				}
				if($userTypeID==2 ){
					echo '	<script>
								$(function() {
									$(document).ready(function() {
										$("#create_tender").remove();
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
										$("#create_tender").remove();
										$("#admin_page").remove();
									});
								});
							</script>';
				}
			?>
		</div>
	</nav>
	<!-- END OF NAVIGATION -->
	
	
	<!-- SECTION -->
	<section class="section">
		<!-- HEADER OF PROJECT/PART DETAIL PAGE ABOVE ORDER/TENDER -->
		<div class="orta2a">
			<h1>Welcome to Orderbook Order/Tender management page</h1>
			<h3><?php
					if($userTypeID==3 ){
						echo "<b>Create Order</b> - to create new orders for each part that required to be manufactured <br>
								<b>Orders</b> - to review your past orders, orders status and to view bids offered<br>
								<b>Tenders</b> - to review tenders and approve 'Total Price perPart'";
					}
					else {
						echo "<b>Create Tender</b> - to create new tender for each part that requested to be manufactured<br>
								<b>Orders</b> - to review your orders, orders status and to view bids offered<br>
								<b>Tenders</b> - to bid on tenders and send 'Offered Price'";
					}				
				?>
			</h3>
			
			<ul>
				<li></li>
				<li>In case of any query please do not hesitate to contact <a href="mailto:mvolkang@gmail.com">admin@orderbook.com</a></li>
			</ul>	
			
		</div>
		
		<!-- ORDER and TENDER BUTTONS -->
		<div class="orta2b">
			<button class="orta2b_tab">ORDERS</button>
			<button class="orta2b_tab">TENDER</button>
		</div>
		
		<!--SİPARİŞLER SİPARİŞLER SİPARİŞLER -->
		<div class="orta2c">
			<h2> </h2>
		<!-- TABLE FOR THE ORDERS-->
			<table class="siparis_takip">
				<!-- table title-->
				<caption></caption>
				<!-- first row / cell attributes/names titles -->
				<thead>
					<tr class="siparis_takip_baslik">
						<th>Order Number</th>
						<th>Customer Order Number</th>
						<th>Order Date</th>
						<th>Latest Offer Date</th>
						<th>Delivery Date</th>
						<th>Status</th>
						<th>View Tender</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
						if($userTypeID<>3){
						//DİĞER PROFİLLER İÇİN SİPARİŞLERİ GÖRÜNTÜLEME
						$sorgu2="SELECT * FROM ccreateorderdetail" ;
						}
						else{					
						///MUSTERİ PROFİLİ İÇİN SİPARİŞLERİ GÖRÜNTÜLEME
						$sorgu2="SELECT * FROM ccreateorderdetail WHERE ccreateorderdetail.userID='".$userID."'" ;
						//"SELECT * FROM ccreateorderdetail,users WHERE ccreateorderdetail.userID=users.userID AND users.email='".$email."'" ;
						}
						$sonuc2=$db_connect->query($sorgu2);
						if($sonuc2){
						
							while($row = $sonuc2->fetch_object()){
							echo "<tr>";
								
								
								$OrderDate=$row->OrderDate;      
								$mOrderNumber=$row->mOrderNumber; 								
								$cOrderNumber=$row->cOrderNumber;   
								$LatestOfferDate=$row->LatestOfferDate;
								$DeliveryDate=$row->DeliveryDate;  
								$OrderStatus=$row->orderStatus;
								$OrderMail=$row->OrderMail;      
								$DeliveryType=$row->DeliveryType ;  
								$userID=$row->userID ;       
								$mOrderMail=$row->mOrderMail;
								
							
							echo "<td><a href='orderdetail.inc.php?mOrderNumber=$mOrderNumber'>".$mOrderNumber."</a></td>";
							echo "<td>".$cOrderNumber."</td>";
							echo "<td>".$OrderDate."</td>";
							echo "<td>".$LatestOfferDate."</td>";
							echo "<td>".$DeliveryDate."</td>";
							echo "<td>".$OrderStatus."</td>";
							echo "<td><a href='musteri-teklifler-tab.php'>Go to Tender</a></td>";
							echo "</tr>";
							}
						}
					?>
					
				</tbody>
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