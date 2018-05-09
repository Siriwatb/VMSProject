<?php
require_once'../../ConfigDB.php';
if ($_POST) {
  $UserID = $_POST['username'];


  if(!empty($UserID)) {
    $result = $conn->prepare("SELECT Username , Password FROM personnel
                              WHERE Username = :id
                              UNION ALL
                              SELECT Username , Password FROM officer_vehicles
                              WHERE Username = :id");
    $result->bindParam(":id",$UserID);
    $result->execute();
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // $user_count = $row[0];
    if( (preg_match("/^[a-zA-Z0-9]+$/",$UserID)>0)&&($row==0) ) {
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
