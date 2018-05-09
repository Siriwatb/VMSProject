<?php
  session_start();

  if(!isset($_SESSION['user_session']))
  {
  	header("Location: ../../index.php");
  }else if($_SESSION['checkPermit'] != "เจ้าหน้าที่ฝ่ายยานพาหนะ" && $_SESSION['Position']!='เจ้าหน้าที่ฝ่ายยานพาหนะ' && $_SESSION['Office']!=6) {
  	header("Location: ../../index.php");
  }

  include_once '../../ConfigDB.php';
  $stmt = $conn->prepare("SELECT * FROM officer_vehicles WHERE OfficerID=:uid");
  $stmt->execute(array(":uid"=>$_SESSION['user_session']));
  $row=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="utf-8">
    <title>vehicleOfficer-Center PAGE</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <script src="../../jquery-3.1.1.min.js"></script>
	  <script src="../../semantic.min.js"></script>
		<script src="../../js/jquery.dataTables.min.js"></script>
		<script src="../../js/dataTables.semanticui.min.js"></script>
    <script src="../../js/calendar.js"></script>

  	<link rel="stylesheet" href="../../font/googleFont.css">
    <link rel="stylesheet" href="../../css/calendar.css">
    <link rel="stylesheet" href="../../semantic.min.css">
  	<link rel="stylesheet" href="../../css/editModal.css">
		<link rel="stylesheet" href="../../css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="../../css/dataTables.semanticui.min.css">

    <script>
      $(document)
      	.ready(function() {

      		// fix main menu to page on passing
      		$('.main.menu').visibility({
      			type: 'fixed'
      		});
      		$('.overlay').visibility({
      			type: 'fixed',
      			offset: 80
      		});

      		// lazy load images
      		$('.image').visibility({
      			type: 'image',
      			transition: 'vertical flip in',
      			duration: 500
      		});

      		// show dropdown on hover
      		$('.main.menu  .ui.dropdown').dropdown({
      			on: 'hover'
      		});
      	})
      ;
    </script>

    <style type="text/css">
      body {
      	background-color: #FFFFFF;
      }
      .main.container {
      	margin-top: 2em;
      }
      .main.menu {
      	margin-top: 0em;
      	border-radius: 0;
      	border: none;
      	box-shadow: none;
      	transition:
      		box-shadow 0.5s ease,
      		padding 0.5s ease
      	;
      }
      /*.main.menu .item img.logo {
      	margin-right: 1.5em;
      }*/
      .overlay {
      	float: left;;
      	margin: 0em 3em 1em 0em;
      }
      .overlay .menu {
      	position: relative;
      	left: 0;
      	transition: left 0.5s ease;
      }
      .main.menu.fixed {
      	background-color: #1B1C1D ;
      	border: 1px solid #DDD;
      	box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
      }
      .overlay.fixed .menu {
      	left: 500px;
      }
      .text.container .left.floated.image {
      	margin: 2em 2em 2em -4em;
      }
      .text.container .right.floated.image {
      	margin: 2em -4em 2em 2em;
      }
      .ui.footer.segment {
      	margin: 5em 0em 0em;
      	padding: 5em 0em;

      }
      .ui.action.input input[type="file"] {
        display: none;
      }
      .ui.pointing.red.basic.label{
        display: none;
      }
    </style>
  </head>
  <body>
    <!-- ส่วนภาพ header -->
		<div class="ui fluid container">
			<img class="ui fluid image" src="../../images/GG.png">
		</div>

  <!-- เมนู -->
    <div class="ui inverted borderless stackable main menu">
      <div class="ui text container">
        <a href="list-Booking.php" class="item" id="btnHome">รายการจอง</a>
        <a href="list-Approval.php" class="item" id="btnHome">การอนุมัติ</a>
        <div class="ui dropdown item">จัดการข้อมูลยานพาหนะ
          <div class="menu">
            <a href="list-VH-Type.php" class="item" id="btnLoad-VHType">ข้อมูลประเภทยานพาหนะ</a>
      			<a href="list-Vehicles.php" class="item" id="btnLoad-Vehicles">ข้อมูลยานพาหนะ</a>
            <a href="list-Maintenance.php" class="item" id="btnLoad-Maintenance">ข้อมูลการตรวจซ่อมบำรุง</a>
          </div>
        </div>
        <a href="list-Question.php" class="item" id="btnLoad-Question">ข้อมูลข้อคำถาม</a> 
        <a href="list-Driver.php" class="item" id="btnLoad-Driver">ข้อมูลพนักงาน</a>
  			<div class="ui right dropdown item">
      		<?php echo   $_SESSION['fullname'] ;  ?>
      			<i class="angle down icon"></i>
      		<div class="menu">
            <a href="#" class="dropdown item" id='btnProfile'>ข้อมูลส่วนตัว</a>
  					<a href="#" class="dropdown item" id='btnChangePass'>เปลี่ยนรหัสผ่าน</a>
  					<div class="divider"></div>
  					<a href="../../logout.php" class="dropdown item">ออกจากระบบ</a>
      		</div>
    		</div>
      </div>
    </div>
