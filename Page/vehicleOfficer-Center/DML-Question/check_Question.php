<?php
require_once'../../../ConfigDB.php';
if ($_POST) {
  $question = $_POST['question'];


  if(!empty($question)) {
    $result = $conn->prepare("SELECT  `Question` FROM `question` WHERE Question = :question");
    $result->bindParam(":question",$question);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // $user_count = $row[0];
    if( (preg_match("/^[a-zA-Zก-๙0-9\W]+$/",$question)>0)&&($row==0) ) {
        echo "green checkmark";

    }else{
      echo "red remove";

    }
  }

}
else {
  echo "fail";
}
?>
