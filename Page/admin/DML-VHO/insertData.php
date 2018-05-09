<?php
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		$name = $_POST['VHO-Fname'];
		$lastname = $_POST['VHO-Lname'];
		$OfficerID = $_POST['OfficerID'];
		$fullname = $name .= ' '. $lastname;
		$Position = $_POST['VHO-Position'];
    $office = $_POST['VHO-office'];
    $Address = $_POST['VHO-Address'];
    $Tel = $_POST['VHO-Tel'];
    $username = $_POST['username'];


      try{

  			$stmt = $conn->prepare("INSERT INTO `officer_vehicles`(`OfficerID`, `Username`, `Name`, `Address`, `Telephone_number`, `Position`, `Office`) VALUES(:offId, :username, :name,:address,:tel,:position,:office)");
  			$stmt->bindParam(":offId", $OfficerID);
  			$stmt->bindParam(":name", $fullname);
  			$stmt->bindParam(":position", $Position);
        $stmt->bindParam(":office",$office);
        $stmt->bindParam(":address",$Address);
        $stmt->bindParam(":tel",$Tel);
        $stmt->bindParam(":username",$username);

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
