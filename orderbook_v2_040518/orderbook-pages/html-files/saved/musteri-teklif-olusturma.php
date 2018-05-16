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
	<title>Teklif-Oluşturma</title>
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
			<h2 class="orta1a"><a href="musteri-teklif-olusturma.php">Create Tender</a></h2>
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
			<h1>Firma Adı</h1>
			<h2>Teklif oluşturma sayfasına hoşgeldiniz</h2>
			<p>Lütfen teklifiniz ile ilgili bilgileri doldurduktan sonra "TEKLİFİ GÖNDER" tuşuna basarak teklifinizi gönderiniz.
			Kaydedilen tekliflerinizi "Projeler" sekmesinde "Teklifler" tabı altında inceleyebilirsiniz</p>	
		</div>
		
		
		<!-- TEKLİF OLUŞTURMA TEKLİF OLUŞTURMA TEKLİF OLUŞTURMA-->
		<div class="orta2c">
			<div class="teklif_olusturma_orta2c">
				<h2>TEKLİF OLUŞTURMA TAB</h2>
				<?php 
				
				
				?>
					<ul>
						<li><label for="siparis_no">Talep/Sipariş no:</label><input name="siparis_no" id="siparis_no" type="text" readonly></li>
						<li><label for="siparis_tarihi">Talep/Sipariş tarihi:</label><input name="siparis_tarihi" id="siparis_tarihi" type="date" readonly></li>
						<li><label for="son_tarih">Teklif verme son tarihi:</label><input name="son_tarih" id="son_tarih" type="date" readonly></li>
						<li><label for="teslimat_tarihi">Teslimat tarihi:</label><input name="teslimat_tarihi" id="teslimat_tarihi" type="date" readonly></li>
					</ul>
				
				<form>
					<table class="teklif_olusturma">
						<thead>
							<tr class="teklif_olusturma_baslik">
								<th>Order</th>
								<th>Part</th>
								<th>Quantity</th>
								<th>Model </th>
								<th>Unit Price</th>
								<th>Total Price</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>#1 -incremental-</td>
								<td>-disabled-</td>
								<td>-disabled-</td>
								<td>-disabled-</td>
								<td><input type="text"> </td>
								<td>ParçaAdet * Birim Fiyat</td>
							</tr>
							<tr>
								<td>#2 -incremental-</td>
								<td>-disabled-</td>
								<td>-disabled-</td>
								<td>-disabled-</td>
								<td><input type="text"> </td>
								<td>ParçaAdet * Birim Fiyat</td>
							</tr>
					</table>
						<button type="submit">Teklifi Gönder</button>
						<button type="reset">Formu sil</button>
					
				</form>
			</div>
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