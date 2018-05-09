<?php
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		$name = $_POST['Personnel-Fname'];
		$lastname = $_POST['Personnel-Lname'];
		$PersonnelID = $_POST['PersonnelID'];
		$fullname = $name .= ' '. $lastname;
		$Position = $_POST['Personnel-Position'];
    $department = $_POST['Personnel-department'];
    $Address = $_POST['Personnel-Address'];
    $Tel = $_POST['Personnel-Tel'];
    $username = $_POST['Personnel-username'];


      try{

  			$stmt = $conn->prepare("UPDATE `personnel` SET `Username`=:username,`Name`=:name,`Address`=:address,`Telephone number`=:tel,`Position`=:position,`Department`=:department WHERE PersonnelID = :PersonId");
				$stmt->bindParam(":PersonId", $PersonnelID);
  			$stmt->bindParam(":name", $fullname);
  			$stmt->bindParam(":department", $department);
        $stmt->bindParam(":position",$Position);
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
