<?php
	include_once 'connection.php';
	
	session_start();
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	//echo "email: ".$email;
	//echo "userID: ".$userID;
	
	$sorgu1="SELECT * FROM users, company WHERE company.companyID=users.companyID AND users.email='".$email."'" ;
	$sonuc1=$db_connect->query($sorgu1);
	while($row = $sonuc1->fetch_object()){
		//$usersname=$row->usersname;
		$companyname=$row->name;
		$userID=$row->userID;
		$firstname=$row->firstName;
		$lastname=$row->lastName;
		$identityNumber=$row->identityNumber;
		$job=$row->job;
		$mobile=$row->mobile;
		$password=$row->password;

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
	<title>user details</title>
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
				<h3 class="ust2a_1" ><a href="#"><?php echo $firstname." ".$lastname;?></a></h3>
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
			<h1>User details</h1>
			<h3>Click on <b>'Update User Info'</b> to update information </h3>
			<ul>
				<li>  
				</li>
				<li>In case of any query please do not hesitate to contact admin@orderbook.com</li>
			</ul>	
		</div>
		
	<!--SİPARİŞLER SİPARİŞLER SİPARİŞLER -->
		<div class="orta2c">
			<div class="siparis_olusturma_orta2c">
				<h2></h2>
				<form action="update-user-info.php" method="POST">
				<label for="firstname">First Name</label>
				<input name="firstname" type="text" value=<?php echo $firstname;?>>
				<br>
				<label for="lastname">Last Name</label>
				<input name="lastname" type="text" value=<?php echo $lastname;?> >
				<br>
				<label for="identityNumber">TC Identity Number</label>
				<input name="identityNumber" type="text" value=<?php echo $identityNumber;?> readonly>
				<br>
				<label for="job">Job/Position</label>
				<input name="job" type="text" value=<?php echo $job;?> >
				<br>
				<label for="mobile">Mobile</label>
				<input name="mobile" type="text" value=<?php echo $mobile;?> >
				<br>
				<label for="email">Email</label>
				<input name="email" type="email" value=<?php echo $email;?> >
				<br>
				<label for="password">Password</label>
				<input name="password" type="text" value=<?php echo $password;?> >
				<br>
				<button type="reset" id="sbtnreset">Reset Form</button>
				<button type="submit" id="sbtnsignup">Update User Info</button>
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