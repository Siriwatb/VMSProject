<?php
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		$typeId= $_POST['TypeID'];
		$description = $_POST['TypeDescription'];
		$nameType = $_POST['TypeName'];

      try{

  			$stmt = $conn->prepare("UPDATE `vehicle_type` SET `Name_Type`= :nameType,`Description`=:description WHERE `TypeID`=:typeId");
  			$stmt->bindParam(":nameType", $nameType);
  			$stmt->bindParam(":description", $description);
  			$stmt->bindParam(":typeId", $typeId);


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
