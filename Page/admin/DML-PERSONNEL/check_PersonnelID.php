<?php
require_once'../../../ConfigDB.php';
if ($_POST) {
  $PersonnelID = $_POST['PersonnelID'];


  if(!empty($PersonnelID)) {
    $result = $conn->prepare("SELECT * from `personnel` WHERE PersonnelID = :id");
    $result->bindParam(":id",$PersonnelID);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // $user_count = $row[0];
    if( (preg_match("/^[a-zA-Z0-9]+$/",$PersonnelID)>0)&&($row==0) ) {
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
