<?php
include_once '../../../ConfigDB.php';
// error_reporting(E_ALL & ~E_NOTICE);

if($_POST['del_id'])
{
	$id = $_POST['del_id'];

	$checkID = $conn ->prepare('SELECT * FROM `maintenance` WHERE `VehicleID` = :id');
	$checkID->bindParam(":id",$id);
	$checkID->execute();

	$row = $checkID->fetch(PDO::FETCH_ASSOC);

	$pic = $conn ->prepare('SELECT `Picture` FROM `vehicle` WHERE `VehicleID` = :id');
	$pic->bindParam(":id",$id);
	$pic->execute();
	$picName = $pic->fetch(PDO::FETCH_ASSOC);
	$picPath = '..\\..\\..\\images\\Vehicles-Images\\';
if ($row==0) {
	
	$stmt=$conn->prepare("DELETE FROM `vehicle` WHERE VehicleID=:id");
	@unlink($picPath."/".$picName['Picture']);
	if(	$stmt->execute(array(':id'=>$id)))
	{
		
		echo "delete success";
	}
	else{
		echo "พบข้อผิดพลาด : " ;
	}
}
else {
	echo "ข้อมูลมีการอ้างอิงอยู่";
}

}
?>
