<?php
session_start();
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		// $name = $_POST['VHO-Fname'];
		// $mainId = $_POST[' '];
		$description = $_POST['Description'];
		$datemain = $_POST['M-Date'];
		$timemain = $_POST['M-Time'];
		$vehicleId = $_POST['VehicleID'];
		$officerId = $_SESSION['user_session'];

		$date = date_create_from_format('j/m/Y', $datemain);
		$datemain = date_format($date, 'Y/m/d');

      try{

  			$stmt = $conn->prepare("INSERT INTO `maintenance`(`Description`, `DateMain`, `TimeMain`, `VehicleID`, `OfficerID`)
																VALUES(:description, :datemain, :timemain, :vehicleId, :officerId)");
  			// $stmt->bindParam(":mainId", $typeId);
  			$stmt->bindParam(":description", $description);
				$stmt->bindParam(":datemain", $datemain);
				$stmt->bindParam(":timemain", $timemain);
				$stmt->bindParam(":vehicleId", $vehicleId);
				$stmt->bindParam(":officerId", $officerId);


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
