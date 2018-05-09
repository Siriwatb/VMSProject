<?php
include_once '../../../ConfigDB.php';

if($_GET['show_id'])
{
	$id = $_GET['show_id'];
	$stmt=$conn->prepare("SELECT OfficerID, Username, vho.Name as name,Address,Telephone_number,Position,f.Name as faculty FROM officer_vehicles as vho join faculty as f on vho.Office = f.ID WHERE OfficerID=:id");
	$stmt->execute(array(':id'=>$id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	// สำหรับแยกชื่อเต็ม เป็น ชื่อจริง และ นามสกุล
	$fullname = explode(" ", $row['name']);
	$Fname = $fullname[0]; // piece1
	$Lname = $fullname[1]; // piece2
}

?>


				<form class="ui form" >
					<div class="ui equal width form">
						<div class="two fields">
							<div class="required field">
								<label>รหัสเจ้าหน้าที่</label>
									<input readonly="" type="text" placeholder="รหัสเจ้าหน้าที่" id="OfficerID" name="OfficerID" value="<?php echo $row['OfficerID']; ?>">
							</div>
							<div class="inline field">

							</div>
						</div>
						<div class="fields">
							<div class="required field">
								<label>ชื่อ</label>
								<input type="text" placeholder="ชื่อ" readonly="" value="<?php echo $Fname; ?>">
							</div>
							<div class="required field">
								<label>นามสกุล</label>
								<input type="text" placeholder="นามสกุล" readonly="" value="<?php echo $Lname; ?>">
							</div>
						</div>
						<div class="fields">
							<div class="required field">
								<label>ตำแหน่ง</label>
								<!-- <div class="ui dropdown selection"> -->
									<input type="text" readonly="" value="<?php echo $row['Position']; ?>">
									<!-- <div class="default text">เลือกตำแหน่ง</div>
									<i class="dropdown icon"></i>
									<div class="menu">
										<div class="item" data-value="เจ้าหน้าที่ฝ่ายยานพาหนะ">เจ้าหน้าที่ฝ่ายยานพาหนะ</div>
										<div class="item" data-value="พนักงานขับยานพาหนะ">พนักงานขับยานพาหนะ</div>
									</div> -->
								<!-- </div> -->
							</div>
							<div class="required field">
								<label>สังกัด</label>
								<input type="text" placeholder="สังกัด" readonly="" value="<?php echo $row['faculty']; ?>">
							</div>
						</div>
						<div class="fields">
							<div class="twelve wide field">
								<label>ที่อยู่</label>
								<textarea rows="3" placeholder="ระบุที่อยู่" readonly="" ><?php echo $row['Address']; ?></textarea>
							</div>
						</div>
						<div class="two fields">
							<div class="required field">
								<label>หมายเลขโทรศัพท์ ติดต่อ</label>
								<input type="text" placeholder="หมายเลขโทรศัพท์" readonly=""  value="<?php echo $row['Telephone_number']; ?>">
							</div>
							<div class="field">
							</div>
						</div>
						<div class="two fields">
							<div class="required field">
								<label>ชื่อผู้ใช้เข้าสู่ระบบ</label>
								<input type="text" placeholder="ชื่อผู้ใช้เข้าสู่ระบบ" readonly="" value="<?php echo $row['Username']; ?>">
							</div>
							<div class="field">
							</div>
						</div>
					</div>
				</form>



<script>
$(document).ready(function(){

});


</script>
<script src="DML-VHO/crud-VHO.js"></script>
