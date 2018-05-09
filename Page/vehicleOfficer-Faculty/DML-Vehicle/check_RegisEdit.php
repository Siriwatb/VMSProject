<?php
require_once'../../../ConfigDB.php';
if ($_POST) {

  $Registration = $_POST['Registration'];
  $VehicleID = $_POST['VehicleID'];

  if(!empty($Registration)&&!empty($VehicleID)) {

    $IDresult = $conn->prepare("SELECT * from `vehicle` WHERE Registration = :registration ");
    $IDresult->bindParam(":registration",$Registration);
    $IDresult->execute();

    $REresult = $conn->prepare("SELECT * from `vehicle` WHERE VehicleID = :id AND Registration = :registration");
    $REresult->bindParam(":registration",$Registration);
    $REresult->bindParam(":id",$VehicleID);
    $REresult->execute();
    $rowID = $IDresult->fetch(PDO::FETCH_ASSOC);
    $rowRE = $REresult->fetch(PDO::FETCH_ASSOC);
    // preg_match("/^[a-zA-Zก-๙0-9\s]+$/",$Registration

    if( (preg_match("/^[a-zA-Zก-๙0-9\s]+$/",$Registration)>0)&&$rowID==0&&$rowRE==0) {
        echo "green checkmark";
    }
    else if ((preg_match("/^[a-zA-Zก-๙0-9\s]+$/",$Registration)>0)&&$rowRE>0) {
      echo "green checkmark";
    }
    else
    {
      echo "red remove";

    }
  }
  else {
    echo "fail";
  }

}
else {
  echo "fail";
}
?>
