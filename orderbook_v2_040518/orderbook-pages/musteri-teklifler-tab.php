<?php
	include_once 'connection.php';
	
	session_start();
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	//echo "email: ".$email;
	
	$sorgu1="SELECT concat(users.firstname,' ',users.lastname) as usersname, company.name, users.userID FROM users,company WHERE company.companyID=users.companyID AND users.email='".$email."'" ;
	$sonuc1=$db_connect->query($sorgu1);
	while($row = $sonuc1->fetch_object()){
		$usersname=$row->usersname;
		$companyname=$row->name;
		$userID=$row->userID;
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
	<title>teklifler-tab</title>
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
			<h2 id="orders" class="orta1a"><a href="musteri-siparisler-tab.php">Orders</a></h2>
			<h2 id="tenders" class="orta1a"><a href="musteri-teklifler-tab.php">Tenders</a></h2>
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
			<h1>
				<?php
					if($userTypeID==3 ){
						echo "Approve offered prices for Tenders";
					}
					else {
						echo "Sent price bids for Offers";
					}				
				?>
				</h1>
			<h3><?php
					if($userTypeID==3 ){
						echo "Click on <b>'Approve Price'</b> to approve price and to update offer status <br>
								Click on <b>'Order Number'</b> to review the details of offers and parts";
					}
					else {
						echo "Enter your offer per part into 'Unit Price perPart' and click on <b>'Sent Offered Price'</b><br>
								Click on <b>'Order Number'</b> to review the details of offers and parts";
					}				
				?>
			</h3>
			<ul>
				<li><?php
					if($userTypeID==3 ){
						echo "";
					}
					else {
						echo "Empty 'Unit Price perPart' means <b>no price bid sent</b>";
					}				
				?>
				</li>
				<li>In case of any query please do not hesitate to contact admin@orderbook.com</li>
			</ul>	
		</div>
		
		<!-- ORDER and TENDER BUTTONS -->
		<div class="orta2b">
			<button class="orta2b_tab">ORDERS</button>
			<button class="orta2b_tab">TENDER</button>
		</div>
		
		<!--TEKLİFLER TEKLİFLER TEKLİFLER -->
		<div class="orta2c">
			<h2></h2>
		<!-- TABLE FOR THE TENDER-->
			<table class="teklif_takip">
				<!-- table title-->
				<caption></caption>
				<!-- first row / cell attributes/names titles -->
				<thead>
					<tr class="teklif_takip_baslik">
						<th>Order Number</th>
						<th>Customer Order Number</th>
						<th>Latest Offer Date</th>
						<th>Part Name</th>
						<th>Part Number</th>
						<th>Quantity</th>
						<?php
						if($userTypeID<>3){
							echo "<th>Unit Price perPart</th>";
						}
						else {
							// MÜŞTERİ için
							echo "<th>Total Price perPart</th>";
						}
						?>
						<!--<th>Tender Date</th>-->
						<?php
						//TEDARİKÇİ İSE
						if($userTypeID==4){
							echo "<th>Sent Offered Price</th>";
						}
						//MÜŞTERİ İSE
						else if($userTypeID==3){
							echo "<th>Approve Price</th>";
						}
						//ADMIN veya URETİCİ İSE
						else{
							echo "<th>Select Bid to Cust.</th>";
						}
						?>
					</tr>
				</thead>
				<tbody>
				<?php
					if($userTypeID==4){
						//ÜRETİCİ VE TEDARİKÇİLERİN VERDİKLERİ TEKLİFLERİN MÜŞTERİ TARAFINDAN GÖRÜNMESİ İÇİN
						$sorgu2="SELECT * FROM ccreateorderdetail,ccreateorderdetailpartinfo,ccreateorderpk WHERE ccreateorderdetail.mOrderNumber=ccreateorderpk.mOrderNumber AND ccreateorderpk.partID=ccreateorderdetailpartinfo.partID" ;
					}
					else if($userTypeID==3){
						//MÜŞTERİLERİN KENDİ VERDİKLERİ SİPARİŞLERİN KARŞILIĞI TEKLİFLERİ GÖRMESİ İÇİN
						$sorgu2="SELECT * FROM ccreateorderdetail,ccreateorderdetailpartinfo,ccreateorderpk WHERE ccreateorderdetail.mOrderNumber=ccreateorderpk.mOrderNumber AND ccreateorderpk.partID=ccreateorderdetailpartinfo.partID AND ccreateorderdetail.userID='".$userID."'" ;
					//SELECT * FROM ccreateorderdetail,ccreateorderdetailpartinfo,ccreateorderpk WHERE ccreateorderdetail.mOrderNumber=ccreateorderpk.mOrderNumber AND ccreateorderpk.partID=ccreateorderdetailpartinfo.partID
					}
					else{
						$sorgu2="SELECT ccreateorderdetail.mOrderNumber, ccreateorderdetail.cOrderNumber, ccreateorderdetail.LatestOfferDate , 
										ccreateorderdetail.userID,ccreateorderdetailpartinfo.partName , ccreateorderdetailpartinfo.partID, 
										ccreateorderdetailpartinfo.partQuantity , ccreateorderdetailpartinfo.partNumber ,supplierbidperpart.BidperPart   
											FROM supplierbidperpart, ccreateorderdetail,ccreateorderdetailpartinfo,ccreateorderpk 
											WHERE supplierbidperpart.partID=ccreateorderdetailpartinfo.partID 
											AND ccreateorderdetail.mOrderNumber=ccreateorderpk.mOrderNumber 
											AND ccreateorderpk.partID=ccreateorderdetailpartinfo.partID
											ORDER BY ccreateorderdetail.mOrderNumber";
					}
					$sonuc2=$db_connect->query($sorgu2);
					if($sonuc2){
						while($row = $sonuc2->fetch_object()){
							echo "<tr>";
							
							$partID=$row->partID;
							//echo $partID;
							$mOrderNumber=$row->mOrderNumber;
							$cOrderNumber=$row->cOrderNumber;
							$LatestOfferDate=$row->LatestOfferDate;
							$partName=$row->partName;
							$partNumber=$row->partNumber;
							$partQuantity=$row->partQuantity;
							if($userTypeID==4){
								$unitPriceToM=$row->unitPriceToM;
							}
							else if($userTypeID==2 || $userTypeID==1) {
								$BidperPart=$row->BidperPart;
							}
							else{
								$unitPriceToM=$row->unitPriceToM;
								$totalPrice=$partQuantity*$unitPriceToM;
							}
							
							//$timeinfo=date("Y-m-d H:i:s");
							echo "<tr><td><a href='tenderdetail.inc.php?mOrderNumber=$mOrderNumber'>".$mOrderNumber."</a></td>";
							echo "<td>".$cOrderNumber."</td>";
							echo "<td>".$LatestOfferDate."</td>";
							echo "<td>".$partName."</td>";
							echo "<td>".$partNumber."</td>";
							echo "<td>".$partQuantity."</td>";
							//TEDARİKÇİ FİYAT TEKLİFİ BAŞKA TABLOYA GİDECEK sentOfferedPrice.php DEĞİŞİKLİK GEREKİYOR
							if($userTypeID==4){
								$sorgu12="SELECT BidperPart	FROM supplierbidperpart WHERE SupplierID=$userID AND PartID=$partID";
								//echo $sorgu12;
								$sonuc12=$db_connect->query($sorgu12);
								if($row = $sonuc12->fetch_object()){
									$BidperPart=$row->BidperPart;
								}
								else{
									$BidperPart=0;
								}
								echo "<td><form action='sentOfferedPrice.php' method='POST'>
											<input type='text' name='OfferedPrice' id='OfferedPrice' value='$BidperPart'></td>";
							}
							//MÜŞTERİ TOPLAM FİYATI GÖRECEK
							else if($userTypeID==3){	
								echo "<td>".$totalPrice."</td>";
							}
							//ÜRETİCİ BÜTÜN FİYATLARI GÖRECEK VE ARALARINDAN SEÇECEĞİ - $unitPriceToM YAZILACAK
							else{
								
								/*
								$sorgu13="SELECT MIN(BidperPart) AS minBidPerPart FROM supplierbidperpart WHERE PartID=$partID";
								//echo $sorgu13;
								$sonuc13=$db_connect->query($sorgu13);
								if($row = $sonuc13->fetch_object()){
									$BidperPart=$row->minBidPerPart;
								}
								else{
									$BidperPart=0;
								}
								*/
								echo "<td><form action='sentOfferedPrice.php' method='POST'>
											<input type='text' name='OfferedPrice' id='OfferedPrice' value='$BidperPart'></td>";
							}
							//echo "<td>".$timeinfo."</td>";
							
							if($userTypeID==4){

								echo "<td>";
								$sorgu3="SELECT partID FROM ccreateorderpk where mOrderNumber='".$mOrderNumber."'";
								//echo $sorgu3;
								$sonuc3=$db_connect->query($sorgu3);
								if($row = $sonuc3->fetch_object()){
									$partID=$row->partID;
								}
								echo "<input name='partID' id='partID' type='hidden' value='$partID'>";
								echo "<button name='sentOfferedPrice' id='sentOfferedPrice' type='submit'>Sent Offered Price</button>";
								echo "</form>";
								echo "</td>";
							}
							else if($userTypeID==3) {
								echo "<td><form action='approve-price.php' method='POST'>";
								$sorgu3="SELECT partID FROM ccreateorderpk where mOrderNumber='".$mOrderNumber."'";
								//echo $sorgu3;
								$sonuc3=$db_connect->query($sorgu3);
								if($row = $sonuc3->fetch_object()){
									$partID=$row->partID;
								}
								echo "<input name='partID' id='partID' type='hidden' value='$partID'>";
								echo "<input name='priceApprove' id='priceApprove' type='submit' value='Approve Price'></form></td>";
							}
							else{
								echo "<td>";
								$sorgu3="SELECT partID FROM ccreateorderpk where mOrderNumber='".$mOrderNumber."'";
								//echo $sorgu3;
								$sonuc3=$db_connect->query($sorgu3);
								if($row = $sonuc3->fetch_object()){
									$partID=$row->partID;
								}
								echo "<input name='partID' id='partID' type='hidden' value='$partID'>";
								echo "<button name='selectBidToCust' id='selectBidToCust' type='submit'>Select Bid to Cust.</button>";
								echo "</form>";
								echo "</td>";
							}
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