<?php
session_start();

if(!isset($_SESSION['user_session']))
{
	header("Location: ../../../index.php");
}else if($_SESSION['Position'] != "ผู้ดูแลระบบ"){
		header("Location: ../../../index.php");
}




?>
	<!DOCTYPE html>
	<html lang="th">

	<head>
		<meta charset="utf-8">
		<title>ADMIN PAGE</title>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<link rel="stylesheet" href="../../css/calendar.css">
		<link rel="stylesheet" href="../../font/googleFont.css">
		<link rel="stylesheet" href="../../semantic.min.css">
		<link rel="stylesheet" href="../../css/editModal.css">
		<link rel="stylesheet" href="../../css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="../../css/dataTables.semanticui.min.css">

		<!-- <script src="../../jquery-3.1.1.min.js"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="../../semantic.min.js"></script>
		<script src="../../js/jquery.dataTables.min.js"></script>
		<script src="../../js/dataTables.semanticui.min.js"></script>
		<script src="../../js/calendar.js"></script>
		<script src="checkUser.js"></script>
		<script src="https://cdn.datatables.net/plug-ins/1.10.16/api/fnReloadAjax.js"></script>




		<!-- <script src="https://cdn.datatables.net/plug-ins/1.10.13/api/fnReloadAjax.js"></script> -->

		<script>
			$(document)
				.ready(function () {

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
				});
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
				transition: box-shadow 0.5s ease,
				padding 0.5s ease;
			}

			.main.menu .item img.logo {
				margin-right: 1.5em;
			}

			.overlay {
				float: left;
				margin: 0em 3em 1em 0em;
			}

			.overlay .menu {
				position: relative;
				left: 0;
				transition: left 0.5s ease;
			}

			.main.menu.fixed {
				background-color: #1B1C1D;
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
		</style>

	</head>

	<body>

		<!-- ส่วนภาพ header -->
		<div class="ui fluid container">
			<img class="ui fluid image" src="../../images/GG.png">
		</div>

		<!-- เมนู  -->
		<div class="ui inverted borderless stackable main menu">
			<div class="ui text container">
				<a href="list-Personnel.php" class="item" id="btnLoad-Person">ข้อมูลบุคลากร</a>
				<div class="ui dropdown item">
					ข้อมูลเจ้าหน้าที่ฝ่ายยานพาหนะ
					<i class="dropdown icon"></i>
					<div class="menu">
						<a href="list-VHO.php" class="dropdown item" id="btnLoad-Center" name="ส่วนกลาง">เจ้าหน้าที่ส่วนกลาง</a>
						<div class="item">
							เจ้าหน้าที่ส่วนคณะ
							<i class="angle down icon"></i>
							<div class="menu">
								<a href="list-OffSci.php" class="dropdown item" id="btnLoad-Sci">คณะวิทยาศาสตร์</a>
								<a href="list-OffHuman.php" class="dropdown item" id="btnLoad-Human">คณะมนุษยศาสตร์</a>
								<a href="list-OffTech.php" class="dropdown item" id="btnLoad-Tech">คณะเทคโนโลยี</a>
								<a href="list-OffManeger.php" class="dropdown item" id="btnLoad-Mng">คณะวิทยาการจัดการ</a>
								<a href="list-OffEdu.php" class="dropdown item" id="btnLoad-Edu">คณะครุศาสตร์</a>
							</div>
						</div>


					</div>
				</div>
				<!-- <div class="ui dropdown item">
					เพจกำลังพัฒนา
					<i class="dropdown icon"></i>
					<div class="menu">
						<a href="list-Template.php" class="dropdown item">template</a>
						<a href="list-BookingCenter.php" class="dropdown item" id="btnLoad-BookingCenter">จัดการข้อมูลการจองยานพาหนะ ส่วนกลาง</a>
						<a href="#" class="dropdown item" id="btnLoad-BookingFaculty">จัดการข้อมูลการจองยานพาหนะ คณะ</a>
						<a href="#" class="dropdown item" id="btnLoad-BookingPersonal">จัดการข้อมูลการจองยานพาหนะ บุคลากร</a>
						<a href="#" class="dropdown item" id="btnLoad-DriverSchedule">จัดการเวลาคนขับยานพาหนะ</a>
						<a href="#" class="dropdown item" id="btnLoad-SaveRecord">จัดการบันทึกหลังการใช้ยานพาหนะ</a>
						<a href="#" class="dropdown item" id="btnLoad-ExitEntryVehi">จัดการข้อมูลเข้า-ออก ยานพาหนะ</a>
					</div>
				</div> -->

				<div class="ui right dropdown item">
					<?php echo   $_SESSION['fullname']; ?>
					<i class="angle down icon"></i>
					<div class="menu">
						<a href="#" class="dropdown item">ข้อมูลส่วนตัว</a>
						<a href="#" class="dropdown item" id="btnChangePass">เปลี่ยนรหัสผ่าน</a>
						<div class="divider"></div>
						<a href="../../logout.php" class="dropdown item">ออกจากระบบ</a>
					</div>
				</div>
			</div>
		</div>
		<!-- modal Edit password -->
		<div class="ui tiny modal" id="modal_changePass">
			<div class="ui center aligned header">
				<div class="fontPridi">
					เปลี่ยนรหัสผ่าน
				</div>
			</div>
			<!-- <h2 class="ui center aligned header">
  		<div class="fontPridi">
  				เปลี่ยนรหัสผ่าน
  		</div>
  	</h2> -->
			<div class="content">
				<form class="ui form" id="formChange-Pass">
					<div class="ui equal width form">
						<div class="fields">
							<div class="required field">
								<label>รหัสผ่านใหม่
									<i class="lock icon"></i>
								</label>
								<div class="ui icon input">
									<input type="password" placeholder="รหัสผ่านเก่า" id="OldPass" name="OldPass">


								</div>
							</div>

						</div>
						<div class="fields">
							<div class="required field">
								<label>ยืนยันรหัสผ่าน
									<i class="lock icon"></i>
								</label>
								<div class="ui icon input">
									<input type="password" placeholder="รหัสผ่านใหม่" id="newPass" name="newPass">
								</div>
							</div>
						</div>
						<div class="fields">
							<div class="required field">
								<div class="ui icon input">
									<input type="password" placeholder="ยืนยันรหัสผ่าน" id="confirmPass" name="confirmPass">

								</div>
							</div>
						</div>

					</div>
				</form>
			</div>
			<div class="actions">
				<div class="ui red cancel button" id="btnChangePassCancel">
					ยกเลิก
				</div>
				<div class="ui green ok button" id="btnChangePass">
					ตกลง
				</div>
			</div>
		</div>

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


		<script>
			$(document).ready(function () {
				$('.ui.modal').modal({
					closable: false
				});

				$('.ui.dropdown').dropdown();
				$('.form').form({
					keyboardShortcuts: false
				});



			});
		</script>
		<script>
			$(document).ready(function () {

				$('#btnChangePass').click(function () {
					$('#modal_changePass').modal('show');
				});


			});
		</script>