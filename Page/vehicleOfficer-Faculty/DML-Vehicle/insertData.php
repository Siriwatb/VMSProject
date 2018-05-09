<?php
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		// $name = $_POST['VHO-Fname'];
		$vehicleId = $_POST['VehicleID'];
		$registration = $_POST['Registration'];
		$brand = $_POST['Brand'];

		$odometer = $_POST['Odometer'];
		$numOfseats = $_POST['Num_of_seats'];
		$Department = $_POST['Department'];
		$dateInsuranceEX = $_POST['DateInsuranceExp'];
		// $vehicleStatus = $_POST[' '];
		// $dateInsuranceEx = date('Y-m-d', strtotime(str_replace('-', '/', $dateInsuranceEX)));
		$date = date_create_from_format('j/m/Y', $dateInsuranceEX);
		$dateInsurance = date_format($date, 'Y/m/d');
		$typeId = $_POST['TypeID'];
		// $vImage = $_POST['Vehicle_image'];

		$imgFile = $_FILES['Vehicle_image']['name'];
		$tmp_dir = $_FILES['Vehicle_image']['tmp_name'];
		$imgSize = $_FILES['Vehicle_image']['size'];

		$upload_dir = '../../../images/Vehicles-Images/'; // upload directory

			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

			// rename uploading image
			$vehiclepic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions)){
				// Check file size '5MB'
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$vehiclepic);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			}

      try{

  			$stmt = $conn->prepare("INSERT INTO `vehicle`(`VehicleID`, `Registration`, `Brand`, `Picture`, `Odometer`,  `Num of seats`, `Date insurance expires`, `TypeID` ,`Department`  )
																							VALUES(:vehicleId, :registration, :brand, :picture, :odometer, :numOfseats, :dateInsuranceEX , :typeId , :Dept )");
  			$stmt->bindParam(":vehicleId", $vehicleId);
  			$stmt->bindParam(":registration", $registration);
  			$stmt->bindParam(":brand", $brand);
				$stmt->bindParam(":picture", $vehiclepic);
				$stmt->bindParam(":odometer", $odometer);
				$stmt->bindParam(":numOfseats", $numOfseats);
				$stmt->bindParam(":dateInsuranceEX", $dateInsurance);
			  $stmt->bindParam(":Dept", $Department);
				$stmt->bindParam(":typeId", $typeId);


  			if($stmt->execute())
  			{
  				echo "Successfully Added";
  			}
  			else{
  				echo "Query Problem";
  			}
  		}
      catch(PDOException $e){
  			echo $e->getMessage();
  		}




	}

?>
