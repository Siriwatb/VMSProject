<?php
require_once '../../../ConfigDB.php';
error_reporting(E_ALL);
ini_set('display_errors',1);


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
    $username = $_POST['username'];


      try{

  			$stmt = $conn->prepare("INSERT INTO `personnel`(`PersonnelID`, `Username`, `Name`, `Address`, `Telephone number`, `Position`, `Department`) VALUES(:PersonId,:username,:name,:address,:tel,:position,:department)");
  			$stmt->bindParam(":PersonId", $PersonnelID);
  			$stmt->bindParam(":name", $fullname);
  			$stmt->bindParam(":department", $department);
        $stmt->bindParam(":position",$Position);
        $stmt->bindParam(":address",$Address);
        $stmt->bindParam(":tel",$Tel);
        $stmt->bindParam(":username",$username);

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
