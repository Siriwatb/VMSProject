<?php
session_start();
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		$mainId = $_POST['mID'];
		$description = $_POST['Description'];
		$datemain = $_POST['M-Date'];
		$timemain = $_POST['M-Time'];

    $officleId = $_SESSION['user_session'];

		$date = date_create_from_format('j/m/Y',$datemain);
		$datemain = date_format($date,'Y/m/d');

      try{

  			$stmt = $conn->prepare("UPDATE `maintenance` SET `Description`= :description,`DateMain`=:datemain,`TimeMain`=:timemain,`OfficerID`=:officleId WHERE `MainID` = :mainId");
  			$stmt->bindParam(":description", $description);
  			$stmt->bindParam(":datemain", $datemain);
  			$stmt->bindParam(":timemain", $timemain);
				$stmt->bindParam(":mainId",$mainId);
        $stmt->bindParam(":officleId",$officleId);
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
