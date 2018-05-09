<?php
session_start();
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		$id = $_POST[''];
		$newPass = $_POST[''];

      try{

  			$stmt = $conn->prepare("UPDATE `officer_vehicles` SET `Password`= :newPass WHERE `OfficerID` = :id");
  			$stmt->bindParam(":id", $id);
  			$stmt->bindParam(":newPass", $newPass);

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
