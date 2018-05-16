<?php
	include_once 'connection.php';
	
	session_start();
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	//echo "email: ".$email;
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
	<title>MVG OrderBook</title>
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
	</header>
	<!-- END OF DEFAULT PAGE HEADER -->
	
	
	<!-- SECTION -->
	<section class="admin_section">
		<!-- HEADER OF PROJECT/PART DETAIL PAGE ABOVE ORDER/TENDER -->
		<div class="admin_orta1">
			<h1>ADMIN PAGE</h1>

			<!-- TABLE FOR THE USERS-->
			<table>
				<tr>
					<th>First name</th>
					<th>Last name</th>
					<th>E-mail</th>
					<th>Company</th>
					<th>Password</th>
					<th>Register date</th>
					<th>UserType</th>
					<th>Block User</th>
					<th>Delete / Update</th>
				</tr>
				<?php
				include_once 'connection.php';
					$sorgu1 = "SELECT users.firstName, users.lastName, users.email, company.name, users.password, users.blockedStatus, users.RegisterTime, users.userTypeID
									FROM users, company WHERE users.companyID=company.companyID ORDER BY users.RegisterTime DESC";
					$sonuc1 = $db_connect->query($sorgu1);
					while ($row = $sonuc1->fetch_object()) {
						$firstname = htmlentities($row->firstName, ENT_QUOTES, "UTF-8");
						$lastname = htmlentities($row->lastName, ENT_QUOTES, "UTF-8");
						$email = htmlentities($row->email, ENT_QUOTES, "UTF-8");
						$password = htmlentities($row->password, ENT_QUOTES, "UTF-8");
						$companyname = htmlentities($row->name, ENT_QUOTES, "UTF-8");
						$userTypeID = $row->userTypeID;
						$blockedStatus = $row->blockedStatus;
						$RegisterTime = $row->RegisterTime;
					//echo $userTypeID;
					//UPDATE USER
					echo '<tr><td><form action="update-user.php" method="POST">';
					echo '<input type="text" name="firstname" value="'.$firstname.'" readonly></td>';
					echo '<td><input type="text" name="lastname" value="'.$lastname.'" readonly></td>';
					echo '<td><input type="email" name="email" value="'.$email.'" readonly></td>';
					echo '<td><input type="text" name="company" value="'.$companyname.'" readonly></td>';
					echo '<td><input type="text" name="password" value="'.$password.'"></td>';
					echo '<td>'.$RegisterTime.'</td>';
					echo '<td><select name="usertypeID" id="usertypeID">';
						echo '<option value="1"'.($userTypeID==1 ? 'selected' : '').'>Admin</option>';
						echo '<option value="2"'.($userTypeID==2 ? 'selected' : '').'>Üretici</option>';
						echo '<option value="3"'.($userTypeID==3 ? 'selected' : '').'>Müşteri</option>';
						echo '<option value="4"'.($userTypeID==4 ? 'selected' : '').'>Tedarikçi</option>';
						echo '<option value="4"'.($userTypeID==5 ? 'selected' : '').'>Not assigned</option>';
						echo '</select>';
					echo '</td>';					
					echo '<td><input type="checkbox" name="block_user" id="block_user"'.($blockedStatus==1 ? 'checked' : '').'></td>';
					echo '<td><input id="updatebutton" type="submit" value="Update"></form>';
						//DELETE USER
						echo '<form action="delete-user.php" method="POST">';
							echo '<!--email is sent as hidden attribute-->';
							echo '<input type="hidden" name="email" value="'.$email.'" readonly>';
							echo '<input id="deletebutton" type="submit" value="Delete">';
						echo '</form>';
					echo '</td>';
					echo '<!-- BUTONA BASILDIĞINDA USER SİLİNEREK DELETED USERS TABLOSUNA TAŞINACAK HEM JS SCRIPT HEM DE DB TRİGGER VE YENİ TABLO GEREKİYOR	-->';
				echo '</tr>';
				}
					
				?>

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