<?php
require_once '../../../ConfigDB.php';


	if($_POST)
	{

		$question = $_POST['question'];


      try{

  			$stmt = $conn->prepare("INSERT INTO `question`(`Question`) VALUES(:question)");

  			$stmt->bindParam(":question", $question);


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
