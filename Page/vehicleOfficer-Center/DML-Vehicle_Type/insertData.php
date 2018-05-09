<?php
require_once '../../../ConfigDB.php';


	if($_POST)
	{

		$name = $_POST['TypeName'];
		$description = $_POST['TypeDescription'];

      try{

  			$stmt = $conn->prepare("INSERT INTO `vehicle_type`(`Name_Type`, `Description`) VALUES( :name, :description)");
  			$stmt->bindParam(":name", $name);
  			$stmt->bindParam(":description", $description);

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
