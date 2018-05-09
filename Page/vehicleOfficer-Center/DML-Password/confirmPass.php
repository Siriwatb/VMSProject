<?php
require_once'../../../ConfigDB.php';
if ($_POST) {
  $id = $_POST[''];
  $oldPass = $_POST[''];

  if(!empty($id)&&!empty($oldPass)) {
    $result = $conn->prepare("SELECT * from `vehicle` WHERE Registration = :registration");
    $result->bindParam(":registration",$Registration);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // $user_count = $row[0];
    if( (preg_match("/^[a-zA-Zก-๙0-9\s]+$/",$Registration)>0)&&($row==0) ) {
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
