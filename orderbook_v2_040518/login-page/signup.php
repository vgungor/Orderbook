<?php
	include_once 'connection.php';
	session_start();
	//$email=$_SESSION['email'];
	//$userID=$_SESSION['userid'];
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	//echo "email: ".$email;
		
	$firstname=$_POST["firstname"];
	$lastname=$_POST["lastname"];
	$companyName =$_POST["companyName"];
	$email   =$_POST["email"];
	$password=$_POST["password"];
	$_SESSION['email']=$email ;

	/*
	echo $firstname;
	echo $lastname;
	echo $companyName; 
	echo $email;   
	echo $password;
	*/
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width-device-width">
		<meta name="description" content="Login-Ekrani">
		<meta name="keywords" content="order offer portal, mustafa, volkan, gungor, orderbook ">
		<meta name="author" content="MVG">

		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<link rel="stylesheet" href="style-loginpage.css">
		<title>signup.php</title>
	</head>
	<body>
		<div class="signup">
			<!--<h2>Sign Up</h2>-->
			<form action="signup-check.php" method="POST">
				<div class="personel">
				<h2>Personal Information</h2>
				<label for="firstname">First Name</label>
				<input name="firstname" type="text" value=<?php echo $firstname;?> readonly>
				<br>
				<label for="lastname">Last Name</label>
				<input name="lastname" type="text" value=<?php echo $lastname;?> readonly>
				<br>
				<label for="identityNumber">TC Identity Number</label>
				<input name="identityNumber" type="text" placeholder="tc kimlik no" required>
				<br>
				<label for="job">Job/Position</label>
				<input name="job" type="text" placeholder="çalıştığınız pozisyon" required>
				<br>
				<label for="mobile">Mobile</label>
				<input name="mobile" type="text" placeholder="05xx xxxxxxx" required>
				<br>
				<label for="email">Email</label>
				<input name="email" type="email" value=<?php echo $email;?> readonly>
				<br>
				<label for="password">Password</label>
				<input name="password" type="password" value=<?php echo $password;?> readonly>
				<br>
				</div><div class="company">
				<h2>Company Information</h2>
				<label for="companyName">Company Name</label>
				<input name="companyName" type="text" value=<?php echo $companyName;?> readonly>
				<br>
				<label for="companyWebpage">Company Webpage</label>
				<input name="companyWebpage" type="text" placeholder="şirket web adresi" required>
				<br>
				<label for="companyLogo">Company Logo</label>
				<input name="companyLogo" type="text" placeholder="zorunlu değil" required>
				<br>
				</div><div class="companyaddress">
				<h2>Company Address Information</h2>
				<label for="street">Street/No</label>
				<input name="street" type="text" placeholder="sokak" required>
				<br>
				<label for="postalCode">Postal Code</label>
				<input name="postalCode" type="text" placeholder="posta kodu" required>
				<br>

				<label for="country">Country</label>
				<input name="country" type="text" placeholder="ülke" required>
				<br>
				<label for="city">City</label>
				<input name="city" type="text" placeholder="il" required>
				<br>
				<label for="district">District</label>
				<input name="district" type="text" placeholder="ilçe" required>
				<br>
				<label for="companyPhone">Company PBX Phone</label>
				<input name="companyPhone" type="text" placeholder="+Country Code xxx xxxxx" required>
				<br>
				<label for="companyFax">Fax</label>
				<input name="companyFax" type="text" placeholder="Fax" required>
				<br>
				<label for="companyMobile">Company PBX Mobile</label>
				<input name="companyMobile" type="text" placeholder="+Country Code xxx xxxxx" required>
				<br>
				<button type="reset" id="sbtnreset">Reset Form</button>
				<button type="submit" id="sbtnsignup">Sign Up</button>
				</div>
			</form>
		</div><!-- end of signup -->
	</body>
</html>
