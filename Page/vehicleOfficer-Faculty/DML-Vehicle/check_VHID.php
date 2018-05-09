<?php
require_once'../../../ConfigDB.php';
if ($_POST) {
  $VehicleID = $_POST['VehicleID'];


  if(!empty($VehicleID)) {
    $result = $conn->prepare("SELECT * from `vehicle` WHERE VehicleID = :id");
    $result->bindParam(":id",$VehicleID);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // $user_count = $row[0];
    if( (preg_match("/^[a-zA-Z0-9]+$/",$VehicleID)>0)&&($row==0) ) {
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
