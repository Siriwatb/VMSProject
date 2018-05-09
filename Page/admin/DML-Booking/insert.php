<?php
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		$startTime = $_POST['startTime'];
		$endTime = $_POST['endTime'];
		$startDate = $_POST['stDate'];
		$endDate = $_POST['enDate'];
        $NumPeople = $_POST['NumPeople'];
        $Destination = $_POST['Destination'];
         $Reason = $_POST['Reason'];
       


      try{

  			$stmt = $conn->prepare("INSERT INTO `using`( `Approve Status`, `Using Status`, `Destination`, `Start Date`, `Appointment`, `End Date`, `Start Time`, `End Time`, `Approve Date`, `Reason`, `NumPeople`, `Controller`, `Budget`, `OfficerID`, `PersonnelID`) VALUES 
              (:startTime,:endTime,:stDate,:enDate,:NumPeople,:Destination,:Reason)");
  			$stmt->bindParam(":startTime", $startTime);
  			$stmt->bindParam(":endTime", $endTime);
  			$stmt->bindParam(":stDate", $startDate);
        $stmt->bindParam(":enDate",$endDate);
        $stmt->bindParam(":NumPeople",$NumPeople);
        $stmt->bindParam(":Destination",$Destination);
        $stmt->bindParam(":Reason",$Reason);

  			if($stmt->execute())
  			{
  				echo "เพิ่มข้อมูลสำเร็จ";
  			}
  			else{
  				echo "การเพิ่มข้อมูลมีปัญหา";
  			}
  		}
      catch(PDOException $e){
  			echo $e->getMessage();
  		}




	}

?>
