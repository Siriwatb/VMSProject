<?php
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		$name = $_POST['VHO-Fname'];
		$lastname = $_POST['VHO-Lname'];
		$OfficerID = $_POST['OfficerID'];
		$fullname = $name .= ' ' . $lastname;
		$Position = $_POST['VHO-Position'];
    $office = $_POST['VHO-office'];
    $Address = $_POST['VHO-Address'];
    $Tel = $_POST['VHO-Tel'];
    $username = $_POST['VHO-username'];


      try{

  			$stmt = $conn->prepare("UPDATE `officer_vehicles` SET `Username`=:username,`Name`=:name,`Address`=:address,`Telephone_number`=:tel,`Position`=:position,`Office`=:office WHERE OfficerID = :offId");
  			$stmt->bindParam(":offId", $OfficerID);
  			$stmt->bindParam(":name", $fullname);
  			$stmt->bindParam(":position", $Position);
        $stmt->bindParam(":office",$office);
        $stmt->bindParam(":address",$Address);
        $stmt->bindParam(":tel",$Tel);
        $stmt->bindParam(":username",$username);

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
