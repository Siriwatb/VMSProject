<?php
session_start();
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		$startTime = $_POST['StartTime'];
		$endTime = $_POST['EndTime'];
		$startDate = $_POST['StartDate'];
		$date1 = date_create_from_format('j/m/Y', $startDate);
		$dateS = date_format($date1, 'Y/m/d');
		$endDate = $_POST['EndDate'];
		$date2 = date_create_from_format('j/m/Y', $endDate);
		$dateE = date_format($date2, 'Y/m/d');
        $NumPeople = $_POST['numSeat'];
        $Destination = $_POST['destination'];
		$Reason = $_POST['reason'];
		$appointment = $_POST['appointment'];
		$car = $_POST['arrayCar'];
		$arrayCar = eval("return array(" . $car . ");"); 
		//  echo count($arrayCar);
		// $date = date_create_from_format('j/m/Y', $datemain);	
		// $datemain = date_format($date, 'Y/m/d');
		
        $offID = $_SESSION['user_session'];
		$conn->beginTransaction();
      try{

  			$stmt = "INSERT INTO `using`( `Destination`, `Start Date`, `Appointment`, `End Date`, `Start Time`, `End Time`,  `Reason`, `NumPeople`, `OffBookID`) VALUES 
              ('$Destination','$dateS','$appointment','$dateE',' $startTime','$endTime','$Reason','$NumPeople','$offID')";
  			// $stmt->bindParam(":startTime", $startTime);
  			// $stmt->bindParam(":endTime", $endTime);
  			// $stmt->bindParam(":stDate", $startDate);
			// $stmt->bindParam(":enDate",$endDate);
			// $stmt->bindParam(":NumPeople",$NumPeople);
			// $stmt->bindParam(":Destination",$Destination);
			// $stmt->bindParam(":Reason",$Reason);
			// $stmt->bindParam(":perID",$_SESSION['user_session']);

			$conn->exec($stmt);
			$lastid= $conn->lastInsertId();
			

		for ($i=0; $i < count($arrayCar) ; $i++) { 
			$num = $i+1;
			$vhID = $arrayCar[$i];
			$stmt = "INSERT INTO `list_using`(`VehicleNo`, `VehicleID`, `UsingID`) VALUES ('$num','$vhID','$lastid')";
			// $stmt->bindParam(":vhNo", $i+1 );
			// $stmt->bindParam(":vhID", $arrayCar[$i]);
			//   $stmt->bindParam(":UsingID", $lastid+1);
			  $conn->exec($stmt);
		}

			
		echo $vhID;
			
		


  			if($conn->commit())
  			{
  				echo "เพิ่มข้อมูลสำเร็จ";
  			}
  			else{
  				echo "การเพิ่มข้อมูลมีปัญหา";
			}
	  
  		}
      catch(PDOException $e){
			  echo $e->getMessage();
			  $conn->rollback();
  		}




	}

?>
