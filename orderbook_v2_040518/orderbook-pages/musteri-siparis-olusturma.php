<?php
	include_once 'connection.php';
	session_start();
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	//echo "email: ".$email;
	
	$sorgu1="SELECT concat(users.firstname,' ',users.lastname) as usersname, company.name, users.userID FROM users,company WHERE company.companyID=users.companyID AND users.email='".$email."'" ;
	$sonuc1=$db_connect->query($sorgu1);
	while($row = $sonuc1->fetch_object()){
		$usersname=$row->usersname;
		$companyname=$row->name;
		$userID=$row->userID;
	}
	$sorgu2="SELECT CONCAT(companyaddress.street,' ',companyaddress.postalCode,' ',companyaddress.district,'/',companyaddress.city,'/',companyaddress.country) AS address, company.name, companyaddress.companyPhone 
				FROM companyaddress,company,users
				WHERE companyaddress.companyID=users.companyID AND company.companyID=users.companyID AND users.userID='".$userID."'";
	$sonuc2=$db_connect->query($sorgu2);
	while($row = $sonuc2->fetch_object()){
		$address=$row->address;
		$companyname=$row->name;
		$companyPhone=$row->companyPhone;
	}
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
	<title>siparis-olusturma</title>
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
				$sorgu3="SELECT userTypeID FROM users WHERE users.email='".$email."'";
				//echo $sorgu3;
				$sonuc3=$db_connect->query($sorgu3);
				while($row = $sonuc3->fetch_object()){
					$userTypeID=$row->userTypeID;
					//echo $userTypeID;
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
			<h1>Welcome to Order Creation</h1>
			<h2></h2>
			<p>Please fill the form with order and part information and click on "SAVE ORDER" to save the order<br>
			Saved orders can be reviewed on <b>Orders</b> tab </p>	
			<ul>
				<li></li>
				<li>In case of any query please do not hesitate to contact <a href="mailto:mvolkang@gmail.com">admin@orderbook.com</a></li>
			</ul>
		</div>
		
		
		<!--SİPARİŞLER SİPARİŞLER SİPARİŞLER -->
		<div class="orta2c">
			<div class="siparis_olusturma_orta2c">
				<h2>ORDER CREATION</h2>
				<form action="create-order.php" method="POST">
					<div>
						<label for="siparis_tarihi">Order Date:</label>
						<input name="siparis_tarihi" id="siparis_tarihi" value="<?php echo date("Y-m-d H:i:s") ?>">
					</div>
					<!--
					<div>
						sipariş oluşturulduktan sonra sistemden alınacak -->
						<!--
						<label for="siparis_no">Talep/Sipariş no:</label>
						<input name="siparis_no" id="siparis_no" type="hidden">
					</div>
					-->
					<div>
						<label for="cOrderNumber">Customer Order Number:</label>
						<input name="cOrderNumber" id="cOrderNumber" type="text">
					</div>
					<div>
						<label for="son_tarih">Latest Offer Date:</label>
						<input name="son_tarih" id="son_tarih" type="date">
					</div>
					<div>
						<label for="teslimat_tarihi">Delivery Date:</label>
						<input name="teslimat_tarihi" id="teslimat_tarihi" type="date">
					</div>
					<div>
						<label for="teklif_mail">Order mail(as attachement): </label>
						<input name="teklif_mail" id="teklif_mail" type="text">
					</div>
					<div>
						<label for="teslimat_sekli">Delivery Type/Location: </label>
						<input name="teslimat_sekli" id="teslimat_sekli" type="text">
					</div>
					<div>
						<label for="teslimat_adresi">Delivery Address: </label>
						<textarea name="teslimat_adresi" id="teslimat_adresi"><?php echo $companyname." ".$companyPhone." ".$address ?></textarea>
					</div>
					<div>
						<h3>Part Information</h3>
					</div>
					<div>
						<label for="parca_adı">Part Name:</label>
						<input name="parca_adı" id="parca_adı" type="text">
					</div>
					<div>
						<label for="parca_numara">Part Number:</label>
						<input name="parca_numara" id="parca_numara" type="text">
					</div>
					<div>
						<label for="parca_adet">Part Quantity:</label>
						<input name="parca_adet" id="parca_adet" type="text">
					</div>
					<div>
						<label for="parca_yapilisi">Part Execution: </label>
						<textarea name="parca_yapilisi" id="parca_yapilisi"></textarea>
					</div>
					<div>
						<label for="parca_teknik_cizim">Part Technical Drawing:</label>
						<input name="parca_teknik_cizim" id="parca_teknik_cizim" type="text">
					</div>
					<div>
						<label for="parca_malzeme">Part Material:</label>
						<input name="parca_malzeme" id="parca_malzeme" type="text">
					</div>
					<div>
						<label for="parca_aciklama">Part Details/Explanation: </label>
						<textarea name="parca_aciklama" id="parca_aciklama"></textarea>
					</div>
					<div>
						<label for="model_kontrol">Is Model available: </label>
						<select name="model_kontrol" id="model_kontrol">
						<option value="1">Yes</option>
						<option value="0">No Models available</option>
						</select>
					</div>
					<div>
						<label for="model_no">Model Number: </label>
						<input name="model_no" id="model_no" type="text">
					</div>
					<div>
						<label for="model_adi">Model Name: </label>
						<input name="model_adi" id="model_adi" type="text">
					</div>
					<div>
						<label for="model_yeri">Current Model location: </label>
						<input name="model_yeri" id="model_yeri" type="text">
					</div>
					<div>
						<label for="model_contact">Model Contact: </label>
						<input name="model_contact" id="model_contact" type="text">
					</div>
					<div>
						<label for="model_contact_telefon">Model Contact Phone: </label>
						<input name="model_contact_telefon" id="model_contact_telefon" type="text">
					</div>
					<div>
						
						<button type="submit">Save Order</button>
						<button>Add part</button>
						<button type="reset">Reset Form</button>
					</div>
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