<!-- แสดงข้อมูลส่วนตัว -->
<div class="ui modal" id='ModalProfile'>
  <i class="close icon"></i>
  <div class="header">
    Profile
  </div>
  <div class="image content">
    <div class="ui medium image">
      <!-- <img src="/images/avatar/large/chris.jpg"> -->
    </div>
    <div class="description">
      <div class="ui header">รหัสเจ้าหน้าที่ : <?php echo $_SESSION['user_session'] ?></div>
      <p>ชื่อ - นามสกุล : <?php echo $_SESSION['fullname'] ?></p>
      <p>ตำแหน่ง : <?php echo $_SESSION['Position'] ?></p>
      <p>สังกัด : <?php echo $_SESSION['Office'] ?></p>
      <p>checkPermit : <?php echo $_SESSION['checkPermit'] ?></p>
    </div>
  </div>
  
</div>
<!-- แก้ไขรหัสผ่าน -->
<div class="ui tiny modal" id='ModalChangePassword'>
  <div class="header">
    เปลี่ยนรหัสผ่าน
  </div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
    <form class="ui form" id='frmChangePass' method="post">
      <div class="fields">
        <input type="hidden" name="id" id='idPass' value="<?php echo $_SESSION['OfficerID'] ?>">
        <div class="field">
          <label>รหัสผ่านเก่า</label>
          <input type="password" placeholder="รหัสผ่านเก่า" name='oldPass' id='oldPass'>
        </div>
      </div>
      <div class="ui divider"></div>
      <div class="fields">
        <div class="field">
          <label>รหัสผ่านใหม่</label>
          <input type="password" placeholder="รหัสผ่านใหม่" name='newPass'>
        </div>
      </div>
      <div class="fields">
        <div class="field">
          <label>ยืนยันรหัสผ่าน</label>
          <input type="password" placeholder="ยืนยันรหัสผ่าน" name="confirmPass">
        </div>
      </div>
    </form>
  </div>
  </div>
  </div>
  <div class="actions">
    <div class="ui red deny button" id='btnExit-ChangePass'>
      ยกเลิก
    </div>
    <div class="ui positive button" id='btnSubmit-ChangePass'>
      เปลี่ยนรหัสผ่าน
    </div>
  </div>
</div>


  <!-- โหลดเนื้อหา -->
    <!-- <div class="ui container" id='content-loader'>

    </div> -->


  <!-- modal แจ้งเตือน  -->
  <div class="ui basic modal" id="alert-popup">
    <div class="ui icon header">
      <!-- <i class="archive icon"></i> -->
      แจ้งเตือน
    </div>
    <div class="content">
      <p id="alert-popup-msg"></p>
    </div>
    <div class="actions">
      <div class="ui green ok inverted button" id="btnAlertOk">
        <i class="checkmark icon"></i>
        ตกลง
      </div>
    </div>
  </div>
  <!-- modal confirm box -->
  <div class="ui basic modal" id="confirm-popup">
    <div class="ui icon header">
      <!-- <i class="archive icon"></i> -->
      แจ้งเตือน
    </div>
    <div class="content">
      <p id="confirm-popup-msg"></p>
    </div>
    <div class="actions">
  		<div class="ui red cancel inverted button" id="btnCancel">
        <i class="remove icon"></i>
        ยกเลิก
      </div>
      <div class="ui green ok inverted button" id="btnConfirm">
        <i class="checkmark icon"></i>
        ตกลง
      </div>
    </div>
  </div>


</body>
<script>
$(document).ready(function(){
   $('.ui.modal').modal({
    closable : false
  });
  $('#ModalProfile').modal({
    closable : true
  });
  $('#btnProfile').click(function() {
    $('#ModalProfile').modal('show');
  });

  $('#btnChangePass').click(function() {
    $('#ModalChangePassword').modal('show');
  });
});
</script>

</html>
