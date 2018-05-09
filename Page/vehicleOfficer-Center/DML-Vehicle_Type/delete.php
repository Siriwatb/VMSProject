<?php
include_once '../../../ConfigDB.php';

if($_POST['del_id'])
{
	$id = $_POST['del_id'];

	$checkID = $conn ->prepare('SELECT * FROM vehicle Where TypeID = :id');
	$checkID->bindParam(":id",$id);
	$checkID->execute();

	$row = $checkID->fetch(PDO::FETCH_ASSOC);
	if ($row==0) {
		$stmt=$conn->prepare("DELETE FROM `vehicle_type` WHERE TypeID=:id");

		if(	$stmt->execute(array(':id'=>$id)))
		{
			echo "delete success";
		}
		else{
			echo "พบข้อผิดพลาด : " ;
		}
	}
	else {
		echo "ข้อมูลนี้มีการอ้างอิงอยู่";
	}


}
?>
