
<?php
	include_once 'connection.php';
	
	session_start();
	//echo " Inside session  id:".$_SESSION['id']." userID:". $_SESSION['userid']." email:".$_SESSION['email'];
	$email=$_SESSION['email'];
	$userID=$_SESSION['userid'];
	$mOrderNumber=$_GET['mOrderNumber'];
	//echo "email: ".$email;
	
	$sorgu1="SELECT concat(users.firstname,' ',users.lastname) as usersname, company.name, users.userID FROM users,company WHERE company.companyID=users.companyID AND users.email='".$email."'" ;
	$sonuc1=$db_connect->query($sorgu1);
	while($row = $sonuc1->fetch_object()){
		$usersname=$row->usersname;
		$companyname=$row->name;
		$userID=$row->userID;
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
			
			$sorgu4="SELECT * FROM models WHERE  modelID='".$modelID."'" ;
			echo $sorgu4."<br>";
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
			}
			
		}
	}
	
?>