<?php
session_start();
require_once '../../../ConfigDB.php';
if ($_POST) {
    $id = $_POST['id'] or $_REQUEST['id'];
    $offID = $_SESSION['user_session'];
    $appDate = date("Y-m-d");
    $app = 1;

    // echo print_r($appDate);
    try{

        $stmt = $conn->prepare("UPDATE `using` SET
                              `OfficerID`= :offID ,
                              `Approve Status`= :appStat,
                              `Approve Date` = :appDate                                                       
                               WHERE `UsingID`= :id ");

        $stmt->bindParam(":offID", $offID);
        $stmt->bindParam(":appStat", $app);
        $stmt->bindParam(":appDate", $appDate);
        $stmt->bindParam(":id", $id);             
        if($stmt->execute())
        {
            echo "อนุมัติเรียบร้อย";
        }
        else{
            echo "ไม่สามารถอนุมัติได้";
        }
    }
catch(PDOException $e){
        echo $e->getMessage();

    }

    
}





?>