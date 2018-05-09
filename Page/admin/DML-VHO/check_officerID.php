<?php
require_once'../../../ConfigDB.php';
if ($_POST) {
  $OfficerID = $_POST['OfficerID'];


  if(!empty($OfficerID)) {
    $result = $conn->prepare("SELECT * from `officer_vehicles` WHERE OfficerID = :id");
    $result->bindParam(":id",$OfficerID);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // $user_count = $row[0];
    if( (preg_match("/^[a-zA-Z0-9]+$/",$OfficerID)>0)&&($row==0) ) {
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
