<?php
require_once'../../../ConfigDB.php';
if ($_POST) {
  $TypeName = $_POST['TypeName'];


  if(!empty($TypeName)) {
    $result = $conn->prepare("SELECT  `Name_Type` FROM `vehicle_type` WHERE Name_Type = :name");
    $result->bindParam(":name",$TypeName);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // $user_count = $row[0];
    if( (preg_match("/^[a-zA-Zก-๙0-9]+$/",$TypeName)>0)&&($row==0) ) {
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
