<?php
  session_start();
  require_once 'ConfigDB.php';

  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  try {

    $tblVehOff = $conn->prepare("SELECT OfficerID, Username, Password, vho.Name as name ,Position,f.Name as Office FROM officer_vehicles as vho join faculty as f on vho.Office = f.ID Where Username = :usr");
    $tblVehOff->execute(array(":usr"=>$username));
    $row = $tblVehOff->fetch(PDO::FETCH_ASSOC);
    $count = $tblVehOff->rowCount();
      if ($row['Password']==$password) {
          $_SESSION['checkPermit'] = 'เจ้าหน้าที่ฝ่ายยานพาหนะ' ;
          if ($row['Office']=='ส่วนกลาง') {
            if ($row['Position']=='เจ้าหน้าที่ฝ่ายยานพาหนะ') {
              echo "VehicleOfficerCenter";
              $_SESSION['user_session'] = $row['OfficerID'];
              $_SESSION['Position']=$row['Position'];
              $_SESSION['Office'] =$row['Office'];
              $_SESSION['fullname']=$row['name'];
              
            }
    				else if ($row['Position']=='พนักงานขับยานพาหนะ') {
              echo "Driver";
    				  $_SESSION['user_session'] = $row['OfficerID'];
              $_SESSION['Position']=$row['Position'];
              $_SESSION['fullname']=$row['name'];
    				}
          }
          else {
            if ($row['Position']=='เจ้าหน้าที่ฝ่ายยานพาหนะ') {
              echo "VehicleOfficerFac";
              $_SESSION['user_session'] = $row['OfficerID'];
              $_SESSION['Position']=$row['Position'];
              $_SESSION['Office'] =$row['Office'];
              $_SESSION['fullname']=$row['name'];
            }
    				else if ($row['Position']=='พนักงานขับยานพาหนะ') {
              echo "Driver";
    				  $_SESSION['user_session'] = $row['OfficerID'];
              $_SESSION['Position']=$row['Position'];
              $_SESSION['Office'] =$row['Office'];
              $_SESSION['fullname']=$row['name'];
    				}
          }
      }

      else {

        $tblPersonOff = $conn->prepare("SELECT p.Name as pName , PersonnelID , Position , Password , f.Name as FacName FROM personnel as p JOIN faculty as f ON p.Department = f.ID WHERE Username = :usr");
        $tblPersonOff->execute(array(":usr"=>$username));
        $row = $tblPersonOff->fetch(PDO::FETCH_ASSOC);
        $count = $tblPersonOff->rowCount();

          if ($row['Password']==$password) {
            $_SESSION['checkPermit'] = 'บุคลากร' ;
          if ($row['Position']=='ผู้ดูแลระบบ') {
            echo "admin";
            $_SESSION['user_session'] = $row['PersonnelID'];
            $_SESSION['Position']= $row['Position'];
            $_SESSION['Dept'] =$row['FacName'];
            $_SESSION['fullname']=$row['pName'];
          }
          else if ($row['Position']=='เจ้าหน้าที่รักษาความปลอดภัย') {
            echo "security";
            $_SESSION['user_session'] = $row['PersonnelID'];
            $_SESSION['Position']=$row['Position'];
            $_SESSION['Dept'] =$row['FacName'];
            $_SESSION['fullname']=$row['pName'];
          }
          else  {
            echo "Personnel";
            $_SESSION['user_session'] = $row['PersonnelID'];
            $_SESSION['Position']=$row['Position'];
            $_SESSION['Dept'] =$row['FacName'];
            $_SESSION['fullname']=$row['pName'];
          }
        }
        else {
          echo "ไม่พบผู้ใช้หรือรหัสผ่านผิด";
        }
      }


  } catch (Exception $e) {
    echo $e->getMessage();
  }


 ?>
