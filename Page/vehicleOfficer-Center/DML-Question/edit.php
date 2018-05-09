<?php
require_once '../../../ConfigDB.php';


	if($_POST)
	{
		$quesNo = $_POST['QuesNo'];
		$qestion = $_POST['question'];



      try{

  			$stmt = $conn->prepare("UPDATE `question` SET `Question`=:qestion WHERE `QuesNo`=:quesNo ");
  			$stmt->bindParam(":qestion", $qestion);
  			$stmt->bindParam(":quesNo", $quesNo);

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
