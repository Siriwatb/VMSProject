<?php
session_start();

include_once 'ConfigDB.php';

if(isset($_SESSION['user_session'])){
	if($_SESSION['Position'] == "ผู้ดูแลระบบ"&&$_SESSION['Dept']=='ผู้ดูแลระบบ') {
		header("Location: Page/admin");
	}elseif($_SESSION['checkPermit'] == "เจ้าหน้าที่ฝ่ายยานพาหนะ" && $_SESSION['Position']=='เจ้าหน้าที่ฝ่ายยานพาหนะ' && $_SESSION['Office'] =='ส่วนกลาง') {
		header("Location: Page/vehicleOfficer-Center");
	}
	elseif($_SESSION['checkPermit'] == "เจ้าหน้าที่ฝ่ายยานพาหนะ" && $_SESSION['Position']=='เจ้าหน้าที่ฝ่ายยานพาหนะ' && $_SESSION['Office'] !='ส่วนกลาง') {
		header("Location: Page/vehicleOfficer-Faculty");
	}elseif($_SESSION['checkPermit'] == "บุคลากร" && $_SESSION['Position']!='เจ้าหน้าที่รักษาความปลอดภัย') {
		header("Location: Page/user");
	}else if($_SESSION['checkPermit'] == "เจ้าหน้าที่ฝ่ายยานพาหนะ" && $_SESSION['Position']=='พนักงานขับยานพาหนะ') {
  		header("Location: Page/driver");
  }
	else if($_SESSION['checkPermit'] == "บุคลากร" && $_SESSION['Position']=='เจ้าหน้าที่รักษาความปลอดภัย') {
  		header("Location: Page/securityOfficer");
  }


  }

?>
