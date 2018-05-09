<?php
require_once '../../../ConfigDB.php';


	if($_POST)
	{

		$vehicleId = $_POST['VehicleID'];
		$registration = $_POST['Registration'];
		$brand = $_POST['Brand'];
		$department = $_POST['Department'];
		$odometer = $_POST['Odometer'];
		$numOfseats = $_POST['Num_of_seats'];
		$dateInsuranceEX = $_POST['DateInsuranceExp'];
		// $vehicleStatus = $_POST[' '];
		$typeId = $_POST['TypeID'];
		$date = date_create_from_format('j/m/Y', $dateInsuranceEX);
		$dateInsurance = date_format($date, 'Y/m/d');




		// $id = $_GET['VehicleID'];
		$stmt_edit = $conn->prepare('SELECT Picture FROM vehicle WHERE VehicleID =:uid');
		$stmt_edit->execute(array(':uid'=>$vehicleId));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);

		$imgFile = $_FILES['Vehicle_image']['name'];
		$tmp_dir = $_FILES['Vehicle_image']['tmp_name'];
		$imgSize = $_FILES['Vehicle_image']['size'];

		if($imgFile)
		{
			$upload_dir = '../../../images/Vehicles-Images/'; // upload directory
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$vehiclepic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['Picture']);
					move_uploaded_file($tmp_dir,$upload_dir.$vehiclepic);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			}
		}
		else
		{
			// if no image selected the old image remain as it is.
			$vehiclepic = $edit_row['Picture']; // old image from database
		}


      try{

  			$stmt = $conn->prepare("UPDATE `vehicle` SET
									`Registration`= :registration,
									 `Brand`= :brand,
									 `Picture`= :picture,
									 `Odometer`= :odometer,
									 `Num of seats`= :numOfseats,
									 `Date insurance expires`=:dateInsurance,
									 `TypeID`= :typeId ,
									 `Department`= :Dept
									WHERE `VehicleID`= :vehicleId ");

				$stmt->bindParam(":registration", $registration);
  			$stmt->bindParam(":brand", $brand);
  			$stmt->bindParam(":picture", $vehiclepic);
        $stmt->bindParam(":odometer",$odometer);
        $stmt->bindParam(":numOfseats", $numOfseats);
        $stmt->bindParam(":dateInsurance",$dateInsurance);
				$stmt->bindParam(":typeId",$typeId);
				$stmt->bindParam(":Dept", $department);
				$stmt->bindParam(":vehicleId", $vehicleId);
				// $stmt->debugDumpParams();
  			if($stmt->execute())
  			{
  				echo "แก้ไขข้อมูลเรียบร้อย";
  			}
  			else{
  				echo "ไม่สามารถแก้ไขข้อมูลได้";
  			}
  		}
      catch(PDOException $e){
  			echo $e->getMessage();

  		}




	}

?>
