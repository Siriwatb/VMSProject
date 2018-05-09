<?php
include_once '../../../ConfigDB.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];
	$stmt=$conn->prepare("SELECT * FROM `vehicle` WHERE VehicleID=:id");
	$stmt->execute(array(':id'=>$id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

}

?>

<form class="ui form" id="formEdit-VH" >
	<div class="ui equal width form">
		<div class="fields">
			<div class="field">
				<label>รหัสยานพาหนะ</label>
				<input readonly="" type="text" placeholder="รหัสยานพาหนะ" name="VehicleID" id="VehicleIDEdit" value="<?php echo $row['VehicleID']; ?>">
			</div>
			<div class="field">
			</div>
		</div>
		<div class="fields">
			<div class="field">
				<label>หมายเลขทะเบียน</label>
				<div class="ui icon input" id="loadingCheckEdit">
					<input type="text" placeholder="หมายเลขทะเบียน" name="Registration" id='RegistrationEdit' value="<?php echo $row['Registration']; ?>" onblur="checkAvailabilityRegis()">
				<i class="icon" id="statusEditRE"></i>
				</div>
				<div class="ui red pointing basic label " id='dupEditRE'>
					<i class="remove icon"></i>ทะเบียนนี้มีในระบบแล้ว
				</div>
			</div>
			<div class="field">
				<label>ยี่ห้อ</label>
				<input type="text" placeholder="ยี่ห้อ" name="Brand" value="<?php echo $row['Brand']; ?>">
			</div>
		</div>
		<div class="fields">
			<div class="required field">
				<label>ประเภทยานพาหนะ</label>
				<div class="ui dropdown selection">
					<input type="hidden" name="TypeID" value="<?php echo $row['TypeID']; ?>">
					<div class="default text">เลือกประเภท</div>
					<i class="dropdown icon"></i>
					<div class="menu">
						<?php
							require_once '../../../ConfigDB.php';
							$item = '';
							$stmt2 = $conn->prepare("SELECT * FROM `vehicle_type");
							$stmt3 = $conn->prepare("SELECT * FROM `vehicle_type");
							$stmt2->execute();
							$stmt3->execute();
								$row3=$stmt3->fetch(PDO::FETCH_ASSOC);
							if ($row3==0) {
								echo '<div class="disabled item">ไม่มีข้อมูล</div>';
							}
							else {
								while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
								{
									echo '<div class="item"  data-value='.$row2['TypeID'].'>'.$row2['Name_Type'].'</div>';
								}
							}?>
					</div>
				</div>
			</div>
			<div class="field">
				<label>จำนวนที่นั่ง</label>
				<input type="number" placeholder="ระบุจำนวนที่นั่ง" name="Num_of_seats" value="<?php echo $row['Num of seats']; ?>" >
			</div>
		</div>
			<div class="fields">
				<div class="field">
					<label>หมายเลขระยะทางเริ่มต้น</label>
					<input type="number" placeholder="ระยะทางเริ่มต้น" name="Odometer" value="<?php echo $row['Odometer']; ?>">
				</div>
				<?php
				// แปลงวันที่
				$dateInsuranceEX = $row['Date insurance expires'];
				$date = date_create_from_format('Y-m-d',$dateInsuranceEX );
				$dateInsurance = date_format($date,'j/m/Y');
				 ?>
				<div class="field">
					<label>วันที่หมดประกัน</label>
					<!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
					<div class="ui calendar" id="DateExp">
						<div class="ui input left icon">
							<i class="calendar icon"></i>
							<input type="text" placeholder="วันที่หมดประกัน" name="DateInsuranceExp" value="<?php echo $dateInsurance; ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="fields">
				<div class="required field">
					<label>สังกัด</label>
					<div class="ui dropdown selection">
						<input type="hidden" name='Department' value="<?php echo $row['Department']; ?>">
						<div class="default text">เลือกสังกัด</div>
						<i class="dropdown icon"></i>
						<div class="menu">
							<div class="item" data-value="ส่วนกลาง">ส่วนกลาง</div>
							<div class="item" data-value="คณะครุศาสตร์">คณะครุศาสตร์</div>
							<div class="item" data-value="คณะมนุษยศาสตร์และสังคมศาสตร์">คณะมนุษยศาสตร์และสังคมศาสตร์</div>
							<div class="item" data-value="คณะวิทยาศาสตร์">คณะวิทยาศาสตร์</div>
							<div class="item" data-value="คณะวิทยาการจัดการ">คณะวิทยาการจัดการ</div>
							<div class="item" data-value="คณะเทคโนโลยี">คณะเทคโนโลยี</div>
						</div>
					</div>
				</div>
				<!-- <div class="field">
					<label>รูปภาพ</label>
					<div class="ui fluid action input">
						<input type="text" readonly>
						<input type="file" name="Vehicle_image" accept="image/*">
						<div class="ui icon button">
							<i class="attach icon"></i>
						</div>
					</div>
				</div> -->
				<div class="field">
					<label>รูปภาพ</label>
					<div class="ui fluid action input" id='EditImage'>
						<input type="text" name="vh-showpath" readonly id='vh-showpathEdit'>
						<input type="file" name="Vehicle_image" id='Vehicle_imageEdit' accept="image/*">
						<div class="ui icon button" id='btnEditImage'>
							<i class="attach icon"></i>
						</div>
					</div>
				</div>
			</div>
	</div>
</form>
<script>
$('#vh-showpathEdit,#btnEditImage').click(function(e){
	e.stopImmediatePropagation();
	console.log('triggered');
 $('#Vehicle_imageEdit').click();
 $('#Vehicle_imageEdit').on('change',function(){
	 var filename = $('#Vehicle_imageEdit').val().replace(/C:\\fakepath\\/i, '')
	 $('#vh-showpathEdit').val(filename) ;
 });
});
</script>

<script>
$(document).ready(function(){
	$('.ui.dropdown').dropdown();

  $('#btnEditSubmit-VH').click(function(){
  	$('#formEdit-VH').form('submit');
  });

	// $('input:text, .ui.button', '.ui.action.input')
	// 	.on('click', function(e) {
	// 			$('input:file', $(e.target).parents()).click();
	// 	});
	//
	// $('input:file', '.ui.action.input')
	// 	.on('change', function(e) {
	// 			var name = e.target.files[0].name;
	// 			$('input:text', $(e.target).parent()).val(name);
	// 	});


});
</script>
<script>
function checkAvailabilityRegis() {
	if( $('#RegistrationEdit').val() == '') {
			return false ;
		}
	jQuery.ajax({
	url: "DML-Vehicle/check_RegisEdit.php",
	data: {Registration:$("#RegistrationEdit").val(),VehicleID:$('#VehicleIDEdit').val()},
	// 'Registration='+$("#RegistrationEdit").val()+'VehicleID='+$('#VehicleIDEdit').val() ,
	type: "POST",
	beforeSend: function(){
		$("#loadingCheckEdit").addClass("loading");
		$("#statusEditRE").removeClass('green checkmark red remove');
	},
	success:function(data){
		$("#loadingCheckEdit").removeClass("loading");
		$("#statusEditRE").addClass(data);
		if (data=='green checkmark') {
			$("#statusEditRE").val(1);
			$('#dupEditRE').fadeOut();
		}
		else {
			$("#statusEditRE").val(0);
			$('#dupEditRE').fadeIn();
		}
	},
	error:function (){}
	});

}
</script>
<script src="DML-Vehicle/crud-VH.js"></script>
