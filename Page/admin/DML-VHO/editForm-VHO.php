<?php
include_once '../../../ConfigDB.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];
	$stmt=$conn->prepare("SELECT OfficerID, Username, vho.Name as name,Address,Telephone_number,Position,f.Name as faculty FROM officer_vehicles as vho join faculty as f on vho.Office = f.ID WHERE OfficerID=:id");
	$stmt->execute(array(':id'=>$id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	// สำหรับแยกชื่อเต็ม เป็น ชื่อจริง และ นามสกุล
	$fullname = explode(" ", $row['name']);
	$Fname = $fullname[0]; // piece1
	$Lname = $fullname[1]; // piece2
}

?>


				<form class="ui form" id="formEdit-VHO" >
					<div class="ui equal width form">
						<div class="two fields">
							<div class="required field">
								<label>รหัสเจ้าหน้าที่</label>
								<div class="ui icon input" id="loadingCheck">
									<input readonly="" type="text" placeholder="รหัสเจ้าหน้าที่" id="OfficerID" name="OfficerID" value="<?php echo $row['OfficerID']; ?>">
									<i class="icon" id="statusOffID"></i>
								</div>

							</div>
							<div class="inline field">

							</div>
						</div>
						<div class="fields">
							<div class="required field">
								<label>ชื่อ</label>
								<input type="text" placeholder="ชื่อ" name="VHO-Fname" id="fName" value="<?php echo $Fname; ?>">
							</div>
							<div class="required field">
								<label>นามสกุล</label>
								<input type="text" placeholder="นามสกุล" name="VHO-Lname" id="lName" value="<?php echo $Lname; ?>">
							</div>
						</div>
						<div class="fields">
							<div class="required field">
								<label>ตำแหน่ง</label>
								<div class="ui dropdown selection">
									<input type="hidden" name="VHO-Position" value="<?php echo $row['Position']; ?>">
									<div class="default text">เลือกตำแหน่ง</div>
									<i class="dropdown icon"></i>
									<div class="menu">
										<div class="item" data-value="เจ้าหน้าที่ฝ่ายยานพาหนะ">เจ้าหน้าที่ฝ่ายยานพาหนะ</div>
										<div class="item" data-value="พนักงานขับยานพาหนะ">พนักงานขับยานพาหนะ</div>
									</div>
								</div>
							</div>
							<div class="required field">
								<label>สังกัด</label>
								<div class="ui dropdown selection">
									<input type="hidden" name="VHO-office" value="<?php echo $row['faculty']; ?>">
									<div class="default text">เลือกสังกัด</div>
									<i class="dropdown icon"></i>
									<div class="menu">
										<div class="item" data-value="6">ส่วนกลาง</div>
										<div class="item" data-value="4">คณะครุศาสตร์</div>
										<div class="item" data-value="2">คณะมนุษยศาสตร์และสังคมศาสตร์</div>
										<div class="item" data-value="1">คณะวิทยาศาสตร์</div>
										<div class="item" data-value="3">คณะวิทยาการจัดการ</div>
										<div class="item" data-value="5">คณะเทคโนโลยี</div>
									</div>
								</div>
							</div>
						</div>
						<div class="fields">
							<div class="twelve wide field">
								<label>ที่อยู่</label>
								<textarea rows="3" placeholder="ระบุที่อยู่" name="VHO-Address" id="address" ><?php echo $row['Address']; ?></textarea>
							</div>
						</div>
						<div class="two fields">
							<div class="required field">
								<label>หมายเลขโทรศัพท์ ติดต่อ</label>
								<input type="text" placeholder="หมายเลขโทรศัพท์" name="VHO-Tel" id="telNo" value="<?php echo $row['Telephone_number']; ?>">
							</div>
							<div class="field">
							</div>
						</div>
						<div class="two fields">
							<div class="required field">
								<label>ชื่อผู้ใช้เข้าสู่ระบบ</label>
								<input type="text" placeholder="ชื่อผู้ใช้เข้าสู่ระบบ" name="VHO-username" id="usrname" value="<?php echo $row['Username']; ?>">
							</div>
							<div class="field">
							</div>
						</div>
					</div>
				</form>

<script>
$(document).ready(function(){
		$('.ui.dropdown').dropdown();
});
$('#btnEditVHO-Submit').click(function(){
	$('#formEdit-VHO').form('submit');
});

</script>
<script src="DML-VHO/crud-VHO.js"></script>
