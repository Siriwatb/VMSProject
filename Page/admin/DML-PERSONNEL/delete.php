<?php
include_once '../../../ConfigDB.php';

if($_POST['del_id'])
{
	$id = $_POST['del_id'];
	$stmt=$conn->prepare("DELETE FROM personnel WHERE PersonnelID=:id");

	if(	$stmt->execute(array(':id'=>$id)))
	{
		echo "delete success";
	}
	else{
		echo "พบข้อผิดพลาด : " ;
	}
}
?>
